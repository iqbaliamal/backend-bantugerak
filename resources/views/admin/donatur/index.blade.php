@extends('layouts.app', ['title' => 'Donatur - Admin'])

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Donatur
        </h2>

        {{-- content --}}
        <div class="flex items-center">
            <div class="relative">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <form action="{{ route('admin.donatur.index') }}" method="GET">
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
                        <tr class="bg-gray-600 dark:bg-purple-800 w-full text-sm font-semibold">
                            <th class="px-16 py-2">
                                <span class="text-white">FULL NAME</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">EMAIL</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200 divide-y dark:divide-gray-700">
                        @forelse($donaturs as $donatur)
                            <tr class="text-center dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 bg-white">

                                <td class="px-5 py-2">
                                    {{ $donatur->name }}
                                </td>

                                <td class="px-16 py-2">
                                    {{ $donatur->email }}
                                </td>

                            </tr>
                        @empty
                            <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md text-sm font-semibold">
                                Not Available!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($donaturs->hasPages())
                    <div class="bg-white p-3">
                        {{ $donaturs->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
        {{-- end of content --}}

    </div>
</main>
@endsection
