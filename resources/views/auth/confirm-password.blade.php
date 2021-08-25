@extends('layouts.auth', ['title' => 'Forgot Password - Admin'])

@section('content')
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                    src="{{asset('img/forgot-password-office.jpeg')}}" alt="Office" />
                <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                    src="{{asset('img/forgot-password-office-dark.jpeg')}}" alt="Office" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Confirm password
                    </h1>
                    @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form class="mt-4" action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <label class="block mt-3">
                <span class="text-gray-700 text-sm">Password</span>
                <input type="password" name="password" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600"
                    placeholder="Password">
                @error('password')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>

            <div class="mt-6">
                <button type="submit"
                    class="py-2 px-4 text-center bg-indigo-600 rounded-md w-full text-white text-sm hover:bg-indigo-500 focus:outline-none">
                    CONFIRM PASSWORD
                </button>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
