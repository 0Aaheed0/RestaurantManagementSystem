<nav
    x-data="lanternNav()"
    x-init="init()"
    class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50"
>
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">

            <div class="flex-1 flex justify-start">
                <button 
                    @click="$dispatch('open-menu')"
                    class="bg-purple-600 text-white px-6 py-2.5 rounded-xl flex items-center shadow-lg hover:bg-purple-700 transition active:scale-95"
                >
                    <span class="text-lg">☰</span>
                    <span class="ml-2 hidden sm:block font-bold tracking-widest text-xs uppercase">Menu</span>
                </button>
            </div>

            <div class="flex items-center justify-center shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group no-underline">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto transition-transform group-hover:scale-105" />
                    <span class="hidden md:block font-extrabold tracking-[0.25em] text-slate-800 uppercase text-lg">
                        Restaurant Management System
                    </span>
                </a>
            </div>

            <div class="flex-1 flex justify-end">
                <x-dropdown align="right" width="48" content-classes="bg-transparent shadow-none p-0">
                    <x-slot name="trigger">
                        <button class="group inline-flex items-center justify-center h-12 w-12 rounded-full border-4 border-slate-100 bg-purple-600 text-white font-black text-xl hover:border-purple-400 transition-all shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-slate-200">
                            <x-dropdown-link :href="route('profile.edit')" class="block rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-purple-50">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block rounded-xl px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Log Out</x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>