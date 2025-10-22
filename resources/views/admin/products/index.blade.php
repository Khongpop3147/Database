<x-app-layout>
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Admin · Products</h1>
      <a href="{{ route('admin.products.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">+ New</a>
    </div>

    @if(session('success'))
      <div class="mb-3 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto border rounded">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-3 py-2 text-left">#</th>
            <th class="px-3 py-2 text-left">Name</th>
            <th class="px-3 py-2 text-left">Category</th>
            <th class="px-3 py-2 text-right">Price</th>
            <th class="px-3 py-2 text-right">Stock</th>
            <th class="px-3 py-2"></th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $p)
            <tr class="border-t">
              <td class="px-3 py-2">{{ $p->id }}</td>
              <td class="px-3 py-2">{{ $p->name }}</td>
              <td class="px-3 py-2">{{ $p->category->name ?? '-' }}</td>
              <td class="px-3 py-2 text-right">฿{{ number_format($p->price,2) }}</td>
              <td class="px-3 py-2 text-right">{{ $p->stock }}</td>
              <td class="px-3 py-2 text-right">
                <a href="{{ route('admin.products.edit',$p) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <form class="inline" method="POST" action="{{ route('admin.products.destroy',$p) }}" onsubmit="return confirm('Delete?')">
                  @csrf @method('DELETE')
                  <button class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td class="px-3 py-6 text-center" colspan="6">No products</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
  </div>
</x-app-layout>
