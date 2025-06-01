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

                    <!-- Categories -->
                    <li>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('admin.categories*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                            Kelola Kategori
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

            <!-- Settings -->
            <li class="mt-auto">
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>