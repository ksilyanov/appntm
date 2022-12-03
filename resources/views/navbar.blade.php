<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a style="min-width: 3em" href="{{ route('main') }}">
                        @include('components.application-logo', [
                            'attributes' => 'class = block h-9 w-auto fill-current text-gray-800',
                        ])
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
