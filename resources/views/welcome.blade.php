<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Host | Enterprise Cloud & CBT Infrastructure</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], },
                    animation: {
                        blob: "blob 12s infinite",
                        float: "float 6s ease-in-out infinite",
                        shimmer: "shimmer 2.5s linear infinite",
                        gradientShift: "gradientShift 8s ease infinite",
                        waPulse: "waPulse 2s infinite",
                    },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)" },
                            "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                            "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)" },
                        },
                        float: {
                            "0%, 100%": { transform: "translateY(0px)" },
                            "50%": { transform: "translateY(-10px)" },
                        },
                        shimmer: {
                            "0%": { backgroundPosition: "-200% 0" },
                            "100%": { backgroundPosition: "200% 0" },
                        },
                        gradientShift: {
                            "0%, 100%": { backgroundPosition: "0% 50%" },
                            "50%": { backgroundPosition: "100% 50%" },
                        },
                        waPulse: {
                            "0%": { boxShadow: "0 0 0 0 rgba(37, 211, 102, 0.7)" },
                            "70%": { boxShadow: "0 0 0 15px rgba(37, 211, 102, 0)" },
                            "100%": { boxShadow: "0 0 0 0 rgba(37, 211, 102, 0)" },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #3b82f6, #6366f1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #2563eb, #4f46e5); }
        
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        html { scroll-behavior: smooth; }

        .gpu-accelerate { will-change: transform; transform: translateZ(0); }
        .noise-static::before {
            content: ''; position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            background-repeat: repeat; background-size: 200px 200px; pointer-events: none; z-index: 1;
        }
        .grid-pattern {
            background-image: linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .glow-text { text-shadow: 0 0 40px rgba(59, 130, 246, 0.25), 0 0 80px rgba(99, 102, 241, 0.1); }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .border-gradient { position: relative; }
        .border-gradient::before {
            content: ''; position: absolute; inset: 0; border-radius: inherit; padding: 1px;
            background: linear-gradient(135deg, rgba(59,130,246,0.4), rgba(99,102,241,0.1), rgba(59,130,246,0.4));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude; pointer-events: none; opacity: 0; transition: opacity 0.4s ease;
        }
        .border-gradient:hover::before { opacity: 1; }
        .cbt-border-gradient::before { background: linear-gradient(135deg, rgba(249,115,22,0.5), rgba(244,63,94,0.2), rgba(249,115,22,0.5)); }
        .hover-lift { transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease; }
        .hover-lift:hover { transform: translateY(-6px); }
        .price-shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent); background-size: 200% 100%; animation: shimmer 3s linear infinite; }
        .dot-grid { background-image: radial-gradient(rgba(148, 163, 184, 0.12) 1px, transparent 1px); background-size: 24px 24px; }
        ::selection { background: rgba(59, 130, 246, 0.3); color: #fff; }
        .cat-filter-btn { transition: all 0.25s ease; }
        .cat-filter-btn.active { background: linear-gradient(135deg, #3b82f6, #6366f1); color: #fff !important; border-color: transparent; box-shadow: 0 4px 15px -3px rgba(59, 130, 246, 0.4); }
        .category-section { transition: opacity 0.35s ease, transform 0.35s ease; contain: layout style; }
        .category-section.section-hidden { display: none; }
        .category-section.section-visible { opacity: 1; transform: translateY(0); }
        .nav-pill { transition: all 0.25s ease; }
        .nav-pill.active-pill { background: rgba(59, 130, 246, 0.15); color: #60a5fa !important; }
        .nav-pill.active-pill::after {
            content: ''; position: absolute; bottom: -2px; left: 50%; transform: translateX(-50%); width: 60%; height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1); border-radius: 999px;
        }
        .filter-bar-solid { background: rgba(248, 250, 252, 0.97); border-bottom: 1px solid rgba(226, 232, 240, 0.8); }
        .nav-scrolled { background: rgba(2, 6, 23, 0.92) !important; border-bottom: 1px solid rgba(255,255,255,0.05); box-shadow: 0 4px 20px rgba(0,0,0,0.15); }

        /* Floating WA Button Styles */
        .wa-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
        }
        .wa-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50%;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .wa-button:hover {
            background-color: #128C7E;
            transform: scale(1.05);
        }
        .wa-tooltip {
            position: absolute;
            right: 75px;
            background-color: white;
            color: #333;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateX(20px);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            white-space: nowrap;
            pointer-events: none;
        }
        .wa-float:hover .wa-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        .wa-tooltip::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -6px;
            transform: translateY(-50%);
            border-width: 6px 0 6px 6px;
            border-color: transparent transparent transparent white;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 overflow-x-hidden relative">
    
    <a href="https://wa.me/6288277512080?text=Halo%20Admin%20K-Host,%20saya%20ingin%20bertanya%20seputar%20layanan%20Cloud/CBT." target="_blank" class="wa-float group">
        <div class="wa-tooltip">Halo! Butuh bantuan?</div>
        <div class="wa-button animate-waPulse">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
            </svg>
        </div>
    </a>

    <nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" id="navLogo" class="flex items-center space-x-2.5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 via-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/50 group-hover:scale-105 transition-all duration-300">
                        <span class="text-white font-black text-lg leading-none">K</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-extrabold tracking-tight text-white leading-none">K-Host</span>
                        <span class="text-[8px] font-semibold uppercase tracking-[0.2em] text-blue-300/80 leading-none mt-0.5">Cloud Infrastructure</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center bg-white/5 rounded-full p-1 border border-white/5">
                    @foreach($categories as $category)
                        <a href="#kategori-{{ $category->id }}" data-category="{{ $category->id }}" class="nav-pill cat-nav-link relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 rounded-full">{{ $category->name }}</a>
                    @endforeach
                    <a href="#" data-category="all" class="nav-pill cat-nav-link active-pill relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 rounded-full">Semua</a>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex group relative items-center justify-center px-5 py-2 text-[13px] font-bold text-white rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-md shadow-blue-500/20 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300">
                        <span>Client Area</span>
                        <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div id="mobileMenu" class="lg:hidden hidden bg-slate-900/95 border-t border-white/5">
            <div class="px-4 py-4 space-y-1">
                @foreach($categories as $category)
                    <a href="#kategori-{{ $category->id }}" data-category="{{ $category->id }}" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-white/70 hover:text-white hover:bg-white/5 rounded-xl transition-all">{{ $category->name }}</a>
                @endforeach
                <a href="#" data-category="all" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-blue-400 hover:text-white hover:bg-white/5 rounded-xl transition-all">Semua Layanan</a>
                <div class="pt-2 border-t border-white/5 mt-2">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-sm font-bold text-center text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl">Client Area</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="relative bg-slate-950 overflow-hidden min-h-screen flex flex-col justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-[#0a1628] to-indigo-950/80 z-0"></div>
        <div class="absolute inset-0 grid-pattern z-0 opacity-60"></div>
        <div class="absolute inset-0 noise-static z-0"></div>
        
        <div class="gpu-accelerate absolute top-1/4 -left-20 w-[400px] h-[400px] bg-blue-600/25 rounded-full filter blur-[64px] animate-blob z-0"></div>
        <div class="gpu-accelerate absolute top-1/3 -right-20 w-[350px] h-[350px] bg-indigo-500/25 rounded-full filter blur-[64px] animate-blob animation-delay-2000 z-0"></div>
        <div class="gpu-accelerate absolute -bottom-20 left-1/3 w-[380px] h-[380px] bg-violet-600/20 rounded-full filter blur-[64px] animate-blob animation-delay-4000 z-0"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-44 text-center z-10 w-full">
            <div data-aos="zoom-in" data-aos-duration="600" class="inline-flex items-center px-5 py-2.5 rounded-full glass text-blue-200 text-xs sm:text-sm font-semibold mb-10 animate-float">
                <span class="relative flex h-2.5 w-2.5 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400 shadow-[0_0_8px_rgba(96,165,250,0.7)]"></span>
                </span>
                Infrastruktur Cloud & CBT Standar Enterprise
            </div>
            
            <h1 data-aos="fade-up" data-aos-duration="800" data-aos-delay="100" class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white tracking-tight mb-8 leading-[1.05] glow-text">
                Performa Maksimal<br class="hidden sm:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 animate-gradientShift" style="background-size: 200% 200%;">untuk Ekosistem Digital Anda</span>
            </h1>
            
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" class="mt-8 max-w-2xl mx-auto text-lg md:text-xl text-slate-400 font-normal leading-relaxed">
                Tingkatkan skala aplikasi Anda dengan Server High-Performance. Sewa panel K-CBT Premium dengan kontrol API penuh, atau bangun infrastruktur di atas Cloud Hosting kami.
            </p>
            
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" class="mt-14 flex justify-center">
                <a href="#products" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_30px_-8px_rgba(59,130,246,0.5)] hover:shadow-[0_0_45px_-8px_rgba(59,130,246,0.7)] hover:-translate-y-1 overflow-hidden transition-all duration-300">
                    <span class="relative z-10 flex items-center">
                        Eksplorasi Layanan
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                    <div class="absolute inset-0 price-shimmer"></div>
                </a>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="400" class="mt-20 max-w-3xl mx-auto grid grid-cols-3 gap-6">
                <div class="text-center group cursor-default">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-blue-400 transition-colors duration-300">99.9%</div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Uptime SLA</div>
                </div>
                <div class="text-center group cursor-default border-x border-white/5">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-indigo-400 transition-colors duration-300">10Gbps</div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Network Port</div>
                </div>
                <div class="text-center group cursor-default">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-violet-400 transition-colors duration-300">24/7</div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Expert Support</div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-16 md:h-24 lg:h-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,121.22,200.7,114.47Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </main>

    <div id="products" class="relative bg-slate-50">
        <div class="absolute inset-0 dot-grid pointer-events-none opacity-30"></div>
        
        <div id="filterBar" class="sticky top-16 z-40 filter-bar-solid transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 overflow-x-auto pb-0.5 scrollbar-hide">
                        <button data-category="all" class="cat-filter-btn active whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 hover:border-slate-300 bg-white transition-all duration-300">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Semua
                        </button>
                        @foreach($categories as $category)
                            <button data-category="{{ $category->id }}" class="cat-filter-btn whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 hover:border-slate-300 bg-white transition-all duration-300">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 z-10">
            @foreach($categories as $category)
                <section id="kategori-{{ $category->id }}" data-section-category="{{ $category->id }}" class="category-section section-visible pt-10 mb-24 scroll-mt-36">
                    
                    <div class="text-center mb-14" data-aos="fade-up" data-aos-duration="600">
                        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold mb-5 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-2"></span>
                            {{ $category->name }}
                        </div>
                        <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">{{ $category->name }}</h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-6 rounded-full"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products->where('category_id', $category->id) as $product)
                            
                            @php
                                $aosDelay = ($loop->index % 3) * 80;
                            @endphp

                            @if($product->is_cbt_panel)
                                <div data-aos="fade-up" data-aos-delay="{{ $aosDelay }}" class="relative bg-gradient-to-b from-[#0c1222] to-[#162032] rounded-[2rem] shadow-2xl border border-slate-700/50 hover:border-orange-500/30 hover:-translate-y-2 transition-all duration-400 flex flex-col overflow-hidden group hover-lift border-gradient cbt-border-gradient">
                                    
                                    <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/8 rounded-full blur-[40px] -mr-16 -mt-16 pointer-events-none group-hover:bg-orange-500/15 transition-colors duration-500"></div>

                                    <div class="absolute top-0 right-0 z-20">
                                        <div class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[10px] font-black px-5 py-2.5 rounded-bl-[1.5rem] uppercase tracking-[0.15em] shadow-lg flex items-center shadow-orange-500/25">
                                            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            K-CBT Premium
                                        </div>
                                    </div>

                                    <div class="p-8 pb-0 relative z-10">
                                        <h3 class="text-3xl font-black text-white mb-6 pr-24 tracking-tight group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-orange-300 group-hover:to-rose-300 transition-all duration-400">{{ $product->name }}</h3>
                                        
                                        @php
                                            $desc = $product->description;
                                            preg_match_all('/(\d+\s*(User|GB|Core|NVMe|TB|MB|RAM|Disk))/i', $desc, $specMatches);
                                            $specs = $specMatches[0];
                                            
                                            $features = array_filter(array_map('trim', explode('.', $category->description ?? '')));
                                            
                                            $badges = [];
                                            foreach($specs as $spec) {
                                                $lower = strtolower($spec);
                                                if(str_contains($lower, 'user')) $badges[] = ['icon' => '👥', 'text' => $spec, 'color' => 'text-blue-300', 'bg' => 'bg-blue-500/10 border-blue-400/20'];
                                                elseif(str_contains($lower, 'ram')) $badges[] = ['icon' => '🧠', 'text' => $spec, 'color' => 'text-pink-300', 'bg' => 'bg-pink-500/10 border-pink-400/20'];
                                                elseif(str_contains($lower, 'disk') || str_contains($lower, 'nvme')) $badges[] = ['icon' => '💾', 'text' => $spec, 'color' => 'text-purple-300', 'bg' => 'bg-purple-500/10 border-purple-400/20'];
                                                elseif(str_contains($lower, 'core') || str_contains($lower, 'cpu')) $badges[] = ['icon' => '⚡', 'text' => $spec, 'color' => 'text-amber-300', 'bg' => 'bg-amber-500/10 border-amber-400/20'];
                                                else $badges[] = ['icon' => '✨', 'text' => $spec, 'color' => 'text-slate-300', 'bg' => 'bg-slate-600/20 border-slate-500/30'];
                                            }
                                        @endphp

                                        <div class="flex flex-wrap gap-2 mb-2">
                                            @foreach($badges as $badge)
                                                <div class="{{ $badge['bg'] }} border px-3.5 py-1.5 rounded-lg flex items-center shadow-sm">
                                                    <span class="text-sm mr-1.5">{{ $badge['icon'] }}</span>
                                                    <span class="{{ $badge['color'] }} text-[10px] font-bold tracking-wide uppercase">{{ trim($badge['text']) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="p-8 pt-6 flex-1 relative z-10">
                                        <div class="h-px w-full bg-gradient-to-r from-orange-500/20 via-slate-600/50 to-transparent mb-5"></div>
                                        <ul class="space-y-3.5">
                                            @foreach($features as $feature)
                                                @php $f = trim($feature); @endphp
                                                @if(strlen($f) > 5 && !preg_match('/(User|GB|Core|NVMe|RAM|Disk)/i', $f))
                                                    <li class="flex items-start text-sm text-slate-300 font-medium group/item">
                                                        <div class="flex-shrink-0 w-5 h-5 rounded-md bg-orange-500/10 flex items-center justify-center mr-3 border border-orange-500/20 group-hover/item:bg-orange-500 group-hover/item:border-orange-500 transition-all duration-300">
                                                            <svg class="h-3 w-3 text-orange-400 group-hover/item:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                        </div>
                                                        <span class="group-hover/item:text-white transition-colors duration-300 leading-snug">{{ $f }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        @if($product->price == 0)
                                            <div class="bg-slate-900/60 rounded-2xl p-5 mb-5 border border-slate-700/50">
                                                <div class="flex items-baseline text-[#25D366]">
                                                    <span class="text-3xl font-black tracking-tight">Harga Custom</span>
                                                </div>
                                            </div>
                                            <a href="https://wa.me/6288277512080?text={{ urlencode('Halo Admin K-Host, saya tertarik untuk custom harga pada paket K-CBT ' . $product->name . '.') }}" target="_blank" class="block w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-black text-sm py-4 rounded-xl shadow-[0_8px_25px_-8px_rgba(37,211,102,0.4)] text-center transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-wide flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                                Hubungi via WA
                                            </a>
                                        @else
                                            <div class="bg-slate-900/60 rounded-2xl p-5 mb-5 border border-slate-700/50 group-hover:border-slate-600/80 transition-colors duration-400">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.15em]">Investasi</span>
                                                    @if($product->discount_percent > 0)
                                                        <span class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[9px] px-2.5 py-0.5 rounded-md font-black uppercase tracking-wider shadow-sm">Save {{ $product->discount_percent }}%</span>
                                                    @endif
                                                </div>
                                                
                                                @if($product->discount_percent > 0)
                                                    <div class="mb-1">
                                                        <span class="relative inline-block text-sm font-bold text-slate-500">
                                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                                            <span class="absolute left-0 top-1/2 w-full h-[2px] bg-orange-500/70 -translate-y-1/2 rounded-full"></span>
                                                        </span>
                                                    </div>
                                                @endif
    
                                                <div class="flex items-baseline text-white">
                                                    <span class="text-xl font-bold mr-1">Rp</span>
                                                    <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-500 ml-2">/{{ $product->duration_months == 0 ? 'Selamanya' : ($product->duration_months == 12 ? '1 Thn' : $product->duration_months . ' Bln') }}</span>
                                                </div>
                                            </div>
                                            <form action="{{ route('user.buy', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-rose-600 hover:from-orange-400 hover:to-rose-500 text-white font-bold py-4 rounded-2xl shadow-[0_8px_25px_-8px_rgba(249,115,22,0.4)] hover:shadow-[0_10px_35px_-8px_rgba(249,115,22,0.6)] hover:-translate-y-0.5 transition-all duration-300 text-sm uppercase tracking-wider">
                                                    Deploy K-CBT Sekarang
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                            @else
                                <div data-aos="fade-up" data-aos-delay="{{ $aosDelay }}" class="bg-white rounded-[2rem] shadow-lg border border-slate-100 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full overflow-hidden group">
                                    <div class="p-8 border-b border-slate-50 bg-slate-50/50 group-hover:bg-blue-50/50 transition-colors">
                                        <h3 class="text-2xl font-black text-slate-900 mb-3">{{ $product->name }}</h3>
                                        
                                        @if($product->price == 0)
                                            <div class="flex items-baseline mt-4">
                                                <span class="text-3xl font-black tracking-tight text-[#25D366]">Harga Custom</span>
                                            </div>
                                        @elseif($product->discount_percent > 0)
                                            <div class="mt-4 flex flex-col">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-600 text-[10px] font-black uppercase tracking-wider">Hemat {{ $product->discount_percent }}%</span>
                                                    <span class="relative inline-block text-sm font-bold text-slate-400">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        <span class="absolute left-0 top-1/2 w-full h-[1.5px] bg-rose-400 -translate-y-1/2"></span>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline text-slate-900">
                                                    <span class="text-3xl font-black tracking-tight">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-500 ml-1">/{{ $product->duration_months == 0 ? 'Selamanya' : ($product->duration_months == 12 ? '1 Thn' : $product->duration_months . ' Bln') }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-baseline mt-4 text-slate-900">
                                                <span class="text-3xl font-black tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                <span class="text-sm font-semibold text-slate-500 ml-1">/{{ $product->duration_months == 0 ? 'Selamanya' : ($product->duration_months == 12 ? '1 Thn' : $product->duration_months . ' Bln') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-8 flex-1">
                                        @php
                                            $regDesc = $product->description;
                                            $regFeatures = array_filter(array_map('trim', explode('.', $regDesc)));
                                        @endphp
                                        <ul class="space-y-3">
                                            @foreach($regFeatures as $descLine)
                                                @if(strlen(trim($descLine)) > 2)
                                                    <li class="flex items-start text-sm text-slate-600 font-medium">
                                                        <svg class="h-5 w-5 text-indigo-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span class="leading-snug">{{ trim($descLine) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        @if($product->price == 0)
                                            <a href="https://wa.me/6288277512080?text={{ urlencode('Halo Admin K-Host, saya tertarik untuk custom harga pada layanan ' . $product->name . '.') }}" target="_blank" class="block w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-black text-sm py-4 rounded-xl shadow-[0_8px_25px_-8px_rgba(37,211,102,0.4)] text-center transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-wide flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                                Hubungi via WA
                                            </a>
                                        @else
                                            <form action="{{ route('user.buy', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-black py-4 rounded-xl text-center shadow-md transition-all duration-300 transform hover:-translate-y-1 text-sm uppercase tracking-wide">
                                                    Pilih Paket Ini
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>

<style>
    .animate-spin-slow { animation: spin 3s linear infinite; }
</style>

<script>
    function toggleApiForm(id) {
        var form = document.getElementById(id);
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    }
</script>
@endsection