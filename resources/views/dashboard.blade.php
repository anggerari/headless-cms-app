<x-app-layout>
    {{--
        This file has been updated to render our custom admin dashboard component.
        Instead of showing the default Jetstream welcome screen, we are now
        embedding the Livewire component that contains our application's
        statistics and welcome message.
    --}}
    @livewire('admin.dashboard')
</x-app-layout>
