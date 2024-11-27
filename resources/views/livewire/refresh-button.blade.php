<button wire:click="refresh"
    class="bg-primary-dark text-white rounded-xl px-4 py-2 font-bold flex flex-row items-center gap-2">
    <x-css-spinner-alt wire:loading wire:target="refresh" class="w-4 h-4 animate-spin" />
    <span wire:loading wire:target="refresh" class="flex items-center gap-2">
        {{ __('Refreshing') }}
    </span>
    <span wire:loading.remove>
        {{ __('Refresh') }}
    </span>
</button>
