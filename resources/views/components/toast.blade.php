@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-toast', (event) => {
                const toast = document.getElementById('toast-notification');
                const toastMessage = document.getElementById('toast-message');
                const toastType = event[0].type || 'success';
                const message = event[0].message || 'Something went wrong!';

                // Set message
                toastMessage.textContent = message;

                // Set color based on type
                toast.classList.remove('bg-green-500', 'bg-red-500');
                if (toastType === 'success') {
                    toast.classList.add('bg-green-500');
                } else {
                    toast.classList.add('bg-red-500');
                }

                // Show toast
                toast.classList.remove('hidden');
                toast.classList.add('flex');

                // Hide after 3 seconds
                setTimeout(() => {
                    toast.classList.add('hidden');
                    toast.classList.remove('flex');
                }, 3000);
            });
        });
    </script>
@endpush

<div id="toast-notification" class="hidden fixed top-5 right-5 z-50 items-center w-full max-w-xs p-4 space-x-4 text-white bg-green-500 rounded-lg shadow" role="alert">
    <div id="toast-message" class="text-sm font-normal"></div>
</div>
