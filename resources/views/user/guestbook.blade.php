<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buku Kunjungan Tamu</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;400;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background-color: #FEF9E1; /* cream */
        }
        .focus-glow:focus {
            box-shadow: 0 0 20px rgba(163, 29, 29, 0.1);
            border-color: #A31D1D !important;
        }
        .animate-float {
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="antialiased text-deep-maroon overflow-x-hidden">
    <div class="min-h-screen relative flex items-center justify-center p-6">
        <!-- Abstract Decorative Elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-tan/20 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary-red/5 rounded-full blur-[120px] animate-float" style="animation-delay: -4s"></div>

        <div class="w-full max-w-xl relative z-10">
            <!-- Main Container -->
            <div class="glass-card border-2 border-tan/30 rounded-[3.5rem] shadow-[0_30px_70px_rgba(109,35,35,0.12)] p-10 md:p-16 transition-all duration-500 hover:shadow-[0_40px_80px_rgba(109,35,35,0.15)]">
                
                <div class="text-center mb-12">
                    <div class="inline-flex p-6 bg-primary-red rounded-[2.5rem] shadow-2xl shadow-primary-red/30 mb-8 transform hover:scale-105 transition-transform duration-500 cursor-pointer">
                        <svg class="w-14 h-14 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-5xl font-black text-deep-maroon mb-4 tracking-tighter">Buku Tamu</h1>
                    <div class="flex items-center justify-center gap-4">
                        <div class="h-[2px] w-8 bg-tan/50"></div>
                        <p class="text-tan font-black uppercase tracking-[0.4em] text-[10px]">Sistem Registrasi Pengunjung</p>
                        <div class="h-[2px] w-8 bg-tan/50"></div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert-message bg-emerald-50 border border-emerald-100 text-emerald-600 px-8 py-5 rounded-[2rem] mb-10 flex items-center gap-5 animate-in fade-in slide-in-from-top-6 duration-700">
                        <div class="p-2 bg-emerald-500 rounded-full shadow-lg shadow-emerald-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-black text-base">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Welcome Back Message -->
                <div id="welcome-msg" class="hidden bg-tan/10 border border-tan/30 text-deep-maroon px-8 py-5 rounded-[2rem] mb-10 items-center gap-5 animate-pulse">
                    <div class="p-2 bg-tan rounded-full">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span id="welcome-text" class="font-black italic text-base"></span>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('guestbook.store') }}" id="guestbook-form" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-tan text-[11px] uppercase font-black tracking-widest ml-4">Nomor WhatsApp / HP</label>
                        <input id="no_hp" type="text" name="no_hp" required autofocus
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full bg-cream/30 border-2 border-tan/40 rounded-[1.8rem] px-8 py-5 text-deep-maroon placeholder-tan/50 focus:outline-none focus-glow transition-all duration-300 font-bold text-lg"
                            placeholder="Contoh: 0812XXXXXXXX">
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2 ml-4" />
                    </div>

                    <div class="space-y-2">
                        <label class="block text-tan text-[11px] uppercase font-black tracking-widest ml-4">Nama Lengkap</label>
                        <input id="nama" type="text" name="nama" required
                            class="w-full bg-cream/30 border-2 border-tan/40 rounded-[1.8rem] px-8 py-5 text-deep-maroon focus:outline-none focus-glow transition-all duration-300 font-bold">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-tan text-[11px] uppercase font-black tracking-widest ml-4">Asal Institusi</label>
                        <input id="asal_institusi" type="text" name="asal_institusi" required
                            class="w-full bg-cream/30 border-2 border-tan/40 rounded-[1.8rem] px-8 py-5 text-deep-maroon focus:outline-none focus-glow transition-all duration-300 font-bold">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-tan text-[11px] uppercase font-black tracking-widest ml-4">Tujuan / Keperluan</label>
                        <textarea id="keperluan" name="keperluan" required rows="3"
                            class="w-full bg-cream/30 border-2 border-tan/40 rounded-[1.8rem] px-8 py-5 text-deep-maroon placeholder-tan/50 focus:outline-none focus-glow transition-all duration-300 font-bold resize-none"
                            placeholder="Jelaskan secara singkat..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-primary-red hover:bg-deep-maroon text-white font-black py-6 rounded-[2rem] shadow-2xl shadow-primary-red/30 transition-all duration-500 hover:translate-y-[-4px] active:translate-y-[2px] tracking-widest uppercase text-base group">
                            Konfirmasi Kehadiran
                            <span class="inline-block ml-2 group-hover:translate-x-2 transition-transform duration-300">→</span>
                        </button>
                    </div>
                </form>

                <div class="mt-12 pt-8 border-t border-tan/20 text-center">
                    <p class="text-[10px] text-tan font-black uppercase tracking-[0.5em]">Terima Kasih Atas Kunjungan Anda</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('no_hp').addEventListener('input', function() {
            let phone = this.value;
            if (phone.length >= 10) {
                fetch('{{ route('guestbook.checkPhone') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ no_hp: phone })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('asal_institusi').value = data.asal_institusi;
                        document.getElementById('welcome-msg').classList.remove('hidden');
                        document.getElementById('welcome-msg').classList.add('flex');
                        document.getElementById('welcome-text').innerText = 'Selamat datang kembali, ' + data.nama + '!';
                        
                        // Micro-interaction: visual feedback for found data
                        document.querySelectorAll('input, textarea').forEach(el => {
                            if (el.id !== 'no_hp' && el.value) {
                                el.parentElement.classList.add('animate-in', 'fade-in', 'slide-in-from-left-2');
                            }
                        });
                    } else {
                        document.getElementById('welcome-msg').classList.add('hidden');
                        document.getElementById('welcome-msg').classList.remove('flex');
                    }
                });
            }
        });

        // Auto-hide alerts with elegant fade
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-message');
            alerts.forEach(alert => {
                alert.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px) scale(0.95)';
                setTimeout(() => alert.remove(), 800);
            });
        }, 5000);
    </script>
</body>
</html>
