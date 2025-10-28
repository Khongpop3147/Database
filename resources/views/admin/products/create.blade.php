<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-900">เพิ่มสินค้าใหม่</h1>
            <a href="{{ route('admin.products.index') }}" 
                class="mt-3 sm:mt-0 inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-700">
                <svg class="mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
                </svg>
                กลับไปหน้ารายการสินค้า
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">พบข้อผิดพลาด {{ count($errors) }} รายการ</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Debug Information --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 rounded-lg">
                <h3 class="text-sm font-medium text-red-800">Debugging Information:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" 
            action="{{ route('admin.products.store') }}" 
            enctype="multipart/form-data" 
            class="space-y-6 bg-white rounded-xl border border-gray-200 p-6">
            @csrf

            <div class="space-y-6">
                <!-- Product Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">รูปภาพสินค้า</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg relative">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text-sm text-gray-600">
                                <input id="images" name="images[]" type="file" 
                                    class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-600
                                        hover:file:bg-indigo-100
                                        cursor-pointer" 
                                    multiple 
                                    accept="image/jpeg,image/png,image/webp"
                                    onchange="previewImages(event)">
                                <p class="mt-1 text-xs text-gray-500">เลือกไฟล์ภาพได้หลายไฟล์ (สูงสุด 5 ไฟล์)</p>
                            </div>

                            {{-- Show upload errors --}}
                            @error('images')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @foreach($errors->get('images.*') as $messages)
                                @foreach($messages as $message)
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @endforeach
                            @endforeach
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP ขนาดไม่เกิน 5MB</p>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="hidden absolute inset-0 p-4 bg-white">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 overflow-y-auto max-h-full">
                                <!-- Preview images will be inserted here -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="name">ชื่อสินค้า</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="category">หมวดหมู่</label>
                        <select name="category_id" id="category"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">— เลือกหมวดหมู่ —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="stock">จำนวนสินค้าคงเหลือ</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="price">ราคา (บาท)</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">฿</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                step="0.01" min="0"
                                class="block w-full rounded-lg border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500" 
                                placeholder="0.00" required>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm">THB</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="description">รายละเอียดสินค้า</label>
                        <textarea name="description" id="description" rows="5"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" 
                    class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    ยกเลิก
                </a>
                <button type="submit" 
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    บันทึกสินค้า
                </button>
            </div>
        </form>

        @push('scripts')
        <script>
            function previewImages(event) {
                const preview = document.getElementById('imagePreview');
                const previewGrid = preview.querySelector('div');
                previewGrid.innerHTML = ''; // Clear existing previews
                
                if (event.target.files && event.target.files.length > 0) {
                    preview.classList.remove('hidden');
                    
                    Array.from(event.target.files).forEach((file, index) => {
                        if (!file.type.startsWith('image/')) return;
                        
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const div = document.createElement('div');
                            div.className = 'relative group aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100';
                            div.innerHTML = `
                                <img src="${e.target.result}" alt="Preview" class="h-full w-full object-cover">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 bg-black/50 group-hover:opacity-100 transition-opacity">
                                    <button type="button" onclick="removeImage(${index}, this)" class="rounded-full p-1.5 text-white hover:text-red-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            `;
                            previewGrid.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    preview.classList.add('hidden');
                }
            }

            function removeImage(index, button) {
                const input = document.getElementById('images');
                const container = button.closest('.relative');
                
                // Create a new FileList without the removed image
                const dt = new DataTransfer();
                Array.from(input.files).forEach((file, i) => {
                    if (i !== index) dt.items.add(file);
                });
                
                input.files = dt.files;
                container.remove();
                
                // Hide preview if no images left
                if (input.files.length === 0) {
                    document.getElementById('imagePreview').classList.add('hidden');
                }
            }
        </script>
        @endpush
    </div>

    @push('scripts')
    <script>
        function previewImages(event) {
            const preview = document.getElementById('imagePreview');
            const previewGrid = preview.querySelector('div');
            previewGrid.innerHTML = ''; // Clear existing previews
            
            if (event.target.files && event.target.files.length > 0) {
                preview.classList.remove('hidden');
                
                Array.from(event.target.files).forEach((file, index) => {
                    if (!file.type.startsWith('image/')) return;
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const div = document.createElement('div');
                        div.className = 'relative group aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="h-full w-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 bg-black/50 group-hover:opacity-100 transition-opacity">
                                <button type="button" onclick="removeImage(${index}, this)" class="rounded-full p-1.5 text-white hover:text-red-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        `;
                        previewGrid.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                preview.classList.add('hidden');
            }
        }

        function removeImage(index, button) {
            const input = document.getElementById('images');
            const container = button.closest('.relative');
            
            // Create a new FileList without the removed image
            const dt = new DataTransfer();
            Array.from(input.files).forEach((file, i) => {
                if (i !== index) dt.items.add(file);
            });
            
            input.files = dt.files;
            container.remove();
            
            // Hide preview if no images left
            if (input.files.length === 0) {
                document.getElementById('imagePreview').classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-app-layout>
