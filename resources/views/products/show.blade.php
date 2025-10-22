<x-app-layout>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
    <div class="opacity-70 mb-4">฿{{ number_format($product->price,2) }}</div>

    <form method="POST" action="{{ route('cart.add',$product) }}">
      @csrf
      <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">เพิ่มลงตะกร้า</button>
    </form>

    <div class="mt-6">
      <h2 class="font-semibold mb-2">รายละเอียด</h2>
      <p>{{ $product->description }}</p>
    </div>

    <div class="mt-6">
      <h2 class="font-semibold mb-2">รีวิว</h2>
      @forelse($product->reviews as $r)
        <div class="border rounded p-3 mb-2">
          <div class="text-sm opacity-70">โดย {{ $r->user->name }} • ⭐ {{ $r->rating }}</div>
          <div>{{ $r->comment }}</div>
        </div>
      @empty
        <div class="opacity-60">ยังไม่มีรีวิว</div>
      @endforelse
    </div>
  </div>
</x-app-layout>
