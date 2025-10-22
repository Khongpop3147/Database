<x-app-layout>
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">สรุปรายการ</h1>

    @foreach($cart->items as $it)
      <div class="flex justify-between border rounded p-3 mb-2">
        <div>{{ $it->product->name }}</div>
        <div>x{{ $it->quantity }}</div>
        <div>฿{{ number_format(($it->product->price ?? 0) * $it->quantity, 2) }}</div>
      </div>
    @endforeach

    <div class="text-right text-lg mt-4">รวมทั้งหมด: ฿{{ number_format($subtotal,2) }}</div>

    <form method="POST" action="{{ route('checkout.confirm') }}" class="text-right mt-4">
      @csrf
      <button class="px-4 py-2 rounded bg-green-600 text-white">ยืนยันสั่งซื้อ</button>
    </form>
  </div>
</x-app-layout>
