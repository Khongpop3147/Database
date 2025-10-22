<x-app-layout>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($products as $p)
        <a href="{{ route('products.show',$p) }}" class="border rounded-xl p-4 block">
          <div class="font-semibold">{{ $p->name }}</div>
          <div class="opacity-70">⭐ {{ number_format($p->reviews_avg_rating,1) ?? '-' }}</div>
          <div>฿{{ number_format($p->price,2) }}</div>
        </a>
      @endforeach
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
  </div>
</x-app-layout>
