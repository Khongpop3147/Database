@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Top Hero / Promo --}}
    <section class="relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50"></div>
            <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="relative z-10">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 -z-10 h-72 w-72 rounded-full bg-indigo-50 blur-3xl"></div>
                        <h1 class="animate-fade-in text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                            ช้อปง่าย ราคาดี ส่งไว
                        </h1>
                    <p class="mt-6 text-gray-600 text-lg sm:text-xl leading-relaxed">
                        ค้นหาสินค้าที่ใช่ พร้อม<span class="text-indigo-600 font-medium">โปรพิเศษประจำสัปดาห์</span> และการใช้งานที่เป็นมิตรต่อผู้ใช้
                    </p>

                    {{-- Search Bar --}}
                    <form action="{{ route('products.index') }}" method="GET" class="mt-8 relative">
                        <label class="sr-only" for="q">ค้นหาสินค้า</label>
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="q" name="q" type="text" value="{{ request('q') }}" 
                                    placeholder="ค้นหาชื่อสินค้า หมวดหมู่ หรือแบรนด์..."
                                    class="w-full rounded-2xl border-0 pl-12 pr-4 py-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            </div>
                            <button type="submit" 
                                class="rounded-2xl px-6 py-4 font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-500/25 hover:from-indigo-500 hover:to-purple-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                ค้นหา
                            </button>
                        </div>
                    </form>

                    {{-- CTAs --}}
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('products.index', ['sort' => 'popular']) }}" 
                            class="group relative inline-flex items-center gap-2 rounded-2xl bg-gray-900 text-white px-5 py-3 text-sm font-semibold transition-all duration-200 hover:bg-black hover:shadow-lg hover:shadow-gray-900/25">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 transition-transform duration-200 group-hover:scale-110 group-hover:text-yellow-400">
                                <path d="M12 .5l3.09 6.26L22 7.77l-5 4.87 1.18 6.88L12 16.9l-6.18 3.62L7 12.64l-5-4.87 6.91-1.01L12 .5z"/>
                            </svg>
                            ยอดนิยม
                        </a>
                        <a href="{{ route('products.index', ['sort' => 'new']) }}" 
                            class="group relative inline-flex items-center gap-2 rounded-2xl bg-white/75 backdrop-blur border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-900 transition-all duration-200 hover:border-indigo-400 hover:bg-white hover:shadow-lg hover:shadow-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-indigo-600 transition-transform duration-200 group-hover:scale-110">
                                <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                            </svg>
                            มาใหม่
                        </a>
                        <a href="{{ route('products.index', ['sort' => 'sale']) }}" 
                            class="group relative inline-flex items-center gap-2 rounded-2xl bg-rose-50 text-rose-700 border border-rose-200 px-5 py-3 text-sm font-semibold transition-all duration-200 hover:bg-rose-100 hover:border-rose-300 hover:shadow-lg hover:shadow-rose-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 transition-transform duration-200 group-hover:scale-110">
                                <path fill-rule="evenodd" d="M12 1.5c-1.921 0-3.816.111-5.68.327-1.497.174-2.57 1.46-2.57 2.93V21.75a.75.75 0 001.029.696l3.471-1.388 3.472 1.388a.75.75 0 00.556 0l3.472-1.388 3.471 1.388a.75.75 0 001.029-.696V4.757c0-1.47-1.073-2.756-2.57-2.93A49.255 49.255 0 0012 1.5zm3.53 7.28a.75.75 0 00-1.06-1.06l-6 6a.75.75 0 101.06 1.06l6-6zM8.625 9a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm5.625 3.375a1.125 1.125 0 100 2.25 1.125 1.125 0 000-2.25z" clip-rule="evenodd" />
                            </svg>
                            ลดราคา
                        </a>
                    </div>
                </div>

                <div class="relative lg:ml-4">
                    <div class="relative max-w-md mx-auto">
                        <div class="absolute -top-4 -right-4 -z-10 h-72 w-72 rounded-full bg-purple-50 blur-3xl"></div>
                        <div class="aspect-[16/9] w-full overflow-hidden rounded-3xl shadow-2xl ring-1 ring-gray-200 transition-transform duration-300 hover:scale-[1.02] relative">
                            <img src="{{ asset('/images/Property 1=Variant2.png') }}" alt="โปรโมชั่นสินค้าพิเศษ"
                                 class="h-full w-full object-cover object-center">

                            <!-- Overlay badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-3 py-1 text-white text-sm font-semibold shadow-md">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
                                    โปรโมชั่นสินค้าพิเศษ
                                </span>
                            </div>

                            <!-- Decorative gradient at bottom to improve caption contrast -->
                            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                        <div class="absolute -bottom-4 -right-4 hidden sm:block">
                            <div class="relative overflow-hidden rounded-2xl bg-white/95 backdrop-blur px-5 py-4 shadow-xl ring-1 ring-gray-200 transition-all duration-300 hover:shadow-2xl hover:ring-indigo-200">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5"></div>
                                <p class="relative text-sm text-gray-700">
                                    <span class="font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ฟรีจัดส่ง</span> 
                                    เมื่อซื้อครบ 999.-
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Popular Searches --}}
    <section class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-sm font-medium text-gray-500 mb-4">ค้นหายอดนิยม:</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('products.index', ['q' => 'ลดราคา']) }}" 
                    class="rounded-lg bg-gray-100 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-200">
                    🏷️ สินค้าลดราคา
                </a>
                <a href="{{ route('products.index', ['q' => 'มาใหม่']) }}" 
                    class="rounded-lg bg-gray-100 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-200">
                    ✨ สินค้ามาใหม่
                </a>
                <a href="{{ route('products.index', ['q' => 'แนะนำ']) }}" 
                    class="rounded-lg bg-gray-100 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-200">
                    👍 สินค้าแนะนำ
                </a>
                <a href="{{ route('products.index', ['q' => 'ขายดี']) }}" 
                    class="rounded-lg bg-gray-100 px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-200">
                    🔥 สินค้าขายดี
                </a>
            </div>
        </div>
    </section>

    {{-- Category Quick Picks --}}
    @php
        $hasCategories = isset($categories) && (is_countable($categories) ? count($categories) : $categories->count());
    @endphp
    @if($hasCategories)
        <section class="relative py-12 sm:py-16">
            <div class="absolute inset-0 bg-gradient-to-b from-white via-gray-50/50 to-white"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">เลือกตามหมวดหมู่</h2>
                    <a href="{{ route('products.index') }}" 
                        class="group inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                        ดูทั้งหมด
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                            class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="flex gap-4 overflow-x-auto no-scrollbar py-2">
                    @foreach(($categories ?? []) as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug ?? $cat->id]) }}" 
                            class="group relative flex flex-col items-center gap-3 shrink-0 rounded-2xl border border-gray-200 bg-white px-6 py-4 transition-all duration-200 hover:border-indigo-200 hover:bg-gradient-to-b hover:from-white hover:to-indigo-50/50 hover:shadow-lg hover:shadow-indigo-100">
                            <span class="relative h-12 w-12 rounded-xl bg-indigo-50 grid place-items-center transition-transform duration-200 group-hover:scale-110">
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-indigo-400/0 to-indigo-400/10 opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" 
                                    class="w-6 h-6 text-indigo-600 transition-colors duration-200">
                                    <path d="M3 7h18v2H3V7zm0 4h18v6H3v-6z"/>
                                </svg>
                            </span>
                            <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-700">{{ $cat->name ?? 'หมวดหมู่' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

 {{-- Featured Products (ภาพขนาดเท่ากัน + การ์ดมีช่องว่างห่างกันพอดี) --}}
<section class="py-12 bg-gray-50">
  <div class="mx-auto max-w-7xl px-8 sm:px-10 lg:px-12">
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-xl sm:text-2xl font-bold text-gray-900">สินค้าแนะนำ</h2>
      <a href="{{ route('products.index') }}" 
         class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 flex items-center gap-1">
         ดูทั้งหมด
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
           <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
         </svg>
      </a>
    </div>

    <!-- การ์ดเรียงเป็นแถว มีช่องว่างมากขึ้น -->
    <div class="flex flex-wrap justify-center gap-10 sm:gap-12 lg:gap-14">
      @foreach($featured as $product)
        @php
          $img = optional($product->images->first())->path;
          $src = $img
            ? (preg_match('~^https?://~i', $img)
                ? $img
                : (str_starts_with($img, '/storage/')
                    ? $img
                    : Storage::url(ltrim(preg_replace('~^public/~','',$img), '/'))))
            : asset('images/product-placeholder.jpg');
        @endphp

        <a href="{{ route('products.show', $product) }}"
           class="group block w-[220px] sm:w-[240px] lg:w-[260px] overflow-hidden rounded-2xl bg-white ring-1 ring-gray-200 shadow-sm hover:shadow-md hover:ring-indigo-200 transition">

          <!-- รูปภาพ: fix เป็นสี่เหลี่ยมจัตุรัส -->
          <div class="aspect-square overflow-hidden bg-gray-100 relative">
            <img src="{{ $src }}" 
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.05]">
            
            @if(isset($product->stock) && $product->stock <= 0)
              <span class="absolute right-2 top-2 inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                สินค้าหมด
              </span>
            @endif
          </div>

          <!-- รายละเอียดสินค้า -->
          <div class="p-4">
            <h3 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 line-clamp-2">
              {{ $product->name }}
            </h3>
            <p class="mt-1 text-base font-semibold text-gray-900">
              ฿{{ number_format($product->price, 2) }}
            </p>
            <p class="mt-1 text-xs text-gray-500 line-clamp-1">
              {{ Str::limit($product->description ?? 'Body text.', 50) }}
            </p>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>




   {{-- Latest Products (ภาพขนาดเท่ากัน + การ์ดคงที่) --}}
<section class="py-12 bg-gray-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-xl sm:text-2xl font-bold text-gray-900">สินค้ามาใหม่</h2>
      <a href="{{ route('products.index', ['sort' => 'new']) }}"
         class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
        ดูทั้งหมด →
      </a>
    </div>

    <div class="flex flex-wrap justify-center gap-6">
      @foreach($latest as $product)
        @php
          $img = optional($product->images->first())->path;
          $src = $img
            ? (preg_match('~^https?://~i', $img)
                ? $img
                : (str_starts_with($img, '/storage/')
                    ? $img
                    : Storage::url(ltrim(preg_replace('~^public/~','',$img), '/'))))
            : asset('images/product-placeholder.jpg');
        @endphp

        <a href="{{ route('products.show', $product) }}"
           class="group block w-[220px] sm:w-[240px] lg:w-[260px] overflow-hidden rounded-2xl bg-white ring-1 ring-gray-200 shadow-sm hover:shadow-md hover:ring-indigo-200 transition">

          {{-- รูป: บังคับสี่เหลี่ยมจัตุรัสให้เท่ากันทุกใบ --}}
          <div class="aspect-square overflow-hidden bg-gray-100 relative">
            <img
              src="{{ $src }}"
              alt="{{ $product->name }}"
              class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.05]"
            />

            @if(isset($product->stock) && $product->stock <= 0)
              <span class="absolute right-2 top-2 inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                สินค้าหมด
              </span>
            @endif
          </div>

          <div class="p-4">
            <h3 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 line-clamp-2">
              {{ $product->name }}
            </h3>
            <p class="mt-1 text-base font-semibold text-gray-900">
              ฿{{ number_format($product->price, 2) }}
            </p>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>


    {{-- Newsletter / Coupon --}}
    <section class="py-16 sm:py-24">
        <div class="relative mx-auto max-w-4xl">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm font-medium text-gray-500">ข้อเสนอพิเศษ</span>
            </div>

            <div class="relative mt-8 overflow-hidden rounded-3xl bg-gradient-to-br from-gray-900 via-gray-900 to-indigo-900">
                <div class="absolute inset-0">
                    <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-black/40"></div>
                    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[length:40px_40px]"></div>
                </div>
                
                <div class="relative px-6 py-12 sm:px-12 sm:py-16 text-center">
                    <div class="mx-auto max-w-2xl">
                        <h3 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                            รับคูปองส่วนลด 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-indigo-400">10%</span> 
                            สำหรับออเดอร์แรก
                        </h3>
                        <p class="mt-4 text-lg text-gray-300">
                            สมัครรับอัปเดตโปรโมชันและสินค้าใหม่ก่อนใคร พร้อมรับส่วนลดพิเศษ
                        </p>

                        {{-- ทางแก้ด่วน: ยังไม่ผูก route จริง ใช้ action="#" กัน error --}}
                        <form action="#" method="POST" class="mt-8">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-3 items-center justify-center">
                                <div class="relative w-full max-w-md">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                        </svg>
                                    </div>
                                    <label for="email" class="sr-only">อีเมล</label>
                                    <input id="email" name="email" type="email" required placeholder="your@email.com"
                                        class="block w-full rounded-xl border-0 bg-white/10 pl-12 pr-4 py-4 text-white placeholder-gray-400 backdrop-blur-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-white sm:text-sm">
                                </div>
                                <button type="submit" class="w-full sm:w-auto rounded-xl bg-white px-6 py-4 text-base font-semibold text-gray-900 shadow-sm transition-all duration-200 hover:bg-gray-100 hover:shadow-lg hover:shadow-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                                    รับคูปองเลย
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Decorative shapes --}}
                <div class="absolute -top-12 -left-12 h-px w-px">
                    <div class="absolute h-64 w-64 rounded-full bg-indigo-500 opacity-50 blur-3xl"></div>
                </div>
                <div class="absolute -bottom-12 -right-12 h-px w-px">
                    <div class="absolute h-64 w-64 rounded-full bg-purple-500 opacity-50 blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Back to top button --}}
    <button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg transition-all duration-300 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        style="opacity: 0; visibility: hidden; transform: translateY(20px);">
        <span class="sr-only">กลับขึ้นด้านบน</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    {{-- CSS for newsletter grid pattern --}}
    <style>
        .bg-grid-white {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h40v40H0V0zm1 1h38v38H1V1z' fill='%23FFFFFF' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>

    <script>
        // Back to top button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const backToTop = document.getElementById('backToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 500) {
                    backToTop.style.opacity = '1';
                    backToTop.style.visibility = 'visible';
                    backToTop.style.transform = 'translateY(0)';
                } else {
                    backToTop.style.opacity = '0';
                    backToTop.style.visibility = 'hidden';
                    backToTop.style.transform = 'translateY(20px)';
                }
            });
        });
    </script>
@endsection

@push('styles')
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endpush
