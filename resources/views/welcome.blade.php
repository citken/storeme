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
                        blob: "blob 12s infinite",
                        float: "float 6s ease-in-out infinite",
                        shimmer: "shimmer 2.5s linear infinite",
                        pulseGlow: "pulseGlow 3s ease-in-out infinite",
                        gradientShift: "gradientShift 8s ease infinite",
                        fadeInUp: "fadeInUp 0.5s ease-out forwards",
                        scaleIn: "scaleIn 0.4s ease-out forwards",
                    },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)" },
                            "33%": { transform: "translate(20px, -35px) scale(1.1)" },
                            "66%": { transform: "translate(-15px, 20px) scale(0.9)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)" },
                        },
                        float: {
                            "0%, 100%": { transform: "translateY(0px)" },
                            "50%": { transform: "translateY(-8px)" },
                        },
                        shimmer: {
                            "0%": { backgroundPosition: "-200% 0" },
                            "100%": { backgroundPosition: "200% 0" },
                        },
                        pulseGlow: {
                            "0%, 100%": { opacity: "0.5", transform: "scale(1)" },
                            "50%": { opacity: "0.8", transform: "scale(1.03)" },
                        },
                        gradientShift: {
                            "0%, 100%": { backgroundPosition: "0% 50%" },
                            "50%": { backgroundPosition: "100% 50%" },
                        },
                        fadeInUp: {
                            "0%": { opacity: "0", transform: "translateY(20px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" },
                        },
                        scaleIn: {
                            "0%": { opacity: "0", transform: "scale(0.95)" },
                            "100%": { opacity: "1", transform: "scale(1)" },
                        },
                    }
                }
            }
        }
    </script>
    <style>
        /* PERFORMANCE OPTIMIZATIONS */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #3b82f6, #6366f1); 
            border-radius: 10px; 
        }
        
        /* GPU acceleration for animated elements */
        .animate-blob, .animate-float, .hover-lift, .group:hover .group-hover\:translate-y-0\.5 {
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden;
        }
        
        /* Optimized blur - reduced render cost */
        .blur-optimized {
            filter: blur(80px);
            transform: translateZ(0);
        }
        
        .blur-soft {
            filter: blur(64px);
            transform: translateZ(0);
        }
        
        /* Faster category section toggling - no max-height transitions */
        .category-section {
            transition: opacity 0.2s ease, transform 0.2s ease;
            will-change: opacity, transform;
        }
        
        .category-section.section-hidden {
            display: none !important;
            opacity: 0;
            transform: scale(0.98);
            pointer-events: none;
        }
        
        .category-section.section-visible {
            display: block;
            opacity: 1;
            transform: scale(1);
        }
        
        /* Content visibility for off-screen cards */
        .product-card {
            content-visibility: auto;
            contain-intrinsic-size: auto 480px;
        }
        
        /* Navbar optimizations */
        .nav-scrolled {
            background: rgba(2, 6, 23, 0.92) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: background 0.2s ease, backdrop-filter 0.2s ease;
        }
        
        /* Filter bar sticky - reduced complexity */
        .filter-bar-glass {
            background: rgba(248, 250, 252, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Glass morphism optimization - lighter backdrop */
        .glass {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        /* Noise overlay - lighter version */
        .noise-overlay::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n' x='0' y='0'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.7' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.02'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }
        
        /* Simplified grid pattern - cheaper */
        .grid-pattern-light {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.02) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        
        /* Dot grid decoration - lighter */
        .dot-grid {
            background-image: radial-gradient(rgba(148, 163, 184, 0.1) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        
        /* Active category styles */
        .cat-filter-btn.active {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #fff !important;
            border-color: transparent;
            box-shadow: 0 2px 8px -2px rgba(59, 130, 246, 0.4);
        }
        
        .nav-pill.active-pill {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa !important;
        }
        
        .nav-pill.active-pill::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            border-radius: 999px;
        }
        
        /* Hover lift with GPU */
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1), box-shadow 0.3s ease;
            will-change: transform;
        }
        
        .hover-lift:hover {
            transform: translateY(-6px);
        }
        
        /* Prevent layout shift */
        img, svg, video {
            max-width: 100%;
            vertical-align: middle;
        }
        
        /* Lazy AOS - initial elements visible to avoid FOUC */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
            transition-duration: 0.5s;
            transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        [data-aos].aos-animate {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        
        /* Reduce motion if prefers reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .animate-blob, .animate-float, .hover-lift, [data-aos] {
                animation: none !important;
                transition: none !important;
                transform: none !important;
            }
        }
        
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 overflow-x-hidden">
    
    <!-- Navigation -->
    <nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-200 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" id="navLogo" class="flex items-center space-x-2.5 group cursor-pointer">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 via-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 group-hover:scale-105 transition-all duration-200">
                        <span class="text-white font-black text-lg leading-none">K</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-extrabold tracking-tight text-white leading-none">K-Host</span>
                        <span class="text-[8px] font-semibold uppercase tracking-[0.2em] text-blue-300/80 leading-none mt-0.5">Cloud Infrastructure</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center bg-white/5 rounded-full p-1 border border-white/5">
                    <a href="#" data-category="all" class="nav-pill active-pill relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 transition-all duration-200 rounded-full cursor-pointer">Semua</a>
                    <a href="#" data-category="cat1" class="nav-pill relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 transition-all duration-200 rounded-full cursor-pointer">Enterprise Cloud</a>
                    <a href="#" data-category="cat2" class="nav-pill relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 transition-all duration-200 rounded-full cursor-pointer">K-CBT Panel</a>
                    <a href="#" data-category="cat3" class="nav-pill relative px-4 py-1.5 text-[12px] font-semibold text-white/60 hover:text-white/90 transition-all duration-200 rounded-full cursor-pointer">CyberPanel Hosting</a>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="#" class="hidden sm:inline-flex group relative items-center justify-center px-5 py-2 text-[13px] font-bold text-white transition-all duration-200 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-md shadow-blue-500/20 hover:shadow-blue-500/30 hover:-translate-y-0.5">
                        <span>Client Area</span>
                        <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div id="mobileMenu" class="lg:hidden hidden bg-slate-900/95 backdrop-blur-xl border-t border-white/5">
            <div class="px-4 py-4 space-y-1">
                <a href="#" data-category="all" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-blue-400 hover:text-white hover:bg-white/5 rounded-xl transition-all">Semua Layanan</a>
                <a href="#" data-category="cat1" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-white/70 hover:text-white hover:bg-white/5 rounded-xl transition-all">Enterprise Cloud</a>
                <a href="#" data-category="cat2" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-white/70 hover:text-white hover:bg-white/5 rounded-xl transition-all">K-CBT Panel</a>
                <a href="#" data-category="cat3" class="cat-nav-link-mobile block px-4 py-3 text-sm font-semibold text-white/70 hover:text-white hover:bg-white/5 rounded-xl transition-all">CyberPanel Hosting</a>
                <div class="pt-2 border-t border-white/5 mt-2">
                    <a href="#" class="block px-4 py-3 text-sm font-bold text-center text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl">Client Area</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative bg-slate-950 overflow-hidden min-h-screen flex flex-col justify-center">
        <!-- Background layers - optimized blur -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-[#0a1628] to-indigo-950/80 z-0"></div>
        <div class="absolute inset-0 grid-pattern-light z-0 opacity-50"></div>
        <div class="absolute inset-0 noise-overlay z-0"></div>
        
        <!-- Animated blobs with reduced blur radius for performance -->
        <div class="absolute top-1/4 -left-20 w-[400px] h-[400px] bg-blue-600/20 rounded-full mix-blend-screen blur-optimized animate-blob z-0"></div>
        <div class="absolute top-1/3 -right-20 w-[350px] h-[350px] bg-indigo-500/20 rounded-full mix-blend-screen blur-optimized animate-blob animation-delay-2000 z-0"></div>
        <div class="absolute -bottom-20 left-1/3 w-[380px] h-[380px] bg-violet-600/15 rounded-full mix-blend-screen blur-optimized animate-blob animation-delay-4000 z-0"></div>
        
        <!-- Floating dots - reduced count for performance -->
        <div class="absolute top-20 left-[10%] w-2 h-2 bg-blue-400/40 rounded-full animate-float" style="animation-delay: 0s;"></div>
        <div class="absolute top-40 right-[15%] w-1.5 h-1.5 bg-indigo-400/30 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-[60%] left-[8%] w-1 h-1 bg-violet-400/40 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-[20%] right-[25%] w-1.5 h-1.5 bg-blue-300/30 rounded-full animate-float" style="animation-delay: 1.5s;"></div>

        <!-- Hero content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-44 text-center z-10 w-full">
            <div data-aos="zoom-in" data-aos-duration="600" class="inline-flex items-center px-5 py-2.5 rounded-full glass text-blue-200 text-xs sm:text-sm font-semibold mb-10">
                <span class="relative flex h-2.5 w-2.5 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400 shadow-[0_0_10px_rgba(96,165,250,0.8)]"></span>
                </span>
                Infrastruktur Cloud & CBT Standar Enterprise
            </div>
            
            <h1 data-aos="fade-up" data-aos-duration="700" data-aos-delay="100" class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white tracking-tight mb-8 leading-[1.05]">
                Performa Maksimal<br class="hidden sm:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 animate-gradientShift" style="background-size: 200% 200%;">untuk Ekosistem Digital Anda</span>
            </h1>
            
            <p data-aos="fade-up" data-aos-duration="700" data-aos-delay="200" class="mt-8 max-w-2xl mx-auto text-lg md:text-xl text-slate-400 font-normal leading-relaxed">
                Tingkatkan skala aplikasi Anda dengan Server High-Performance. Sewa panel K-CBT Premium dengan kontrol API penuh, atau bangun infrastruktur tanpa batas di atas Cloud Hosting CyberPanel kami.
            </p>
            
            <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="300" class="mt-14 flex flex-col sm:flex-row justify-center gap-4">
                <a href="#products" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_30px_-10px_rgba(59,130,246,0.4)] hover:shadow-[0_0_40px_-10px_rgba(59,130,246,0.6)] hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        Eksplorasi Layanan
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                    <div class="absolute inset-0 price-shimmer"></div>
                </a>
                <a href="#" class="group inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white/80 transition-all duration-200 rounded-2xl border border-white/10 hover:border-white/25 hover:bg-white/5 hover:text-white hover:-translate-y-1 backdrop-blur-sm">
                    <span class="flex items-center">
                        Client Area
                        <svg class="w-4 h-4 ml-2 opacity-50 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </a>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="500" class="mt-20 max-w-3xl mx-auto grid grid-cols-3 gap-6">
                <div class="text-center group cursor-default">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-blue-400 transition-colors duration-200">99.9%</div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Uptime SLA</div>
                </div>
                <div class="text-center group cursor-default border-x border-white/5">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-indigo-400 transition-colors duration-200">10Gbps</div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Network Port</div>
                </div>
                <div class="text-center group cursor-default">
                    <div class="text-3xl md:text-4xl font-black text-white mb-1 group-hover:text-violet-400 transition-colors duration-200">24/7</div>
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

    <!-- Product Sections -->
    <div id="products" class="relative bg-slate-50">
        <div class="absolute inset-0 dot-grid pointer-events-none opacity-30"></div>
        
        <!-- Sticky Category Filter Bar -->
        <div id="filterBar" class="sticky top-16 z-40 filter-bar-glass transition-all duration-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 overflow-x-auto pb-0.5 scrollbar-hide">
                        <button data-category="all" class="cat-filter-btn active whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 bg-white transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Semua
                        </button>
                        <button data-category="cat1" class="cat-filter-btn whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 bg-white transition-all duration-200">Enterprise Cloud</button>
                        <button data-category="cat2" class="cat-filter-btn whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 bg-white transition-all duration-200">K-CBT Panel</button>
                        <button data-category="cat3" class="cat-filter-btn whitespace-nowrap inline-flex items-center px-4 py-2 text-[12px] font-bold rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 bg-white transition-all duration-200">CyberPanel Hosting</button>
                    </div>
                    <div class="hidden sm:flex items-center text-[11px] text-slate-400 font-medium ml-4 flex-shrink-0">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 z-10">
            <!-- Category 1: Enterprise Cloud -->
            <section data-section-category="cat1" class="category-section section-visible pt-20 mb-20 scroll-mt-36">
                <div class="text-center mb-14" data-aos="fade-up" data-aos-duration="600">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold mb-5 uppercase tracking-widest"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-2"></span>Enterprise Cloud</div>
                    <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">Enterprise Cloud</h2>
                    <p class="text-slate-500 font-medium max-w-xl mx-auto text-lg">Pilih spesifikasi yang paling sesuai dengan kebutuhan skala project Anda.</p>
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-6 rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cloud products -->
                    <div data-aos="fade-up" class="bg-white rounded-3xl shadow-lg border border-slate-100 hover:border-blue-200 transform hover:-translate-y-1 transition-all duration-300 flex flex-col relative overflow-hidden group hover-lift product-card"><div class="p-8 border-b border-slate-100"><h3 class="text-2xl font-black text-slate-900 mb-1">Cloud Starter</h3><div class="mt-5"><div class="flex items-baseline text-slate-900"><span class="text-xl font-bold mr-1">Rp</span><span class="text-4xl font-black">249.000</span><span class="text-sm font-semibold text-slate-400 ml-2">/bln</span></div></div></div><div class="p-8 pt-6 flex-1"><ul class="space-y-3"><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-blue-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>2 vCPU Core</span></li><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-blue-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>4 GB RAM DDR4</span></li><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-blue-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>50 GB NVMe SSD</span></li></ul></div><div class="p-8 pt-0 mt-auto"><a href="#" class="block w-full bg-slate-50 border-2 border-slate-200 text-slate-700 hover:bg-slate-900 hover:border-slate-900 hover:text-white font-bold py-4 rounded-2xl text-center transition-all duration-200">Pilih Paket Cloud</a></div></div>
                </div>
            </section>

            <!-- Category 2: K-CBT Panel with Premium Card -->
            <section data-section-category="cat2" class="category-section section-visible pt-20 mb-20 scroll-mt-36">
                <div class="text-center mb-14" data-aos="fade-up"><div class="inline-flex items-center px-4 py-1.5 rounded-full bg-orange-50 border border-orange-100 text-orange-600 text-xs font-bold mb-5 uppercase tracking-widest"><span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-2"></span>K-CBT Panel</div><h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">K-CBT Panel</h2><p class="text-slate-500 font-medium max-w-xl mx-auto text-lg">Solusi ujian CBT Enterprise dengan performa maksimal.</p><div class="w-20 h-1 bg-gradient-to-r from-orange-600 to-rose-600 mx-auto mt-6 rounded-full"></div></div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- K-CBT Premium Card -->
                    <div data-aos="fade-up" class="relative bg-gradient-to-b from-[#0c1222] to-[#162032] rounded-3xl shadow-2xl border border-slate-700/50 hover:border-orange-500/30 transform hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden group hover-lift product-card"><div class="absolute top-0 right-0 z-20"><div class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[10px] font-black px-5 py-2.5 rounded-bl-2xl uppercase tracking-[0.15em] shadow-lg flex items-center"><svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>K-CBT Premium</div></div><div class="p-8 pb-0 relative z-10"><h3 class="text-2xl font-black text-white mb-5 pr-24">K-CBT Enterprise</h3><div class="flex flex-wrap gap-2 mb-2"><div class="bg-blue-500/10 border border-blue-400/20 backdrop-blur-sm px-3 py-1.5 rounded-lg"><span class="text-sm mr-1.5">👥</span><span class="text-blue-300 text-[10px] font-bold">5.000 User Concurrent</span></div><div class="bg-amber-500/10 border border-amber-400/20 backdrop-blur-sm px-3 py-1.5 rounded-lg"><span class="text-sm mr-1.5">⚡</span><span class="text-amber-300 text-[10px] font-bold">8 Core Dedicated</span></div></div></div><div class="p-8 pt-4 flex-1"><div class="h-px w-full bg-gradient-to-r from-orange-500/20 via-slate-600/50 to-transparent mb-5"></div><ul class="space-y-3"><li class="flex items-start text-sm text-slate-400"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-orange-500/10 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>Unlimited Ujian & Tryout</span></li><li class="flex items-start text-sm text-slate-400"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-orange-500/10 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>Anti-Cheat & Proctoring</span></li><li class="flex items-start text-sm text-slate-400"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-orange-500/10 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>API Full Integration</span></li></ul></div><div class="p-8 pt-0 mt-auto"><div class="bg-slate-900/60 rounded-2xl p-5 mb-5 border border-slate-700/40"><div class="flex justify-between items-center mb-2"><span class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">Investasi Tahunan</span><span class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[9px] px-2.5 py-0.5 rounded-md font-black">Save 20%</span></div><div class="mb-1"><span class="relative inline-block text-sm font-bold text-slate-600">Rp 14.999.000<span class="absolute left-0 top-1/2 w-full h-[2px] bg-orange-500/70 -translate-y-1/2 rounded-full"></span></span></div><div class="flex items-baseline text-white"><span class="text-xl font-bold mr-1">Rp</span><span class="text-4xl font-black">11.999.000</span><span class="text-sm font-semibold text-slate-500 ml-2">/thn</span></div></div><button class="w-full bg-gradient-to-r from-orange-500 to-rose-600 hover:from-orange-400 hover:to-rose-500 text-white font-bold py-4 rounded-2xl transition-all duration-200 text-sm uppercase tracking-wider">Deploy K-CBT Sekarang</button></div></div>
                </div>
            </section>

            <!-- Category 3: CyberPanel Hosting -->
            <section data-section-category="cat3" class="category-section section-visible pt-20 mb-20 scroll-mt-36">
                <div class="text-center mb-14" data-aos="fade-up"><div class="inline-flex items-center px-4 py-1.5 rounded-full bg-purple-50 border border-purple-100 text-purple-600 text-xs font-bold mb-5 uppercase tracking-widest"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full mr-2"></span>CyberPanel Hosting</div><h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">CyberPanel Hosting</h2><p class="text-slate-500 font-medium max-w-xl mx-auto text-lg">Cloud hosting dengan kontrol penuh & performa LiteSpeed.</p><div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full"></div></div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div data-aos="fade-up" class="bg-white rounded-3xl shadow-lg border border-slate-100 hover:border-purple-200 transition-all duration-300 flex flex-col group hover-lift product-card"><div class="p-8 border-b border-slate-100"><h3 class="text-2xl font-black text-slate-900 mb-1">CyberPanel Pro</h3><div class="mt-5"><div class="flex items-baseline text-slate-900"><span class="text-xl font-bold mr-1">Rp</span><span class="text-4xl font-black">499.000</span><span class="text-sm font-semibold text-slate-400 ml-2">/bln</span></div></div></div><div class="p-8 pt-6 flex-1"><ul class="space-y-3"><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-purple-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>4 vCPU / 8 GB RAM</span></li><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-purple-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>LiteSpeed Web Server</span></li><li class="flex items-start text-sm text-slate-600"><div class="flex-shrink-0 w-5 h-5 rounded-md bg-purple-50 flex items-center justify-center mr-3"><svg class="h-3 w-3 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span>SSL Gratis & Backup</span></li></ul></div><div class="p-8 pt-0 mt-auto"><a href="#" class="block w-full bg-slate-50 border-2 border-slate-200 text-slate-700 hover:bg-slate-900 hover:border-slate-900 hover:text-white font-bold py-4 rounded-2xl text-center transition-all duration-200">Pilih Hosting</a></div></div>
                </div>
            </section>
        </div>
    </div>

    <footer class="relative bg-slate-950 pt-20 pb-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 to-slate-950 z-0"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <div data-aos="fade-up"><div class="flex items-center space-x-2.5 mb-5"><div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center"><span class="text-white font-black text-lg">K</span></div><div><span class="text-lg font-extrabold text-white">K-Host</span><span class="block text-[8px] font-bold uppercase tracking-[0.2em] text-blue-400">Cloud Infrastructure</span></div></div><p class="text-slate-400 text-sm">Solusi server dan panel CBT terbaik untuk ujian berskala masif.</p></div>
                <div data-aos="fade-up" data-aos-delay="100"><h4 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Layanan</h4><ul class="space-y-3"><li><a href="#" data-category="cat1" class="text-sm text-slate-400 hover:text-white transition-colors">Enterprise Cloud</a></li><li><a href="#" data-category="cat2" class="text-sm text-slate-400 hover:text-white transition-colors">K-CBT Panel</a></li><li><a href="#" data-category="cat3" class="text-sm text-slate-400 hover:text-white transition-colors">CyberPanel Hosting</a></li></ul></div>
                <div data-aos="fade-up" data-aos-delay="200"><h4 class="text-sm font-bold text-white uppercase tracking-wider mb-5">Kontak</h4><ul class="space-y-3"><li class="flex items-center text-sm text-slate-400">support@k-host.id</li><li class="flex items-center text-sm text-slate-400">Response &lt; 30 menit</li><li class="flex items-center text-sm text-slate-400">99.9% Uptime Guarantee</li></ul></div>
            </div>
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-800 to-transparent mb-8"></div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4"><p class="text-slate-500 text-xs">&copy; 2025 K-Projects. All rights reserved.</p><div class="flex items-center space-x-1 text-xs text-slate-600"><span>Powered by</span><span class="font-bold text-slate-400">K-Host Cloud</span><span class="inline-block w-1.5 h-1.5 bg-emerald-500 rounded-full ml-1 animate-pulse"></span></div></div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        (function(){
            // Defer non-critical initialization
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }
            
            function init() {
                // AOS initialization with performance settings
                AOS.init({
                    once: true,
                    mirror: false,
                    offset: 60,
                    duration: 500,
                    easing: 'ease-out-cubic',
                    disable: 'mobile'  // Disable on mobile for performance
                });
                
                // Navbar scroll
                const nav = document.getElementById('mainNav');
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 80) nav.classList.add('nav-scrolled');
                    else nav.classList.remove('nav-scrolled');
                }, { passive: true });
                
                // Mobile menu
                const mobileBtn = document.getElementById('mobileMenuBtn');
                const mobileMenu = document.getElementById('mobileMenu');
                if(mobileBtn) {
                    mobileBtn.addEventListener('click', () => {
                        mobileMenu.classList.toggle('hidden');
                    });
                    mobileMenu.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
                    });
                }
                
                // Category Filter System
                const sections = document.querySelectorAll('.category-section');
                const filterBtns = document.querySelectorAll('.cat-filter-btn');
                const navPills = document.querySelectorAll('.nav-pill');
                const mobileNavLinks = document.querySelectorAll('.cat-nav-link-mobile');
                
                function filterCategories(categoryId) {
                    sections.forEach(section => {
                        const sectionCat = section.dataset.sectionCategory;
                        if (categoryId === 'all' || sectionCat === categoryId) {
                            section.classList.remove('section-hidden');
                            section.classList.add('section-visible');
                        } else {
                            section.classList.remove('section-visible');
                            section.classList.add('section-hidden');
                        }
                    });
                    
                    filterBtns.forEach(btn => {
                        btn.classList.remove('active');
                        if (btn.dataset.category === categoryId) btn.classList.add('active');
                    });
                    
                    navPills.forEach(pill => {
                        pill.classList.remove('active-pill');
                        if (pill.dataset.category === categoryId) pill.classList.add('active-pill');
                    });
                    
                    mobileNavLinks.forEach(link => {
                        link.classList.remove('text-blue-400');
                        link.classList.add('text-white/70');
                        if (link.dataset.category === categoryId) {
                            link.classList.remove('text-white/70');
                            link.classList.add('text-blue-400');
                        }
                    });
                    
                    setTimeout(() => AOS.refresh(), 50);
                }
                
                filterBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const catId = btn.dataset.category;
                        filterCategories(catId);
                        const targetId = catId === 'all' ? 'products' : `kategori-${catId}`;
                        const target = document.getElementById(targetId) || document.getElementById('products');
                        if(target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    });
                });
                
                navPills.forEach(pill => {
                    pill.addEventListener('click', (e) => {
                        e.preventDefault();
                        const catId = pill.dataset.category;
                        filterCategories(catId);
                        const targetId = catId === 'all' ? 'products' : `kategori-${catId}`;
                        const target = document.getElementById(targetId) || document.getElementById('products');
                        if(target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    });
                });
                
                mobileNavLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const catId = link.dataset.category;
                        filterCategories(catId);
                        mobileMenu.classList.add('hidden');
                        const targetId = catId === 'all' ? 'products' : `kategori-${catId}`;
                        const target = document.getElementById(targetId) || document.getElementById('products');
                        if(target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    });
                });
                
                document.getElementById('navLogo')?.addEventListener('click', (e) => {
                    e.preventDefault();
                    filterCategories('all');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
                
                // Scroll spy - lightweight
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && window.scrollY > 300) {
                            const catId = entry.target.dataset.sectionCategory;
                            navPills.forEach(pill => {
                                pill.classList.remove('active-pill');
                                if (pill.dataset.category === catId) pill.classList.add('active-pill');
                            });
                        }
                    });
                }, { rootMargin: '-30% 0px -60% 0px', threshold: 0 });
                
                sections.forEach(section => observer.observe(section));
                
                window.addEventListener('scroll', () => {
                    if (window.scrollY < 400) {
                        navPills.forEach(pill => {
                            pill.classList.remove('active-pill');
                            if (pill.dataset.category === 'all') pill.classList.add('active-pill');
                        });
                    }
                }, { passive: true });
            }
        })();
    </script>
</body>
</html>