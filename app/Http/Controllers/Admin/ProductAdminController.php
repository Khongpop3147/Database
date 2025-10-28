<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'        => ['required', 'string', 'max:255'],
                'price'       => ['required', 'numeric', 'min:0'],
                'stock'       => ['required', 'integer', 'min:0'],
                'category_id' => ['nullable', 'exists:categories,id'],
                'description' => ['nullable', 'string'],
                'images'      => ['nullable', 'array', 'max:5'], // Maximum 5 images
                'images.*'    => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // 5MB max per image
            ]);

            DB::beginTransaction();

            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    try {
                        $path = $image->store('products', 'public');
                        
                        $product->images()->create([
                            'path' => $path,
                            'is_primary' => $index === 0, // First image is primary
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Failed to store image: ' . $e->getMessage());
                        DB::rollBack();
                        throw $e;
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.products.edit', $product)
                ->with('success', 'สร้างสินค้าเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'เกิดข้อผิดพลาดในการสร้างสินค้า กรุณาลองใหม่อีกครั้ง']);
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $product->load('images'); // Eager load images
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $data = $request->validate([
                'name'        => ['required', 'string', 'max:255'],
                'price'       => ['required', 'numeric', 'min:0'],
                'stock'       => ['required', 'integer', 'min:0'],
                'category_id' => ['nullable', 'exists:categories,id'],
                'description' => ['nullable', 'string'],
                'images'      => ['nullable', 'array', 'max:5'],
                'images.*'    => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            ]);

            DB::beginTransaction();

            $product->update([
                'name' => $data['name'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
            ]);

            // Handle new images if uploaded
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    try {
                        $path = $image->store('products', 'public');
                        
                        $product->images()->create([
                            'path' => $path,
                            'is_primary' => !$product->images()->exists(), // Primary if no other images
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Failed to store image: ' . $e->getMessage());
                        DB::rollBack();
                        throw $e;
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'อัปเดตสินค้าเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'เกิดข้อผิดพลาดในการอัปเดตสินค้า กรุณาลองใหม่อีกครั้ง']);
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            // Delete associated images from storage
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            
            $product->delete();
            
            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'ลบสินค้าเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete product: ' . $e->getMessage());

            return back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการลบสินค้า กรุณาลองใหม่อีกครั้ง']);
        }
    }
}
