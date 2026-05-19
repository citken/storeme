<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Host | Enterprise Cloud & CBT Infrastructure</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        blob: "blob 7s infinite",
                        premiumSurge: "premiumSurge 2.8s ease-in-out infinite",
                        float: "float 3s ease-in-out infinite",
                        mouseBounce: "mouseBounce 2s infinite"
                    },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)" },
                            "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                            "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)" },
                        },
                        premiumSurge: {
                            "0%": { transform: "translateY(0px) scaleY(0.8)", opacity: "0" },
                            "10%": { opacity: "1" },
                            "50%": { transform: "translateY(25px) scaleY(1.2)" },
                            "90%": { opacity: "1" },
                            "100%": { transform: "translateY(50px) scaleY(0.8)", opacity: "0" },
                        },
                        float: {
                            "0%, 100%": { transform: "translateY(0)" },
                            "50%": { transform: "translateY(-5px)" }
                        },
                        mouseBounce: {
                            "0%, 20%, 50%, 80%, 100%": { transform: "translateY(0)" },
                            "40%": { transform: "translateY(-10px)" },
                            "60%": { transform: "translateY(-5px)" }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Scrollbar Premium */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; }
        
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        /* Smooth Scrolling */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 selection:bg-blue-500 selection:text-white overflow-x-hidden">
    
    <nav class="sticky top-0 z-50 bg-white/75 backdrop-blur-xl border-b border-white/20 shadow-[0_4px_30px_rgba(0,0,0,0.05)] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3 cursor-pointer group" data-aos="fade-down" data-aos-duration="800">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:rotate-[360deg] transition-transform duration-700">
                        <span class="text-white font-black text-2xl leading-none">K</span>
                    </div>
                    <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">K-Host</span>
                </div>

                <div class="hidden md:flex space-x-8" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    @foreach($categories as $category)
                        <a href="#kategori-{{ $category->id }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors duration-300 uppercase tracking-wider relative group">
                            {{ $category->name }}
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full rounded-full"></span>
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200">
                    <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white transition-all duration-300 bg-slate-900 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-lg shadow-slate-900/20 hover:shadow-blue-500/40 hover:-translate-y-1">
                        <span>Client Area</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="relative bg-slate-900 overflow-hidden min-h-[90vh] flex flex-col justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-[#0a192f] to-indigo-950 z-0"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] mix-blend-overlay z-0" data-aos="zoom-in" data-aos-duration="3000" style="background-attachment: fixed; background-position: center;"></div>
        
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob z-0"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-2000 z-0"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-4000 z-0"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 lg:py-40 text-center z-10 w-full">
            <div data-aos="zoom-in" data-aos-duration="1000" class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 border border-white/10 text-blue-200 text-xs sm:text-sm font-bold mb-8 backdrop-blur-md shadow-2xl animate-float">
                <span class="flex h-2.5 w-2.5 rounded-full bg-blue-400 mr-2.5 animate-pulse shadow-[0_0_8px_rgba(96,165,250,0.8)]"></span>
                Infrastruktur Cloud & CBT Standar Enterprise
            </div>
            
            <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-[1.15]">
                Performa Maksimal untuk <br class="hidden md:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 drop-shadow-2xl">Ekosistem Digital Anda</span>
            </h1>
            
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" class="mt-6 max-w-3xl mx-auto text-lg md:text-xl text-slate-300 font-normal leading-relaxed">
                Tingkatkan skala aplikasi Anda dengan Server High-Performance. Sewa panel K-CBT Premium dengan kontrol API penuh, atau bangun infrastruktur tanpa batas di atas Cloud Hosting CyberPanel kami.
            </p>
            
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="mt-12 flex justify-center">
                <a href="#kategori-{{ $categories->first()->id ?? '' }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-extrabold text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_30px_rgba(59,130,246,0.3)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] hover:-translate-y-1 hover:scale-105 overflow-hidden">
                    <span class="relative z-10">Eksplorasi Layanan</span>
                    <div class="absolute inset-0 h-full w-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                </a>
            </div>
        </div>

        <div class="absolute bottom-16 w-full flex justify-center z-20" data-aos="fade-up" data-aos-delay="800" data-aos-offset="0">
            <a href="#kategori-{{ $categories->first()->id ?? '' }}" class="flex flex-col items-center text-slate-400 hover:text-white transition-colors duration-300 group">
                <span class="text-xs font-bold tracking-widest uppercase mb-2">Scroll</span>
                <div class="w-6 h-10 border-2 border-current rounded-full flex justify-center pt-2">
                    <div class="w-1.5 h-1.5 bg-current rounded-full animate-mouseBounce"></div>
                </div>
            </a>
        </div>

        <div class="absolute bottom-0 w-full overflow-hidden leading-none z-10 transform translate-y-1">
            <svg class="relative block w-full h-16 md:h-24 lg:h-32" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,121.22,200.7,114.47Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </main>

    <div class="relative w-full flex justify-center z-20 -translate-y-6" data-aos="fade-down" data-aos-anchor-placement="top-center">
        <div class="w-px h-16 bg-gradient-to-b from-blue-600 via-blue-400 to-transparent relative">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1.5 h-4 bg-blue-300 rounded-full animate-premiumSurge shadow-[0_0_12px_rgba(59,130,246,0.9)]"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-20">
        @foreach($categories as $category)
            <section id="kategori-{{ $category->id }}" class="pt-24 -mt-16 mb-24 scroll-mt-24">
                
                <div class="text-center mb-20" data-aos="zoom-in-up" data-aos-duration="800">
                    <h2 class="text-4xl font-black text-slate-900 sm:text-5xl tracking-tight mb-5">{{ $category->name }}</h2>
                    <p class="text-slate-500 font-medium max-w-2xl mx-auto text-lg">Pilih spesifikasi yang paling sesuai dengan kebutuhan skala project Anda.</p>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-8 rounded-full shadow-[0_0_15px_rgba(59,130,246,0.5)]"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
                    @foreach($products->where('category_id', $category->id) as $product)
                        
                        @php
                            // Staggering animasi berdasarkan posisi grid
                            $aosEffect = 'fade-up';
                            if ($loop->index % 3 == 0) $aosEffect = 'fade-up-right';
                            if ($loop->index % 3 == 2) $aosEffect = 'fade-up-left';
                            
                            $aosDelay = ($loop->index % 3) * 150;
                        @endphp

                        @if($product->is_cbt_panel)
                            <div data-aos="{{ $aosEffect }}" data-aos-delay="{{ $aosDelay }}" class="bg-gradient-to-b from-[#0f172a] to-[#1e293b] rounded-[2rem] shadow-2xl border border-slate-700 hover:border-orange-500/50 hover:shadow-[0_0_50px_rgba(249,115,22,0.2)] transform hover:-translate-y-3 hover:scale-[1.02] transition-all duration-500 flex flex-col relative overflow-hidden group">
                                
                                <div class="absolute top-0 right-0 w-72 h-72 bg-orange-500/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none transition-all duration-700 group-hover:bg-orange-500/25 group-hover:scale-150"></div>

                                <div class="absolute top-0 right-0 bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[10px] font-black px-5 py-2 rounded-bl-2xl uppercase tracking-widest shadow-lg z-10 flex items-center">
                                    <span class="mr-1.5 animate-pulse">⭐</span> K-CBT Premium
                                </div>

                                <div class="p-8 pb-0 relative z-10">
                                    <h3 class="text-3xl font-black text-white mb-6 pr-10 leading-tight group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-orange-400 group-hover:to-rose-400 transition-all duration-300">{{ $product->name }}</h3>
                                    
                                    @php
                                        $rawSpecs = array_filter(array_map('trim', preg_split('/[,.]+/', $product->description)));
                                        $features = array_filter(array_map('trim', explode('.', $cbt_features ?? '')));
                                        
                                        $badges = [];
                                        foreach($rawSpecs as $spec) {
                                            $cleanSpec = str_ireplace(['Kapasitas Max:', 'Spesifikasi:', 'Bersamaan'], '', $spec);
                                            $cleanSpec = trim($cleanSpec);
                                            if(empty($cleanSpec)) continue;
                                            $lower = strtolower($cleanSpec);
                                            
                                            if(str_contains($lower, 'user')) {
                                                $badges[] = ['icon' => '👥', 'text' => $cleanSpec, 'color' => 'text-blue-300', 'bg' => 'bg-blue-500/10 border-blue-400/20'];
                                            } elseif(str_contains($lower, 'ram')) {
                                                $badges[] = ['icon' => '🧠', 'text' => $cleanSpec, 'color' => 'text-pink-300', 'bg' => 'bg-pink-500/10 border-pink-400/20'];
                                            } elseif(str_contains($lower, 'disk') || str_contains($lower, 'nvme')) {
                                                $badges[] = ['icon' => '💾', 'text' => $cleanSpec, 'color' => 'text-purple-300', 'bg' => 'bg-purple-500/10 border-purple-400/20'];
                                            } elseif(str_contains($lower, 'core') || str_contains($lower, 'cpu')) {
                                                $badges[] = ['icon' => '⚡', 'text' => $cleanSpec, 'color' => 'text-amber-300', 'bg' => 'bg-amber-500/10 border-amber-400/20'];
                                            } elseif(strlen($cleanSpec) < 30) { 
                                                $badges[] = ['icon' => '✨', 'text' => $cleanSpec, 'color' => 'text-slate-300', 'bg' => 'bg-slate-600/20 border-slate-500/30'];
                                            }
                                        }
                                    @endphp

                                    <div class="flex flex-wrap gap-2.5 mb-2">
                                        @foreach($badges as $badge)
                                            <div class="{{ $badge['bg'] }} border shadow-sm backdrop-blur-md px-3.5 py-1.5 rounded-full flex items-center hover:-translate-y-1 hover:shadow-md transition-all duration-300 cursor-default">
                                                <span class="text-base mr-2">{{ $badge['icon'] }}</span>
                                                <span class="{{ $badge['color'] }} text-[11px] font-extrabold tracking-wide uppercase">{{ $badge['text'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="p-8 pt-4 flex-1 mt-2 relative z-10">
                                    <div class="h-px w-full bg-gradient-to-r from-slate-700 via-slate-600 to-transparent mb-6"></div>
                                    <ul class="space-y-4">
                                        @foreach($features as $feature)
                                            <li class="flex items-start text-sm text-slate-300 font-medium group/list">
                                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500/10 flex items-center justify-center mr-3 border border-orange-500/20 group-hover/list:bg-orange-500 group-hover/list:border-orange-500 group-hover/list:scale-110 transition-all duration-300">
                                                    <svg class="h-3.5 w-3.5 text-orange-400 group-hover/list:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                </div>
                                                <span class="mt-0.5 group-hover/list:text-white transition-colors">{{ trim($feature) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="p-8 pt-0 mt-auto relative z-10">
                                    <div class="bg-slate-900/50 rounded-2xl p-5 mb-6 border border-slate-700/50 backdrop-blur-sm group-hover:border-slate-600 transition-colors">
                                        
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs text-slate-400 font-bold uppercase tracking-widest block">Investasi Tahunan</span>
                                            @if($product->discount_percent > 0)
                                                <span class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[9px] px-2 py-0.5 rounded font-black uppercase tracking-wider animate-pulse shadow-[0_0_10px_rgba(249,115,22,0.4)] transform rotate-2">Save {{ $product->discount_percent }}%</span>
                                            @endif
                                        </div>
                                        
                                        @if($product->discount_percent > 0)
                                            <div class="mb-0.5 mt-1">
                                                <span class="relative inline-block text-sm font-bold text-slate-500">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    <span class="absolute left-[-5%] top-1/2 w-[110%] h-[2.5px] bg-orange-500 -rotate-3 transform rounded-full shadow-sm opacity-90"></span>
                                                </span>
                                            </div>
                                        @endif

                                        <div class="flex items-baseline text-white">
                                            <span class="text-2xl font-bold mr-1">Rp</span>
                                            <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                            <span class="text-sm font-semibold text-slate-400 ml-2">/thn</span>
                                        </div>
                                    </div>
                                    <form action="{{ route('user.buy', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-rose-600 hover:from-orange-400 hover:to-rose-500 text-white font-extrabold py-4 rounded-xl shadow-[0_10px_20px_-10px_rgba(249,115,22,0.5)] hover:shadow-[0_15px_30px_-10px_rgba(249,115,22,0.8)] transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02]">
                                            Deploy K-CBT Sekarang
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @else
                            <div data-aos="{{ $aosEffect }}" data-aos-delay="{{ $aosDelay }}" class="bg-white rounded-[2rem] shadow-xl border border-slate-100 hover:border-blue-300 hover:shadow-[0_20px_40px_-15px_rgba(59,130,246,0.15)] transform hover:-translate-y-3 hover:scale-[1.02] transition-all duration-500 flex flex-col relative overflow-hidden group">
                                
                                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none transition-all duration-700 group-hover:bg-blue-100/60 group-hover:scale-150"></div>

                                <div class="p-8 border-b border-slate-100 relative z-10">
                                    <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">{{ $product->name }}</h3>
                                    
                                    <div class="mt-4">
                                        @if($product->discount_percent > 0)
                                            <div class="flex flex-col">
                                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-sm transform -rotate-2 hover:rotate-0 transition-transform">
                                                        <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                                                        <span class="text-[10px] uppercase font-black tracking-wider">Hemat {{ $product->discount_percent }}%</span>
                                                    </span>
                                                    
                                                    <span class="relative inline-block text-sm font-bold text-slate-400">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        <span class="absolute left-[-5%] top-1/2 w-[110%] h-[2.5px] bg-rose-500 -rotate-6 transform rounded-full opacity-80"></span>
                                                    </span>
                                                </div>
                                                
                                                <div class="flex items-baseline text-slate-900 mt-1">
                                                    <span class="text-2xl font-bold mr-1">Rp</span>
                                                    <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-500 ml-2">/bln</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-baseline text-slate-900 mt-2">
                                                <span class="text-2xl font-bold mr-1">Rp</span>
                                                <span class="text-4xl font-black tracking-tight">{{ number_format($product->price, 0, ',', '.') }}</span>
                                                <span class="text-sm font-semibold text-slate-500 ml-2">/bln</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-8 pt-6 flex-1 relative z-10">
                                    <ul class="space-y-4">
                                        @foreach(explode('.', $product->description) as $descLine)
                                            @if(trim($descLine) != '')
                                                <li class="flex items-start text-sm text-slate-600 font-medium group/list">
                                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center mr-3 group-hover/list:bg-blue-500 group-hover/list:scale-110 transition-all duration-300">
                                                        <svg class="h-3.5 w-3.5 text-blue-500 group-hover/list:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    </div>
                                                    <span class="mt-0.5 group-hover/list:text-slate-900 transition-colors">{{ trim($descLine) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="p-8 pt-0 mt-auto relative z-10">
                                    <a href="{{ route('login') }}" class="block w-full bg-slate-50 border-2 border-slate-200 text-slate-700 hover:bg-slate-900 hover:border-slate-900 hover:text-white font-extrabold py-4 px-4 rounded-xl text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02]">
                                        Pilih Paket Cloud
                                    </a>
                                </div>
                            </div>
                        @endif

                    @endforeach
                </div>

                @if($products->where('category_id', $category->id)->count() == 0)
                    <div class="text-center text-slate-500 py-16 bg-white border-2 border-dashed border-slate-200 rounded-[2rem]" data-aos="zoom-in">
                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="text-lg font-bold text-slate-900">Belum ada paket</h3>
                        <p class="mt-1 text-sm">Paket di kategori ini akan segera tersedia.</p>
                    </div>
                @endif

            </section>
        @endforeach
    </div>

    <footer class="bg-slate-950 pt-16 pb-8 border-t border-slate-800 text-center relative z-20 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20 pointer-events-none" data-aos="fade" data-aos-duration="3000"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="fade-up" data-aos-offset="0">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/20 hover:rotate-180 transition-transform duration-700 cursor-pointer">
                <span class="text-white font-black text-2xl leading-none">K</span>
            </div>
            <h4 class="text-xl font-bold text-white mb-2 tracking-wide">K-Host Cloud Infrastructure</h4>
            <p class="text-slate-400 text-sm mb-8 max-w-md mx-auto leading-relaxed">Solusi server dan panel CBT terbaik untuk menunjang kebutuhan ujian berskala masif dan project digital Anda.</p>
            <div class="h-px w-full max-w-sm mx-auto bg-gradient-to-r from-transparent via-slate-700 to-transparent mb-8"></div>
            <p class="text-slate-500 text-xs font-semibold tracking-wider uppercase">
                &copy; {{ date('Y') }} K-Projects. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // KUNCI ANIMASI BERULANG ADA DI SINI
        AOS.init({
            once: false,      // Animasi akan terus terulang tiap kali di-scroll
            mirror: true,     // Elemen akan menghilang dengan animasi jika dilewati
            offset: 60,       // Titik trigger animasi
            duration: 800,    // Kecepatan animasi
            easing: 'ease-out-cubic', // Gaya pergerakan yang mulus
        });
    </script>
</body>
</html>