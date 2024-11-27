<div class="bg-primary-default rounded-lg shadow-md break-inside-avoid p-4">
    <div class="inline-flex items-center justify-between w-full">
        <div class="flex flex-col items-start">
            <h1 class="text-lg font-bold">{{ $title }}</h1>
            <span class="text-xs text-gray-400 italic">
                {{ $description }}
            </span>
        </div>

        <livewire:refresh-button />
    </div>

    <div wire:poll.2s>
        @if (count($repos) === 0)
            <div class="text-center text-lg p-4">
                {{ __('No repositories found') }}
            </div>
        @else
            <div class="mt-4 space-y-2">
                @foreach ($repos as $repo)
                    <div class="flex justify-between bg-primary-dark rounded-lg shadow-md p-2 w-full">
                        <div class="flex justify-center flex-col items-start">
                            <a href="{{ $repo->html_url }}" target="_blank" class="hover:underline font-bold">
                                {{ $repo->full_name }}
                            </a>
                            <span class="text-xs text-gray-400 italic">{{ $repo->description }}</span>
                        </div>

                        <div>
                            <div class="flex flex-col items-end">
                                <div class="flex flex-col items-end">
                                    @if ($repo->commits->count() > 0)
                                        <span class="text-sm text-semibold text-gray-400">
                                            Commits: {{ count($repo->commits) }}
                                        </span>
                                        <span class="text-sm font-bold text-gray-400">
                                            {{ $repo->commits->first()->smallerSha() }}
                                        </span>
                                    @endif
                                </div>

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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
