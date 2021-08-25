@extends('layouts.app', ['title' => 'Slider - Admin'])

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Slider
        </h2>

        {{-- content --}}
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">UPLOAD SLIDER</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700 text-sm font-semibold" for="image">GAMBAR</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white p-3 text-sm" type="file" name="image">
                        @error('image')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2 text-sm font-semibold">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 text-sm font-semibold" for="name">LINK SLIDER</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white text-sm" type="text" name="link" value="{{ old('link') }}" placeholder="Link Promo">
                        @error('link')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2 text-sm font-semibold">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="text-gray-100 focus:outline-none bg-purple-600 hover:bg-purple-700 px-4 py-2 dark:bg-purple-800 dark:hover:bg-purple-900 shadow-sm rounded-md text-sm font-semibold">UPLOAD</button>
                </div>
            </form>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 dark:bg-purple-800 w-full text-sm font-semibold">
                            <th class="px-16 py-2">
                                <span class="text-white">IMAGE</span>
                            </th>
                            <th class="px-16 py-2 text-center">
                                <span class="text-white">PROMO LINK</span>
                            </th>
                            <th class="px-16 py-2 text-center">
                                <span class="text-white">ACTION</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200 divide-y dark:divide-gray-700">
                        @forelse($sliders as $slider)
                            <tr class="text-center dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 bg-white">

                                <td class="px-16 py-2 flex justify-center">
                                    <img src="{{ $slider->image }}" class="object-fit-cover rounded" style="width: 35%">
                                </td>
                                <td class="px-16 py-2">
                                    {{ $slider->link }}
                                </td>
                                <td class="px-16 py-2">
                                    <button onClick="destroy(this.id)" id="{{ $slider->id }}"
                                        class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg hover:text-gray-100 hover:bg-red-500 dark:text-gray-400 dark:hover:text-gray-100 dark:hover:bg-red-700 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md text-sm font-semibold">
                                Not Available!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($sliders->hasPages())
                    <div class="bg-white p-3">
                        {{ $sliders->links('vendor.pagination.tailwind') }}
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
                    url: `/admin/slider/${id}`,
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
