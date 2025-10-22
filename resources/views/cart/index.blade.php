<x-app-layout>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">ตะกร้าสินค้า</h1>

    @forelse($cart->items as $it)
      <div class="flex items-center justify-between border rounded p-3 mb-2">
        <div>
          <div class="font-semibold">{{ $it->product->name ?? 'สินค้าถูกลบแล้ว' }}</div>
          <div class="opacity-70">฿{{ number_format($it->product->price ?? 0,2) }}</div>
        </div>
        <form method="POST" action="{{ route('cart.update',$it) }}" class="flex items-center gap-2">
          @csrf
          <input type="number" name="quantity" min="1" value="{{ $it->quantity }}" class="w-20 border rounded px-2 py-1">
          <button class="px-3 py-1 rounded bg-blue-600 text-white">อัปเดต</button>
        </form>
        <form method="POST" action="{{ route('cart.remove',$it) }}">
          @csrf @method('DELETE')
          <button class="px-3 py-1 rounded bg-red-600 text-white">ลบ</button>
        </form>
      </div>
    @empty
      <div class="opacity-60">ตะกร้าว่างเปล่า</div>
    @endforelse

    @php $subtotal = $cart->items->sum(fn($i)=> $i->quantity * ($i->product->price ?? 0)); @endphp
    <div class="text-right mt-4">
      <div class="text-lg">รวม: ฿{{ number_format($subtotal,2) }}</div>
      @if($cart->items->isNotEmpty())
        <a href="{{ route('checkout.summary') }}" class="inline-block mt-2 px-4 py-2 rounded bg-green-600 text-white">ไปหน้าชำระเงิน</a>
      @endif
    </div>
  </div>
</x-app-layout>
