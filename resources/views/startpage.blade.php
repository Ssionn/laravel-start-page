<x-app-layout>
    <div class="flex flex-col w-full px-4">
        <x-navigation />
        <div class="mt-4">
            <!-- Masonry Container -->
            <div class="columns-1 sm:columns-2 gap-4 space-y-4">
                <!-- Full Repository Section as a Single Item -->
                <div class="bg-primary-default rounded-lg shadow-md break-inside-avoid p-4">
                    <!-- Header -->
                    <div class="inline-flex items-center justify-between w-full">
                        <div class="flex flex-col items-start">
                            <h1 class="text-lg font-bold">{{ __('Recent Repositories') }}</h1>
                            <span class="text-xs text-gray-400 italic">
                                {{ __('*Loading project may take a while so be patient!') }}
                            </span>
                        </div>
                        <div x-data="{ isLoading: false }">
                            <button @click="submitForm" :disabled="isLoading"
                                class="bg-primary-dark text-white rounded-xl px-4 py-2 font-bold">
                                <span x-show="!isLoading">{{ __('Refresh') }}</span>
                                <span x-show="isLoading" class="">
                                    <x-css-spinner-alt class="w-4 h-4 animate-spin" />
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Repositories -->
                    @if (count($repos) === 0)
                        <div class="text-center text-lg p-4">
                            {{ __('No repositories found') }}
                        </div>
                    @else
                        <div class="mt-4 space-y-2">
                            @foreach ($repos as $repo)
                                <div class="flex justify-between bg-primary-dark rounded-lg shadow-md p-2 w-full">
                                    <div class="flex justify-center flex-col items-start">
                                        <a href="{{ $repo->html_url }}" target="_blank"
                                            class="hover:underline font-bold">
                                            {{ $repo->name }}
                                        </a>
                                        <span class="text-xs text-gray-400 italic">{{ $repo->description }}</span>
                                    </div>

                                    <div>
                                        <div class="flex flex-col items-end">
                                            <div class="">
                                                @if ($repo->pullRequests->count() > 0)
                                                    <a href="{{ $repo->pullRequests->first()->html_url ?? '#' }}"
                                                        class="inline-flex items-center hover:border-[1px] p-1 hover:border-primary-default rounded-lg text-sm">
                                                        <x-eos-pull-request-o class="w-4 h-4 mr-2" />
                                                        <span class="">{{ $repo->pullRequests->title }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-sm text-semibold text-gray-400">
                                                        {{ __('❌ No Pull Request') }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="flex flex-col items-end">
                                                @if ($repo->commits->count() > 0)
                                                    <span class="text-sm font-bold text-gray-400">
                                                        {{ $repo->commits->first()->smallerSha() }}
                                                    </span>
                                                    <span class="text-sm text-semibold text-gray-400">
                                                        Commits: {{ count($repo->commits) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Additional Items -->
                <div class="bg-primary-default rounded-lg shadow-md p-4 break-inside-avoid">
                    <!-- Add any additional content -->
                </div>

                <div class="bg-primary-default rounded-lg shadow-md p-4 break-inside-avoid">
                    <!-- Add any additional content -->
                </div>

            </div>
        </div>


        <script>
            function submitForm() {
                this.isLoading = true;

                axios.post('/refresh')
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            window.location.reload();
                            this.isLoading = false;
                        }, 3500);
                    });
            }
        </script>
</x-app-layout>
