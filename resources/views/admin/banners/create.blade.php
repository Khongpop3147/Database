<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New Banner') }}
            </h2>
            <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Banners
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" x-data="{ imagePreview: null }">
                        @csrf

                        {{-- Banner Image --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Banner Image <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition"
                                 @dragover.prevent="$el.classList.add('border-blue-500', 'bg-blue-50')"
                                 @dragleave.prevent="$el.classList.remove('border-blue-500', 'bg-blue-50')"
                                 @drop.prevent="
                                     $el.classList.remove('border-blue-500', 'bg-blue-50');
                                     let file = $event.dataTransfer.files[0];
                                     if (file && file.type.startsWith('image/')) {
                                         $refs.imageInput.files = $event.dataTransfer.files;
                                         let reader = new FileReader();
                                         reader.onload = (e) => imagePreview = e.target.result;
                                         reader.readAsDataURL(file);
                                     }
                                 ">
                                <div class="space-y-1 text-center">
                                    <template x-if="!imagePreview">
                                        <div>
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="banner-image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                    <span>Upload a file</span>
                                                    <input id="banner-image" 
                                                           name="image" 
                                                           type="file" 
                                                           class="sr-only"
                                                           accept="image/*"
                                                           required
                                                           x-ref="imageInput"
                                                           @change="
                                                               let file = $event.target.files[0];
                                                               if (file) {
                                                                   let reader = new FileReader();
                                                                   reader.onload = (e) => imagePreview = e.target.result;
                                                                   reader.readAsDataURL(file);
                                                               }
                                                           ">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </template>
                                    
                                    <template x-if="imagePreview">
                                        <div class="relative">
                                            <img :src="imagePreview" class="mx-auto h-48 rounded-lg object-cover">
                                            <button type="button" 
                                                    @click="
                                                        imagePreview = null;
                                                        let input = $refs.imageInput;
                                                        input.value = '';
                                                        let newInput = input.cloneNode(true);
                                                        input.parentNode.replaceChild(newInput, input);
                                                    "
                                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title (Optional)
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter banner title...">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="mb-6">
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                Display Order
                            </label>
                            <input type="number" 
                                   name="order" 
                                   id="order" 
                                   value="0"
                                   min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0">
                            <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                            @error('order')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Active Status --}}
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       checked
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Active (Display on homepage)</span>
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex gap-3">
                            <button type="submit" 
                                    class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                Create Banner
                            </button>
                            <a href="{{ route('admin.banners.index') }}" 
                               class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
