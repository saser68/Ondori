@if (auth()->check())
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="relative">
            <button type="button" class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700">
                        {{ strtoupper(substr(auth()->user()->getNameAttribute(), 0, 1)) }}
                    </span>
                </div>
            </button>
        </div>
    </div>
@endif
