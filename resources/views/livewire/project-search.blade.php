<div class="bg-primary-default rounded-lg shadow-md p-4 break-inside-avoid">
    <div class="relative">
        <div class="flex justify-between items-center">
            <div class="flex flex-col items-start">
                <h1 class="text-lg font-bold">{{ $title }}</h1>
                <span class="text-xs text-gray-400 italic">
                    {{ $description }}
                </span>
            </div>
            <livewire:index-button />
        </div>

        <input type="text" wire:model.live="search" wire:keydown.escape="$set('suggestions', [])"
            placeholder="Search repositories" autocomplete="off" spellcheck="false"
            class="mt-4 px-4 py-2 border rounded-md w-full bg-primary-dark border-primary-dark focus:outline-none focus:border-primary-dark focus:ring-1 focus:ring-primary-dark" />

        @if (count($suggestions) > 0)
            <div class="absolute z-10 w-full bg-primary-default border border-primary-dark rounded shadow-lg">
                @foreach ($suggestions as $project)
                    <a href="https://github.com/{{ $project->full_name }}" target="_blank">
                        <div wire:click="selectSearchTerm({{ $project->id }})"
                            class="p-2 hover:bg-primary-dark cursor-pointer">
                            <div class="font-bold">{{ $project->full_name }}</div>
                            @if ($project->description)
                                <p class="text-xs text-gray-500">{{ $project->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
