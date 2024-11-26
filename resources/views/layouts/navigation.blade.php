<div class="mt-4 py-2 px-8 bg-primary-default rounded-lg shadow-md w-full">
    <div class="flex flex-row items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">
                {{ __('Start Page') }}
            </h1>
        </div>
        <div class="flex items-center">
            <button id="profileDropdownButton" data-dropdown-toggle="profileDropdown" type="button"
                class="inline-flex items-center space-x-2">
                <img src="{{ auth()->user()->github_avatar }}" class="w-8 h-8 rounded-full" />
                <span class="font-semibold text-sm">{{ auth()->user()->username }}</span>
            </button>
        </div>
    </div>

    <div id="profileDropdown" class="z-10 hidden bg-primary-default divide-y divide-gray-100 rounded-lg shadow w-44">
        <ul class="py-2 text-sm text-white" aria-labelledby="dropdownDefaultButton">
            <li class="px-1">
                <a href="https://github.com/{{ auth()->user()->username }}" target="_blank"
                    class="block px-4 py-2 hover:bg-primary-dark rounded-lg">
                    {{ __('Open Github') }}
                </a>
            </li>
            <li class="px-1">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="text-start block px-4 py-2 hover:bg-primary-dark rounded-lg w-full">
                        {{ __('Sign out') }}
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
