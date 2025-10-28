<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">รายการโปรด</h1>
                <p class="text-gray-600 mt-2">สินค้าที่คุณชื่นชอบทั้งหมด</p>
            </div>

            @if($wishlists->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($wishlists as $wishlist)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                            {{-- Product Image --}}
                            <a href="{{ route('products.show', $wishlist->product) }}" class="block">
                                <div class="relative h-48 bg-gray-200">
                                    @if($wishlist->product->images->first())
                                        <img src="{{ asset('storage/' . $wishlist->product->images->first()->path) }}" 
                                             alt="{{ $wishlist->product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            {{-- Product Info --}}
                            <div class="p-4">
                                <a href="{{ route('products.show', $wishlist->product) }}" class="block">
                                    <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors line-clamp-2 mb-2">
                                        {{ $wishlist->product->name }}
                                    </h3>
                                </a>
                                
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xl font-bold text-blue-600">
                                        ฿{{ number_format($wishlist->product->price, 2) }}
                                    </span>
                                    
                                    {{-- Remove from Wishlist --}}
                                    <form action="{{ route('wishlist.toggle', $wishlist->product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 transition-colors"
                                                title="ลบออกจากรายการโปรด">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">ยังไม่มีสินค้าในรายการโปรด</h3>
                    <p class="text-gray-600 mb-6">เริ่มเพิ่มสินค้าที่คุณชอบเข้ามาในรายการโปรดกันเลย!</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        เลือกซื้อสินค้า
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
