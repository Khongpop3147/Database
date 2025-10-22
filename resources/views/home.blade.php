<x-app-layout>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Welcome</h1>
    <h2 class="text-xl font-semibold mb-3">สินค้าใหม่ล่าสุด</h2>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($latest as $p)
        <a href="{{ route('products.show',$p) }}" class="border rounded-xl p-4 block">
          <div class="font-semibold">{{ $p->name }}</div>
          <div class="opacity-70">฿{{ number_format($p->price,2) }}</div>
        </a>
      @endforeach
    </div>
  </div>
</x-app-layout>
