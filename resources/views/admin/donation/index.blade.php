@extends('layouts.app', ['title' => 'Donation - Admin'])

@section('content')
<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Donation
        </h2>

        {{-- content --}}
        <form action="{{ route('admin.donation.firter') }}" method="GET">
            <div class="flex gap-6">

                <div class="flex-auto">
                    <label class="text-gray-700 dark:text-gray-200 text-sm font-semibold" for="name">TANGGAL AWAL</label>
                    <input class="form-input w-full mt-2 rounded-md bg-white p-2 shadow-md text-sm focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" type="date" name="date_from"
                        value="{{ old('date_form') ?? request()->query('date_from') }}">
                    @error('date_from')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="flex-auto">
                    <label class="text-gray-700 dark:text-gray-200 text-sm font-semibold" for="name">TANGGAL AKHIR</label>
                    <input class="form-input w-full mt-2 rounded-md bg-white p-2 shadow-md text-sm focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" type="date" name="date_to"
                        value="{{ old('date_to') ?? request()->query('date_to') }}">
                    @error('date_to')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="flex-1">
                    <button type="submit"
                        class="text-gray-100 focus:outline-none bg-purple-600 dark:bg-purple-800 hover:bg-purple-700 dark:hover:bg-purple-900 px-4 py-2 shadow-sm rounded-md text-sm font-semibold mt-8">FILTER</button>
                </div>

            </div>
        </form>


        @if($donations ?? '')

            @if(count($donations) > 0)

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                        <table class="min-w-full table-auto">
                            <thead class="justify-between">
                                <tr class="bg-gray-600 text-center dark:bg-purple-800 w-full text-sm font-semibold">
                                    <th class="px-16 py-2">
                                        <span class="text-white">NAME</span>
                                    </th>
                                    <th class="px-16 py-2 text-left">
                                        <span class="text-white">CAMPAIGN</span>
                                    </th>
                                    <th class="px-16 py-2 text-left">
                                        <span class="text-white">DATE</span>
                                    </th>
                                    <th class="px-16 py-2 text-center">
                                        <span class="text-white">AMOUNT</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-200 divide-y dark:divide-gray-700">
                                @forelse($donations as $donation)
                                    <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">

                                        <td class="px-16 py-2 flex justify-center">
                                            {{ $donation->donatur->name }}
                                        </td>
                                        <td class="px-16 py-2">
                                            {{ $donation->campaign->title }}
                                        </td>
                                        <td class="px-16 py-2">
                                            {{ $donation->created_at }}
                                        </td>
                                        <td class="px-5 py-2 text-right">
                                            {{ moneyFormat($donation->amount) }}
                                        </td>
                                    </tr>
                                @empty
                                    <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md capitalize">
                                        Not Available!
                                    </div>
                                @endforelse
                                <tr class="border bg-gray-600 text-white font-bold">
                                    <td colspan="3" class="px-5 py-2 justify-center">
                                        TOTAL DONASI
                                    </td>
                                    <td colspan="3" class="px-5 py-2 text-right">
                                        {{ moneyFormat($total) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            @endif

        @endif
        {{-- end of content --}}

    </div>
</main>
@endsection
