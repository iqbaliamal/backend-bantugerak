@extends('layouts.app', ['title' => 'Add Category - Admin'])

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Category
        </h2>

        {{-- content --}}
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold">Add Category</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700 text-sm font-semibold" for="image">Image</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white p-3 text-sm" type="file" name="image">
                        @error('image')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 text-sm font-semibold" for="name">Category Name</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white text-sm" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Kategori">
                        @error('name')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 text-sm font-semibold bg-purple-600 text-gray-200 rounded-md hover:bg-purple-700 focus:outline-none focus:bg-purple-800">Save</button>
                </div>
            </form>
        </div>
        {{-- end of content --}}

    </div>
</main>
@endsection
