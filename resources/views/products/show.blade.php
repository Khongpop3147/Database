<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-2">
                <!-- Product Images -->
                <div class="lg:row-span-2">
                    <div class="aspect-h-1 aspect-w-1 w-full">
                        @if($product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                alt="{{ $product->name }}" 
                                class="h-full w-full rounded-2xl object-cover object-center sm:rounded-lg">
                        @else
                            <div class="h-full w-full rounded-2xl bg-gray-100 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    @if($product->images->count() > 1)
                        <div class="mt-4 grid grid-cols-4 gap-4">
                            @foreach($product->images as $image)
                                <div class="aspect-h-1 aspect-w-1 relative">
                                    <img src="{{ asset('storage/' . $image->path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="h-full w-full rounded-lg object-cover object-center cursor-pointer 
                                            {{ $image->is_primary ? 'ring-2 ring-indigo-600' : 'hover:ring-2 hover:ring-gray-300' }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="lg:max-w-lg">
                    <div class="mt-4 flex items-center justify-between">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->name }}</h1>
                        <p class="text-2xl font-medium tracking-tight text-gray-900">฿{{ number_format($product->price, 2) }}</p>
                    </div>

                    @if($product->category)
                        <div class="mt-4">
                            <a href="{{ route('products.index', ['category' => $product->category->id]) }}" 
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                {{ $product->category->name }}
                            </a>
                        </div>
                    @endif

                    @if($product->description)
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-900">รายละเอียด</h3>
                            <div class="mt-2 space-y-4 text-sm text-gray-600">
                                {{ $product->description }}
                            </div>
                        </div>
                    @endif

                    <!-- Stock Status -->
                    <div class="mt-6">
                        <div class="flex items-center">
                            @if($product->stock > 0)
                                <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-green-600">มีสินค้าในสต็อก {{ $product->stock }} ชิ้น</p>
                            @else
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-red-600">สินค้าหมด</p>
                            @endif
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-8">
                        @csrf
                        <button type="submit" 
                            class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <svg class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3h13.825c.646 0 1.154.588.994 1.215l-2 7.95a1.75 1.75 0 01-1.696 1.335h-9.38l.15.689a.75.75 0 00.736.597h11.566a.75.75 0 010 1.5H7.801a2.25 2.25 0 01-2.208-1.79l-2.537-11.64a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM4 17a2 2 0 112-2 2 2 0 01-2 2zm12 0a2 2 0 112-2 2 2 0 01-2 2z" />
                            </svg>
                            เพิ่มลงตะกร้า
                        </button>
                    </form>
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
