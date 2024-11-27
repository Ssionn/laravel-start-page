<button wire:click="loadScout"
    class="bg-primary-dark text-white rounded-xl px-4 py-2 font-bold flex flex-row items-center gap-2">
    <x-css-spinner-alt wire:loading wire:target="loadScout" class="w-4 h-4 animate-spin" />
    <span wire:loading wire:target="loadScout" class="flex items-center gap-2">
        {{ __('Re-Indexing') }}
    </span>
    <span wire:loading.remove>
        {{ __('Re-Index') }}
    </span>
</button>
