<nav
    x-data="lanternNav()"
    x-init="init()"
    class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50"
>

    <!-- Mobile backdrop -->
    <div
        x-show="open"
        x-transition.opacity
        @click="open = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden"
    ></div>

    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24 gap-4">

            <!-- LOGO + TITLE (SHIFTED RIGHT) -->
            <div class="flex items-center gap-3 shrink-0 pl-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group no-underline hover:no-underline">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="RMS Logo"
                        class="h-14 w-auto transition-transform duration-300 group-hover:scale-105"
                    />
                    <span class="hidden sm:block font-extrabold tracking-[0.25em] text-slate-800 uppercase text-lg lg:text-xl no-underline">
                        Restaurant Management System
                    </span>
                </a>
            </div>

            <!-- CENTER SPACE -->
            <div class="hidden lg:flex flex-1 justify-center gap-8">
                <a href="{{ route('staff.apply') }}" class="text-slate-600 hover:text-purple-600 font-bold transition no-underline hover:no-underline">Staff Application</a>
                <a href="{{ route('report.create') }}" class="text-slate-600 hover:text-purple-600 font-bold transition no-underline hover:no-underline">Reports</a>
                <a href="/faq" class="text-slate-600 hover:text-purple-600 font-bold transition no-underline hover:no-underline">FAQ</a>
                <a href="{{ route('branches.index') }}" class="text-slate-600 hover:text-purple-600 font-bold transition no-underline hover:no-underline">Branch</a>
            </div>

            <!-- USER AVATAR -->
            <div class="hidden sm:flex items-center gap-3 shrink-0 mr-4">
                <x-dropdown align="right" width="48" content-classes="bg-transparent shadow-none p-0">
                    <x-slot name="trigger">
                        <button
                            class="group inline-flex items-center justify-center h-14 w-14 rounded-full
                                border-4 border-slate-100 bg-purple-600 text-white font-black text-xl
                                hover:border-purple-400 hover:scale-105
                                transition-all duration-300 shadow-lg focus:outline-none"
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-slate-200">
                            <x-dropdown-link
                                :href="route('profile.edit')"
                                class="block rounded-xl px-4 py-2.5 text-sm font-semibold
                                    text-slate-700 hover:bg-purple-50 hover:text-purple-600 transition"
                            >
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="confirmLogout(event, this.closest('form'))"
                                    class="block rounded-xl px-4 py-2.5 text-sm font-semibold
                                        text-slate-700 hover:bg-red-50 hover:text-red-600 transition"
                                >
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="flex items-center gap-3 lg:hidden">
                <button
                    @click="open = !open"
                    class="flex items-center justify-center w-11 h-11 rounded-xl
                        bg-slate-50 ring-1 ring-slate-200 shadow-sm
                        hover:bg-white hover:ring-purple-300
                        transition-all duration-300"
                    aria-label="Toggle menu"
                >
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-slate-100 bg-white relative z-50 shadow-xl"
    >
        <div class="px-4 py-4 space-y-2">
            <template x-for="item in items" :key="'m-' + item.key">
                <a
                    :href="item.href"
                    class="flex items-center justify-between px-4 py-3 rounded-xl
                        text-sm font-semibold transition-all duration-300
                        text-slate-600 hover:text-purple-600 no-underline hover:no-underline
                        hover:bg-purple-50 ring-1 ring-transparent hover:ring-purple-100"
                    :class="isActive(item) ? 'bg-purple-50 text-purple-600 ring-1 ring-purple-100' : ''"
                >
                    <span x-text="item.label"></span>
                </a>
            </template>
            <a href="{{ route('staff.apply') }}" class="flex items-center justify-between px-4 py-3 rounded-xl
                text-sm font-semibold transition-all duration-300
                text-slate-600 hover:text-purple-600 no-underline hover:no-underline
                hover:bg-purple-50 ring-1 ring-transparent hover:ring-purple-100">
                <span>Staff Application</span>
            </a>
            <a href="{{ route('report.create') }}" class="flex items-center justify-between px-4 py-3 rounded-xl
                text-sm font-semibold transition-all duration-300
                text-slate-600 hover:text-purple-600 no-underline hover:no-underline
                hover:bg-purple-50 ring-1 ring-transparent hover:ring-purple-100">
                <span>Reports</span>
            </a>
            <a href="/faq" class="flex items-center justify-between px-4 py-3 rounded-xl
                text-sm font-semibold transition-all duration-300
                text-slate-600 hover:text-purple-600 no-underline hover:no-underline
                hover:bg-purple-50 ring-1 ring-transparent hover:ring-purple-100">
                <span>FAQ</span>
            </a>
            <a href="{{ route('branches.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl
                text-sm font-semibold transition-all duration-300
                text-slate-600 hover:text-purple-600 no-underline hover:no-underline
                hover:bg-purple-50 ring-1 ring-transparent hover:ring-purple-100">
                <span>Branch</span>
            </a>
        </div>
    </div>
</nav>