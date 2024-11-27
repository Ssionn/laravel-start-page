<div class="bg-primary-default rounded-lg shadow-md p-4 break-inside-avoid">
    <div class="relative">
        <input type="text" wire:model.live.debounce.500ms="search" wire:keydown.escape="$set('suggestions', [])"
            placeholder="Search projects..."
            class="px-4 py-2 border rounded-md w-full text-black focus:outline-none focus:ring-2 focus:ring-blue-500">

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
