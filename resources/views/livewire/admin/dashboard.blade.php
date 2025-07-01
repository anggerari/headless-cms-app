<div>
    {{-- Page Title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Welcome Message --}}
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-gray-900">
                        Welcome to your Headless CMS!
                    </h1>

                    <p class="mt-4 text-gray-500 leading-relaxed">
                        This is the central hub for managing all your content. From here you can create, edit, and publish posts, pages, and more. Use the navigation bar above to get started.
                    </p>
                </div>

                {{-- Stats Grid --}}
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">

                    <!-- Posts Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-medium text-gray-600">Total Posts</p>
                            <p class="text-2xl font-semibold text-gray-700">{{ $postCount }}</p>
                        </div>
                    </div>

                    <!-- Pages Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0011.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-medium text-gray-600">Total Pages</p>
                            <p class="text-2xl font-semibold text-gray-700">{{ $pageCount }}</p>
                        </div>
                    </div>

                    <!-- Categories Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                        <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-medium text-gray-600">Total Categories</p>
                            <p class="text-2xl font-semibold text-gray-700">{{ $categoryCount }}</p>
                        </div>
                    </div>

                    <!-- Users Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-medium text-gray-600">Total Users</p>
                            <p class="text-2xl font-semibold text-gray-700">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
