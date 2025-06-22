<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <h1 class="text-white text-xl font-bold">The Indonesian Press</h1>
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Articles -->
                    <li x-data="{ open: {{ request()->routeIs('admin.articles*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" 
                                class="group flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm leading-6 font-semibold {{ request()->routeIs('admin.articles*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Kelola Artikel
                            <svg class="ml-auto h-5 w-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="mt-1 px-2">
                            <li>
                                <a href="{{ route('admin.articles.index') }}" 
                                   class="block rounded-md py-2 pl-9 pr-2 text-sm leading-6 {{ request()->routeIs('admin.articles.index') ? 'text-indigo-300' : 'text-gray-300 hover:text-white' }}">
                                    List Artikel
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.articles.create') }}" 
                                   class="block rounded-md py-2 pl-9 pr-2 text-sm leading-6 {{ request()->routeIs('admin.articles.create') ? 'text-indigo-300' : 'text-gray-300 hover:text-white' }}">
                                    Tulis Artikel Baru
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Users -->
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('admin.users*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Kelola User
                        </a>
                    </li>

                    <!-- Statistics -->
                    <li>
                        <a href="{{ route('admin.statistics') }}" 
                           class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('admin.statistics') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                            Lihat Statistik
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Navigasi ke Dashboard Artikel (khusus admin) -->
            @if(auth()->check() && auth()->user()->role === 'admin')
            <li class="mt-auto">
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-300 hover:text-white hover:bg-gray-800">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l7.5-7.5M3 12l7.5 7.5" />
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div>