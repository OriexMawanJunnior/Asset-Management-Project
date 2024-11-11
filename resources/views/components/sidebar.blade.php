<aside class="w-64 bg-purple-700 text-white min-h-screen">
    <div class="p-4">
        <div class="flex items-center gap-2 mb-8">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M42 10C42 13.3137 33.9411 16 24 16C14.0589 16 6 13.3137 6 10M42 10C42 6.68629 33.9411 4 24 4C14.0589 4 6 6.68629 6 10M42 10V38C42 41.32 34 44 24 44C14 44 6 41.32 6 38V10M42 24C42 27.32 34 30 24 30C14 30 6 27.32 6 24" stroke="#F5F5F5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="text-2xl font-bold">AMS.</span>
        </div>
        
        <nav class="space-y-4">
            <a href="/dashboard" class="flex items-center gap-3 p-3 rounded-full {{ request()->is('dashboard') ? 'bg-white text-purple-700' : 'hover:bg-purple-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path d="M4 5h16M4 12h16m-7 7h7"/>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="/assets" class="flex items-center gap-3 p-3 rounded-full {{ request()->is('assets') ? 'bg-white text-purple-700' : 'hover:bg-purple-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Assets</span>
            </a>
            <a href="/users" class="flex items-center gap-3 p-3 rounded-full {{ request()->is('users') ? 'bg-white text-purple-700' : 'hover:bg-purple-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span>Users</span>
            </a>
            <a href="/borrowing" class="flex items-center gap-3 p-3 rounded-full {{ request()->is('borrowing') ? 'bg-white text-purple-700' : 'hover:bg-purple-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span>Borrowing</span>
            </a>
        </nav>
    </div>
</aside>