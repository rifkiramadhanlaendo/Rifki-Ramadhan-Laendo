<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-blue-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white shadow-xl rounded-xl p-8 border-t-4 border-blue-600">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Category</h2>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>