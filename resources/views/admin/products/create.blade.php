<x-app-layout>
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">New Product</h1>

    @if ($errors->any())
      <div class="mb-3 p-3 rounded bg-red-100 text-red-800">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm mb-1">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
      </div>

      <div>
        <label class="block text-sm mb-1">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
          <option value="">— None —</option>
          @foreach($categories as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
        </select>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">Price</label>
          <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
          <label class="block text-sm mb-1">Stock</label>
          <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
        </div>
      </div>

      <div>
        <label class="block text-sm mb-1">Description</label>
        <textarea name="description" rows="5" class="w-full border rounded px-3 py-2"></textarea>
      </div>

      <div class="pt-2">
        <button class="px-4 py-2 rounded bg-green-600 text-white">Create</button>
        <a href="{{ route('admin.products.index') }}" class="ml-2 px-4 py-2 rounded border">Cancel</a>
      </div>
    </form>
  </div>
</x-app-layout>
