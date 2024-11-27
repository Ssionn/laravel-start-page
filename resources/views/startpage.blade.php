<x-app-layout>
    <div class="flex flex-col w-full px-4">
        <x-navigation />
        <div class="mt-4">
            <div class="columns-1 sm:columns-2 gap-4 space-y-4">
                <livewire:github-repository />

                <livewire:project-search />

                <div class="bg-primary-default rounded-lg shadow-md p-4 break-inside-avoid">
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('livewire:load', () => {
                Livewire.onPageExpired((response, message) => {
                    window.location.reload();
                })
            })

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
