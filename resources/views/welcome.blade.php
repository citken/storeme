<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Host | Enterprise Cloud & CBT Infrastructure</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    animation: {
                        blob: "blob 10s infinite",
                        float: "float 6s ease-in-out infinite",
                        shimmer: "shimmer 2.5s linear infinite",
                        orbit: "orbit 20s linear infinite",
                        pulseGlow: "pulseGlow 3s ease-in-out infinite",
                        gradientShift: "gradientShift 8s ease infinite",
                        fadeInUp: "fadeInUp 0.6s ease-out forwards",
                        scaleIn: "scaleIn 0.5s ease-out forwards",
                        slideInLeft: "slideInLeft 0.6s ease-out forwards",
                        slideInRight: "slideInRight 0.6s ease-out forwards",
                    },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)" },
                            "33%": { transform: "translate(30px, -50px) scale(1.15)" },
                            "66%": { transform: "translate(-20px, 20px) scale(0.85)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)" },
                        },
                        float: {
                            "0%, 100%": { transform: "translateY(0px)" },
                            "50%": { transform: "translateY(-12px)" },
                        },
                        shimmer: {
                            "0%": { backgroundPosition: "-200% 0" },
                            "100%": { backgroundPosition: "200% 0" },
                        },
                        orbit: {
                            "0%": { transform: "rotate(0deg) translateX(120px) rotate(0deg)" },
                            "100%": { transform: "rotate(360deg) translateX(120px) rotate(-360deg)" },
                        },
                        pulseGlow: {
                            "0%, 100%": { opacity: "0.4", transform: "scale(1)" },
                            "50%": { opacity: "0.8", transform: "scale(1.05)" },
                        },
                        gradientShift: {
                            "0%, 100%": { backgroundPosition: "0% 50%" },
                            "50%": { backgroundPosition: "100% 50%" },
                        },
                        fadeInUp: {
                            "0%": { opacity: "0", transform: "translateY(30px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" },
                        },
                        scaleIn: {
                            "0%": { opacity: "0", transform: "scale(0.9)" },
                            "100%": { opacity: "1", transform: "scale(1)" },
                        },
                        slideInLeft: {
                            "0%": { opacity: "0", transform: "translateX(-40px)" },
                            "100%": { opacity: "1", transform: "translateX(0)" },
                        },
                        slideInRight: {
                            "0%": { opacity: "0", transform: "translateX(40px)" },
                            "100%": { opacity: "1", transform: "translateX(0)" },
                        },
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #3b82f6, #6366f1); 
            border-radius: 10px; 
        }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #2563eb, #4f46e5); }
        
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .animation-delay-6000 { animation-delay: 6s; }

        html { scroll-behavior: smooth; }
        
        /* Noise texture overlay */
        .noise-overlay::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n' x='0' y='0'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }

        /* Grid pattern */
        .grid-pattern {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Glow text */
        .glow-text {
            text-shadow: 0 0 40px rgba(59, 130, 246, 0.3), 0 0 80px rgba(99, 102, 241, 0.15);
        }

        /* Glass morphism */
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        .glass-light {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* Animated border gradient */
        .border-gradient {
            position: relative;
            border: none !important;
        }
        .border-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(59,130,246,0.4), rgba(99,102,241,0.1), rgba(59,130,246,0.4));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .border-gradient:hover::before {
            opacity: 1;
        }

        /* CBT card animated border */
        .cbt-border-gradient::before {
            background: linear-gradient(135deg, rgba(249,115,22,0.5), rgba(244,63,94,0.2), rgba(249,115,22,0.5));
        }

        /* Feature list stagger */
        .feature-item { 
            opacity: 0; 
            animation: fadeInUp 0.4s ease-out forwards; 
        }

        /* Smooth hover lift */
        .hover-lift {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
        }

        /* Price tag shimmer */
        .price-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        /* Dot grid decoration */
        .dot-grid {
            background-image: radial-gradient(rgba(148, 163, 184, 0.15) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Custom selection */
        ::selection {
            background: rgba(59, 130, 246, 0.3);
            color: #fff;
        }

        /* Nav active indicator */
        .nav-link-active {
            color: #3b82f6 !important;
        }
        .nav-link-active::after {
            width: 100% !important;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 overflow-x-hidden">
    
    <!-- Navigation -->
    <nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3 cursor-pointer group" data-aos="fade-down" data-aos-duration="800">
                    <div class="relative w-11 h-11 bg-gradient-to-br from-blue-500 via-indigo-500 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/50 group-hover:scale-110 transition-all duration-500">
                        <span class="text-white font-black text-2xl leading-none">K</span>
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-400 via-indigo-400 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <span class="relative text-white font-black text-2xl leading-none">K</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-tight nav-brand-text text-white transition-colors duration-300">K-Host</span>
                        <span class="text-[9px] font-bold uppercase tracking-[0.25em] nav-sub-text text-blue-300 transition-colors duration-300 -mt-0.5">Cloud Infrastructure</span>
                    </div>
                </div>

                <div class="hidden lg:flex items-center space-x-1" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                    @foreach($categories as $category)
                        <a href="#kategori-{{ $category->id }}" class="nav-link relative px-4 py-2 text-[13px] font-semibold nav-link-text text-white/70 hover:text-white transition-all duration-300 rounded-lg hover:bg-white/5 group">
                            {{ $category->name }}
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-indigo-400 transition-all duration-300 group-hover:w-3/4 rounded-full"></span>
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center space-x-3" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200">
                    <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white transition-all duration-300 rounded-xl bg-white/10 hover:bg-white/20 border border-white/10 hover:border-white/20 backdrop-blur-md hover:-translate-y-0.5">
                        <span>Client Area</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="lg:hidden hidden bg-slate-900/95 backdrop-blur-xl border-t border-white/5">
            <div class="px-4 py-4 space-y-1">
                @foreach($categories as $category)
                    <a href="#kategori-{{ $category->id }}" class="block px-4 py-3 text-sm font-semibold text-white/70 hover:text-white hover:bg-white/5 rounded-xl transition-all">{{ $category->name }}</a>
                @endforeach
                <div class="pt-2 border-t border-white/5 mt-2">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-sm font-bold text-center text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl">Client Area</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative bg-slate-950 overflow-hidden min-h-screen flex flex-col justify-center">
        <!-- Background layers -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-[#0a1628] to-indigo-950/80 z-0"></div>
        
        <!-- Animated grid -->
        <div class="absolute inset-0 grid-pattern z-0 opacity-60"></div>
        
        <!-- Noise texture -->
        <div class="absolute inset-0 noise-overlay z-0"></div>
        
        <!-- Animated blobs -->
        <div class="absolute top-1/4 -left-20 w-[500px] h-[500px] bg-blue-600/20 rounded-full mix-blend-screen filter blur-[150px] animate-blob z-0"></div>
        <div class="absolute top-1/3 -right-20 w-[400px] h-[400px] bg-indigo-500/20 rounded-full mix-blend-screen filter blur-[150px] animate-blob animation-delay-2000 z-0"></div>
        <div class="absolute -bottom-20 left-1/3 w-[450px] h-[450px] bg-violet-600/15 rounded-full mix-blend-screen filter blur-[150px] animate-blob animation-delay-4000 z-0"></div>
        
        <!-- Floating geometric shapes -->
        <div class="absolute top-20 left-[10%] w-2 h-2 bg-blue-400/40 rounded-full animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-40 right-[15%] w-1.5 h-1.5 bg-indigo-400/30 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-[60%] left-[8%] w-1 h-1 bg-violet-400/40 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-[30%] right-[5%] w-2.5 h-2.5 bg-cyan-400/20 rounded-full animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute bottom-[20%] right-[25%] w-1.5 h-1.5 bg-blue-300/30 rounded-full animate-float" style="animation-delay: 1.5s;"></div>
        
        <!-- Orbiting ring decoration -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] lg:w-[800px] lg:h-[800px] opacity-[0.03] pointer-events-none z-0">
            <div class="absolute inset-0 rounded-full border border-blue-400/50"></div>
            <div class="absolute inset-8 rounded-full border border-indigo-400/30"></div>
            <div class="absolute inset-16 rounded-full border border-violet-400/20"></div>
        </div>

        <!-- Hero content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-44 text-center z-10 w-full">
            <!-- Status badge -->
            <div data-aos="zoom-in" data-aos-duration="800" class="inline-flex items-center px-5 py-2.5 rounded-full glass text-blue-200 text-xs sm:text-sm font-semibold mb-10 animate-float">
                <span class="relative flex h-2.5 w-2.5 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400 shadow-[0_0_10px_rgba(96,165,250,0.8)]"></span>
                </span>
                Infrastruktur Cloud & CBT Standar Enterprise
            </div>
            
            <!-- Main heading -->
            <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white tracking-tight mb-8 leading-[1.05] glow-text">
                Performa Maksimal<br class="hidden sm:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 animate-gradientShift" style="background-size: 200% 200%;">untuk Ekosistem Digital Anda</span>
            </h1>
            
            <!-- Subtitle -->
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" class="mt-8 max-w-2xl mx-auto text-lg md:text-xl text-slate-400 font-normal leading-relaxed">
                Tingkatkan skala aplikasi Anda dengan Server High-Performance. Sewa panel K-CBT Premium dengan kontrol API penuh, atau bangun infrastruktur tanpa batas di atas Cloud Hosting CyberPanel kami.
            </p>
            
            <!-- CTA buttons -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="mt-14 flex flex-col sm:flex-row justify-center gap-4">
                <a href="#kategori-{{ $categories->first()->id ?? '' }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_40px_-10px_rgba(59,130,246,0.5)] hover:shadow-[0_0_60px_-10px_rgba(59,130,246,0.8)] hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        Eksplorasi Layanan
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                    <div class="absolute inset-0 price-shimmer"></div>
                </a>
                <a href="{{ route('login') }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white/80 transition-all duration-300 rounded-2xl border border-white/10 hover:border-white/25 hover:bg-white/5 hover:text-white hover:-translate-y-1 backdrop-blur-sm">
                    <span class="flex items-center">
                        Client Area
                        <svg class="w-4 h-4 ml-2 opacity-50 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </a>
            </div>
            
            <!-- Stats bar -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="mt-20 max-w-3xl mx-auto grid grid-cols-3 gap-6">
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

        <!-- Bottom wave -->
        <div class="absolute bottom-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-16 md:h-24 lg:h-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,121.22,200.7,114.47Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </main>

    <!-- Product Sections -->
    <div class="relative bg-slate-50">
        
        <!-- Dot grid decoration -->
        <div class="absolute inset-0 dot-grid pointer-events-none opacity-40"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10">
            @foreach($categories as $category)
                <section id="kategori-{{ $category->id }}" class="pt-28 -mt-16 mb-28 scroll-mt-24">
                    
                    <!-- Section header -->
                    <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold mb-5 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-2"></span>
                            {{ $category->name }}
                        </div>
                        <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">{{ $category->name }}</h2>
                        <p class="text-slate-500 font-medium max-w-xl mx-auto text-lg">Pilih spesifikasi yang paling sesuai dengan kebutuhan skala project Anda.</p>
                        <div class="w-20 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-6 rounded-full"></div>
                    </div>

                    <!-- Product grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products->where('category_id', $category->id) as $product)
                            
                            @php
                                $aosDelay = ($loop->index % 3) * 100;
                            @endphp

                            @if($product->is_cbt_panel)
                                <!-- K-CBT Premium Card -->
                                <div data-aos="fade-up" data-aos-delay="{{ $aosDelay }}" class="relative bg-gradient-to-b from-[#0c1222] to-[#162032] rounded-3xl shadow-2xl border border-slate-700/50 hover:border-orange-500/30 transform hover:-translate-y-2 transition-all duration-500 flex flex-col overflow-hidden group hover-lift border-gradient cbt-border-gradient">
                                    
                                    <!-- Card glow -->
                                    <div class="absolute top-0 right-0 w-80 h-80 bg-orange-500/8 rounded-full blur-[100px] -mr-20 -mt-20 pointer-events-none transition-all duration-700 group-hover:bg-orange-500/15"></div>
                                    <div class="absolute bottom-0 left-0 w-60 h-60 bg-rose-500/5 rounded-full blur-[80px] -ml-10 -mb-10 pointer-events-none transition-all duration-700 group-hover:bg-rose-500/10"></div>

                                    <!-- Premium badge -->
                                    <div class="absolute top-0 right-0 z-20">
                                        <div class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[10px] font-black px-5 py-2.5 rounded-bl-2xl uppercase tracking-[0.15em] shadow-lg flex items-center shadow-orange-500/25">
                                            <svg class="w-3 h-3 mr-1.5 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            K-CBT Premium
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-8 pb-0 relative z-10">
                                        <h3 class="text-2xl font-black text-white mb-5 pr-24 leading-tight group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-orange-300 group-hover:to-rose-300 transition-all duration-500">{{ $product->name }}</h3>
                                        
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

                                        <div class="flex flex-wrap gap-2 mb-2">
                                            @foreach($badges as $badge)
                                                <div class="{{ $badge['bg'] }} border backdrop-blur-sm px-3 py-1.5 rounded-lg flex items-center hover:-translate-y-0.5 transition-all duration-300 cursor-default">
                                                    <span class="text-sm mr-1.5">{{ $badge['icon'] }}</span>
                                                    <span class="{{ $badge['color'] }} text-[10px] font-bold tracking-wide uppercase">{{ $badge['text'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Features -->
                                    <div class="p-8 pt-4 flex-1 relative z-10">
                                        <div class="h-px w-full bg-gradient-to-r from-orange-500/20 via-slate-600/50 to-transparent mb-5"></div>
                                        <ul class="space-y-3">
                                            @foreach($features as $feature)
                                                <li class="flex items-start text-sm text-slate-400 font-medium group/item">
                                                    <div class="flex-shrink-0 w-5 h-5 rounded-md bg-orange-500/10 flex items-center justify-center mr-3 border border-orange-500/15 group-hover/item:bg-orange-500 group-hover/item:border-orange-500 transition-all duration-300">
                                                        <svg class="h-3 w-3 text-orange-400 group-hover/item:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    </div>
                                                    <span class="group-hover/item:text-white transition-colors duration-300">{{ trim($feature) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Price & CTA -->
                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        <div class="bg-slate-900/60 rounded-2xl p-5 mb-5 border border-slate-700/40 backdrop-blur-sm group-hover:border-slate-600/60 transition-all duration-500">
                                            
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">Investasi Tahunan</span>
                                                @if($product->discount_percent > 0)
                                                    <span class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[9px] px-2.5 py-0.5 rounded-md font-black uppercase tracking-wider shadow-orange-500/25 shadow-sm">Save {{ $product->discount_percent }}%</span>
                                                @endif
                                            </div>
                                            
                                            @if($product->discount_percent > 0)
                                                <div class="mb-1">
                                                    <span class="relative inline-block text-sm font-bold text-slate-600">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        <span class="absolute left-0 top-1/2 w-full h-[2px] bg-orange-500/70 -translate-y-1/2 rounded-full"></span>
                                                    </span>
                                                </div>
                                            @endif

                                            <div class="flex items-baseline text-white">
                                                <span class="text-xl font-bold mr-1">Rp</span>
                                                <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                <span class="text-sm font-semibold text-slate-500 ml-2">/thn</span>
                                            </div>
                                        </div>
                                        <form action="{{ route('user.buy', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-rose-600 hover:from-orange-400 hover:to-rose-500 text-white font-bold py-4 rounded-2xl shadow-[0_8px_30px_-8px_rgba(249,115,22,0.4)] hover:shadow-[0_12px_40px_-8px_rgba(249,115,22,0.7)] transition-all duration-300 hover:-translate-y-0.5 text-sm uppercase tracking-wider">
                                                Deploy K-CBT Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @else
                                <!-- Regular Cloud Card -->
                                <div data-aos="fade-up" data-aos-delay="{{ $aosDelay }}" class="bg-white rounded-3xl shadow-lg border border-slate-100 hover:border-blue-200 transform hover:-translate-y-2 transition-all duration-500 flex flex-col relative overflow-hidden group hover-lift border-gradient">
                                    
                                    <!-- Card glow -->
                                    <div class="absolute top-0 right-0 w-72 h-72 bg-blue-50 rounded-full blur-[80px] -mr-20 -mt-20 pointer-events-none transition-all duration-700 group-hover:bg-blue-100/80"></div>

                                    <!-- Content -->
                                    <div class="p-8 border-b border-slate-100/80 relative z-10">
                                        <h3 class="text-2xl font-black text-slate-900 mb-1 group-hover:text-blue-600 transition-colors duration-300">{{ $product->name }}</h3>
                                        
                                        <!-- Popular indicator for mid-tier -->
                                        @if($loop->index % 3 === 1)
                                            <div class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                                                Populer
                                            </div>
                                        @endif
                                        
                                        <div class="mt-5">
                                            @if($product->discount_percent > 0)
                                                <div class="flex flex-col">
                                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-sm">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                                                            <span class="text-[10px] uppercase font-black tracking-wider">Hemat {{ $product->discount_percent }}%</span>
                                                        </span>
                                                        
                                                        <span class="relative inline-block text-sm font-bold text-slate-400">
                                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                                            <span class="absolute left-0 top-1/2 w-full h-[2px] bg-rose-400 -translate-y-1/2 rounded-full"></span>
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="flex items-baseline text-slate-900">
                                                        <span class="text-xl font-bold mr-1">Rp</span>
                                                        <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                        <span class="text-sm font-semibold text-slate-400 ml-2">/bln</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-baseline text-slate-900">
                                                    <span class="text-xl font-bold mr-1">Rp</span>
                                                    <span class="text-4xl font-black tracking-tight">{{ number_format($product->price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-400 ml-2">/bln</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Features -->
                                    <div class="p-8 pt-6 flex-1 relative z-10">
                                        <ul class="space-y-3">
                                            @foreach(explode('.', $product->description) as $descLine)
                                                @if(trim($descLine) != '')
                                                    <li class="flex items-start text-sm text-slate-600 font-medium group/item">
                                                        <div class="flex-shrink-0 w-5 h-5 rounded-md bg-blue-50 flex items-center justify-center mr-3 group-hover/item:bg-blue-500 transition-all duration-300">
                                                            <svg class="h-3 w-3 text-blue-500 group-hover/item:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                        </div>
                                                        <span class="group-hover/item:text-slate-900 transition-colors">{{ trim($descLine) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- CTA -->
                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        <a href="{{ route('login') }}" class="block w-full bg-slate-50 border-2 border-slate-200 text-slate-700 hover:bg-slate-900 hover:border-slate-900 hover:text-white font-bold py-4 px-4 rounded-2xl text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 text-sm uppercase tracking-wider">
                                            Pilih Paket Cloud
                                        </a>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>

                    @if($products->where('category_id', $category->id)->count() == 0)
                        <div class="text-center text-slate-400 py-20 bg-white border border-slate-100 rounded-3xl" data-aos="fade-up">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum ada paket</h3>
                            <p class="text-sm text-slate-500">Paket di kategori ini akan segera tersedia.</p>
                        </div>
                    @endif

                </section>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="relative bg-slate-950 pt-20 pb-10 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 to-slate-950 z-0"></div>
        <div class="absolute inset-0 grid-pattern opacity-30 z-0"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <!-- Top section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <!-- Brand -->
                <div data-aos="fade-up" data-aos-duration="800">
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-indigo-500 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <span class="text-white font-black text-xl leading-none">K</span>
                        </div>
                        <div>
                            <span class="text-xl font-black text-white tracking-tight">K-Host</span>
                            <span class="block text-[9px] font-bold uppercase tracking-[0.2em] text-blue-400 -mt-0.5">Cloud Infrastructure</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-xs">Solusi server dan panel CBT terbaik untuk menunjang kebutuhan ujian berskala masif dan project digital Anda.</p>
                </div>
                
                <!-- Quick links -->
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Layanan</h4>
                    <ul class="space-y-3">
                        @foreach($categories as $category)
                            <li>
                                <a href="#kategori-{{ $category->id }}" class="text-sm text-slate-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <svg class="w-3 h-3 mr-2 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Contact / Info -->
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Informasi</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-slate-400">
                            <svg class="w-4 h-4 mr-2.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            support@k-host.id
                        </li>
                        <li class="flex items-center text-sm text-slate-400">
                            <svg class="w-4 h-4 mr-2.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Response time &lt; 30 menit
                        </li>
                        <li class="flex items-center text-sm text-slate-400">
                            <svg class="w-4 h-4 mr-2.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            99.9% Uptime Guarantee
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-800 to-transparent mb-8"></div>
            
            <!-- Bottom section -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-xs font-medium tracking-wide">
                    &copy; {{ date('Y') }} K-Projects. All rights reserved.
                </p>
                <div class="flex items-center space-x-1 text-xs text-slate-600">
                    <span>Powered by</span>
                    <span class="font-bold text-slate-400">K-Host Cloud</span>
                    <span class="inline-block w-1.5 h-1.5 bg-emerald-500 rounded-full ml-1 animate-pulse"></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // AOS Init
        AOS.init({
            once: false,
            mirror: true,
            offset: 80,
            duration: 700,
            easing: 'ease-out-cubic',
        });

        // Navbar scroll behavior
        const nav = document.getElementById('mainNav');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;
            
            if (currentScroll > 100) {
                nav.classList.add('bg-slate-950/80', 'backdrop-blur-2xl', 'shadow-lg', 'shadow-black/5');
                nav.classList.remove('bg-transparent');
                // Update nav text colors
                nav.querySelectorAll('.nav-brand-text').forEach(el => {
                    el.classList.add('text-white');
                    el.classList.remove('text-white');
                });
            } else {
                nav.classList.remove('bg-slate-950/80', 'backdrop-blur-2xl', 'shadow-lg', 'shadow-black/5');
                nav.classList.add('bg-transparent');
            }
            
            lastScroll = currentScroll;
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Active section highlighting
        const sections = document.querySelectorAll('section[id^="kategori-"]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('nav-link-active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('nav-link-active');
                }
            });
        });
    </script>
</body>
</html>