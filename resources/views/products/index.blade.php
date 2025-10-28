<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header and Filters -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">สินค้าทั้งหมด</h1>
                    <p class="mt-2 text-sm text-gray-500">พบ {{ $products->total() }} รายการ</p>
                </div>

                <!-- Search and Filters -->
                <div class="w-full sm:w-auto">
                    <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap gap-3">
                        <div class="relative flex-1 min-w-[200px]">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="ค้นหาสินค้า..." 
                                class="w-full rounded-lg border-gray-300 pl-10 pr-4 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <select name="sort" class="rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>สินค้าล่าสุด</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>ราคาต่ำ - สูง</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>ราคาสูง - ต่ำ</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>ยอดนิยม</option>
                        </select>
                        <button type="submit" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            กรอง
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}" 
                        class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white transition-all duration-300 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-100">
                        <!-- Product Image -->
                        <div class="aspect-h-4 aspect-w-4 bg-gray-100 sm:aspect-none sm:h-52">
                            @if($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105 sm:h-full sm:w-full">
                            @else
                                <div class="flex h-full items-center justify-center bg-gray-100">
                                    <svg class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Stock/New Badge -->
                            @if($product->stock <= 0)
                                <div class="absolute right-2 top-2">
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                        สินค้าหมด
                                    </span>
                                </div>
                            @elseif($product->created_at->diffInDays() < 7)
                                <div class="absolute right-2 top-2">
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        มาใหม่
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex flex-1 flex-col space-y-2 p-4">
                            <h3 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            
                            @if($product->category)
                                <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                            @endif

                            <!-- Rating -->
                            <div class="flex items-center gap-1">
                                <span class="text-amber-500">⭐</span>
                                <span class="text-sm text-gray-600">
                                    {{ number_format($product->reviews_avg_rating, 1) ?? '-' }}
                                </span>
                                @if($product->reviews_count > 0)
                                    <span class="text-sm text-gray-400">({{ $product->reviews_count }})</span>
                                @endif
                            </div>

                            <!-- Price -->
                            <div class="mt-auto pt-4">
                                <p class="text-base font-medium text-gray-900">฿{{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
@endpush
