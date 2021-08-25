@extends('layouts.app', ['title' => 'Category - Admin'])

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Category
        </h2>

        {{-- content --}}
        <div class="flex items-center">
            <button
                class="text-gray-100 focus:outline-none bg-purple-600 dark:bg-purple-800 hover:bg-purple-700 dark:hover:bg-purple-900 px-4 py-2 shadow-sm rounded-md text-sm font-semibold">
                <a href="{{ route('admin.category.create') }}">Add Category</a>
            </button>

            <div class="relative mx-4">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <form action="{{ route('admin.category.index') }}" method="GET">
                        <input
                            class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-200 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                            type="text" name="q" placeholder="Search" value="{{ request()->query('q') }}"
                            aria-label="Search" />
                    </form>
                </div>
            </div>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 text-center dark:bg-purple-800 w-full">
                            <th class="px-16 py-2">
                                <span class="text-white text-sm font-semibold">IMAGE</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white text-sm font-semibold">CATEGORY NAME</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white text-sm font-semibold">ACTION</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200 divide-y dark:divide-gray-700">
                        @forelse($categories as $category)
                        <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">

                            <td class="px-16 py-2 flex justify-center">
                                <img src="{{ $category->image }}" class="w-20 h-100 object-fit-cover rounded-md">
                            </td>
                            <td class="px-16 py-2">
                                {{ $category->name }}
                            </td>
                            <td class="px-16 py-2">
                                <div class="flex justify-center space-x-4 text-sm">
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                        class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 hover:text-gray-100 hover:bg-yellow-300 rounded-lg dark:text-gray-400 dark:hover:text-gray-100 dark:hover:bg-yellow-500 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button onClick="destroy(this.id)" id="{{ $category->id }}"
                                        class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg hover:text-gray-100 hover:bg-red-500 dark:text-gray-400 dark:hover:text-gray-100 dark:hover:bg-red-700 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <div
                            class="bg-red-500 dark:bg-red-500 text-white text-center p-3 rounded-sm shadow-md text-sm font-semibold capitalize">
                            Not Available!
                        </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($categories->hasPages())
                <div class="bg-white p-3">
                    {{ $categories->links('vendor.pagination.tailwind') }}
                </div>
                @endif
            </div>
        </div>
        {{-- end of content --}}

    </div>
</main>
<script>
    //ajax delete
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `/admin/category/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
</script>
@endsection
