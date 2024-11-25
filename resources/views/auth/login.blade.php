<x-guest-layout>
    <div class="flex flex-col justify-center items-center min-h-screen">
        <div class="bg-primary-default rounded-lg shadow-md md:w-1/3 p-2">
            <h1 class="text-2xl text-center font-bold">
                {{ __('Start Page') }}
            </h1>
            <a href="{{ route('github.redirect') }}"
                class="inline-flex justify-center items-center bg-primary-dark text-white rounded-xl px-4 py-2 font-bold w-full mt-2">
                <x-bi-github class="w-8 h-8 mr-2" />
                {{ __('Login with GitHub') }}
            </a>
        </div>
    </div>
</x-guest-layout>
