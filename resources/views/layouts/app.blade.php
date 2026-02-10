<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo/logo_aja.png') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;400;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen bg-cream">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/50 backdrop-blur-md border-b border-tan/20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Notification Drawer Overlay -->
        <div id="notifOverlay" onclick="toggleNotificationDrawer()" class="fixed inset-0 bg-deep-maroon/20 backdrop-blur-sm z-[60] hidden transition-opacity duration-300 opacity-0"></div>

        <!-- Notification Drawer Panel -->
        <div id="notifDrawer" class="fixed right-0 top-0 h-screen w-full sm:w-[400px] bg-white shadow-[-20px_0_50px_rgba(109,35,35,0.1)] z-[70] transform translate-x-full transition-transform duration-500 ease-out border-l border-tan/30 overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="p-8 border-b border-tan/20 flex justify-between items-center bg-cream/30">
                <div>
                    <h3 class="text-xl font-black text-deep-maroon uppercase tracking-tighter">Pemberitahuan</h3>
                    <p class="text-[10px] font-black text-tan uppercase tracking-widest mt-1">Laporan Tugas Urgent</p>
                </div>
                <button onclick="toggleNotificationDrawer()" class="p-2 hover:bg-primary-red/10 rounded-xl text-tan hover:text-primary-red transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- List -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar">
                @if(isset($notifications) && $notifications->count() > 0)
                    @foreach($notifications as $notif)
                    <div id="notif-item-{{ $notif->id }}" class="group relative p-5 rounded-3xl border-2 {{ $notif->urgency_level == 'danger' ? 'bg-rose-50 border-rose-100 hover:border-rose-300' : 'bg-amber-50 border-amber-100 hover:border-amber-300' }} transition-all duration-300 shadow-sm hover:shadow-md">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <div class="text-[10px] font-black text-tan uppercase tracking-widest mb-1">{{ $notif->created_at->diffForHumans() }}</div>
                                <h4 class="font-black text-deep-maroon text-sm mb-1 leading-tight">{{ $notif->message }}</h4>
                                <p class="text-xs font-bold text-deep-maroon/60 italic mt-2 p-3 bg-white/50 rounded-xl border border-current/5">
                                    "{{ $notif->kunjungan->keperluan }}"
                                </p>
                                <div class="mt-4 flex gap-2">
                                    <button onclick="dismissNotif({{ $notif->id }})" class="px-4 py-2 bg-white border-2 border-tan/30 rounded-xl text-[10px] font-black text-deep-maroon uppercase tracking-widest hover:bg-deep-maroon hover:text-white transition-all">
                                        Selesaikan
                                    </button>
                                    <a href="{{ route('reports') }}" class="px-4 py-2 bg-deep-maroon text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-red transition-all">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="h-full flex flex-col items-center justify-center opacity-30 py-20 text-center">
                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-sm font-black uppercase tracking-[0.2em]">Semua Clear!</p>
                        <p class="text-[10px] font-bold uppercase mt-1">Tidak ada laporan penting</p>
                    </div>
                @endif
            </div>
            
            <!-- Footer -->
            <div class="p-6 bg-cream/30 border-t border-tan/20">
                <p class="text-[8px] font-black text-tan text-center uppercase tracking-[0.4em]">Catatan Laporan Penting</p>
            </div>
        </div>

        <script>
            function toggleNotificationDrawer() {
                const drawer = document.getElementById('notifDrawer');
                const overlay = document.getElementById('notifOverlay');
                
                if (drawer.classList.contains('translate-x-full')) {
                    // Open
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        overlay.classList.add('opacity-100');
                        drawer.classList.remove('translate-x-full');
                    }, 10);
                } else {
                    // Close
                    overlay.classList.remove('opacity-100');
                    drawer.classList.add('translate-x-full');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 500);
                }
            }

            function dismissNotif(id) {
                fetch(`/notifications/${id}/dismiss`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const item = document.getElementById(`notif-item-${id}`);
                        item.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            item.remove();
                            // If no more items, show empty state
                            const list = document.querySelector('#notifDrawer .flex-1');
                            if (list.children.length === 0) {
                                location.reload(); // Refresh to show empty state easily
                            }
                        }, 300);
                    }
                });
            }
        </script>

        <style>
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5D0AC; border-radius: 10px; }
        </style>
    </body>
</html>
