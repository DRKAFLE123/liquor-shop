<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Premium Liquor Shop') - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
        /* Show hamburger only on mobile */
        @media (max-width: 767px) {
            .hamburger-btn {
                display: flex !important;
            }
        }
    </style>
</head>

<body class="antialiased bg-liquor-dark text-white font-poppins min-h-screen flex flex-col">

    {{-- ============================================================
    HEADER + MOBILE DRAWER — single Alpine scope
    ============================================================ --}}
    <div x-data="{ scrolled: false, socialOpen: false, menuOpen: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        @keydown.escape.window="menuOpen = false; socialOpen = false">

        {{-- Fixed top navbar --}}
        <header :class="{
                'bg-black/95 border-b border-liquor-gold/30 py-3 shadow-lg': scrolled,
                'bg-transparent py-5 md:py-6': !scrolled,
                'z-[110] bg-black border-b border-white/10': menuOpen
            }" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out">
            <nav class="mx-auto px-4 md:px-12 flex justify-between items-center w-full">

                {{-- Logo --}}
                <a href="/"
                    class="text-xl sm:text-2xl md:text-3xl font-bold tracking-tighter text-liquor-gold flex items-center group flex-shrink-0">
                    <span class="mr-1.5">🔱</span>
                    <span>LIQUOR<span
                            class="text-white group-hover:text-liquor-gold transition-colors">SHOP</span></span>
                </a>

                {{-- Desktop nav links --}}
                <div class="hidden md:flex items-center gap-8 lg:gap-12">
                    @foreach (['Home' => '/', 'Catalogue' => '/catalogue', 'About Us' => '/about', 'Contact' => '/contact'] as $label => $url)
                        <a href="{{ $url }}"
                            class="group relative py-2 px-1 text-sm font-bold uppercase tracking-[0.2em] {{ Request::is(trim($url, '/')) || (Request::is('/') && $url == '/') ? 'text-liquor-gold' : 'text-white/75' }} hover:text-white transition-colors">
                            {{ $label }}
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                        </a>
                    @endforeach
                </div>

                {{-- Right-side icons --}}
                <div class="flex items-center gap-1 md:gap-10 flex-shrink-0">

                    {{-- Social dropdown --}}
                    <div class="relative">
                        <button @click="socialOpen = !socialOpen" @click.outside="socialOpen = false"
                            :class="socialOpen ? 'text-liquor-gold' : 'text-white/80'"
                            class="p-2 hover:text-liquor-gold transition-colors duration-200 focus:outline-none"
                            title="Connect">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                        {{-- Social icons row --}}
                        <div x-show="socialOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="absolute right-0 top-9 flex items-center gap-5 py-2">
                            @if($shop->whatsapp ?? false)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $shop->whatsapp) }}" target="_blank"
                                    class="text-white hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="WhatsApp">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                </a>
                            @endif
                            @if($shop->facebook ?? false)
                                <a href="{{ $shop->facebook }}" target="_blank"
                                    class="text-white hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="Facebook">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3l-.5 3H13v6.8c4.56-.93 8-4.96 8-9.8z" />
                                    </svg>
                                </a>
                            @endif
                            @if($shop->instagram ?? false)
                                <a href="{{ $shop->instagram }}" target="_blank"
                                    class="text-white hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="Instagram">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.778 6.98 6.978 1.28.058 1.688.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Search icon --}}
                    <a href="/search"
                        class="p-2 text-white/80 hover:text-liquor-gold transition-colors duration-200 flex-shrink-0"
                        title="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </a>

                    {{-- ☰ Hamburger Toggle — mobile only --}}
                    <button @click="menuOpen = !menuOpen"
                        class="hamburger-btn md:hidden w-10 h-10 items-center justify-center text-white focus:outline-none flex-shrink-0"
                        aria-label="Toggle menu">
                        <div class="flex flex-col gap-1.5 w-7">
                            <span
                                class="block h-[2px] w-full bg-white rounded-full transition-all duration-300 origin-center"
                                :class="menuOpen ? 'rotate-45 translate-y-[9px]' : ''"></span>
                            <span class="block h-[2px] w-full bg-white rounded-full transition-all duration-300"
                                :class="menuOpen ? 'opacity-0' : ''"></span>
                            <span
                                class="block h-[2px] w-full bg-white rounded-full transition-all duration-300 origin-center"
                                :class="menuOpen ? '-rotate-45 -translate-y-[9px]' : ''"></span>
                        </div>
                    </button>

                </div>
            </nav>
        </header>

        {{-- ============================================================
        MOBILE DRAWER — slides from LEFT, triggered from RIGHT
        ============================================================ --}}

        {{-- Backdrop --}}
        <div x-show="menuOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="menuOpen = false"
            class="fixed inset-0 z-[100] bg-black/60 backdrop-blur-sm md:hidden">
        </div>

        {{-- Drawer panel (Left Side) --}}
        <div x-show="menuOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-250 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-full z-[110] flex flex-col bg-black border-r border-white/10 shadow-2xl md:hidden"
            style="width:80vw; max-width:300px">

            {{-- Drawer Content --}}
            <div class="flex flex-col h-full py-12 px-8">

                {{-- Logo/Header --}}
                <div class="mb-12">
                    <div class="text-xl font-bold tracking-tighter text-liquor-gold flex items-center">
                        <span class="mr-1.5">🔱</span>
                        <span>LIQUOR<span class="text-white">SHOP</span></span>
                    </div>
                </div>

                {{-- Nav links --}}
                <nav class="flex flex-col gap-6 mb-12">
                    @foreach (['Home' => '/', 'Catalogue' => '/catalogue', 'About Us' => '/about', 'Contact' => '/contact'] as $label => $url)
                                    <a href="{{ $url }}" @click="menuOpen = false" class="text-lg font-bold uppercase tracking-[0.2em] transition-all duration-200
                                                                                            {{ Request::is(trim($url, '/')) || (Request::is('/') && $url == '/')
                        ? 'text-liquor-gold'
                        : 'text-white hover:text-liquor-gold' }}">
                                        {{ $label }}
                                    </a>
                    @endforeach
                </nav>

                {{-- Social Section --}}
                <div class="mt-auto border-t border-white/10 pt-8">
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/30 mb-6">Connect</p>
                    <div class="flex items-center gap-6">
                        @if($shop->whatsapp ?? false)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $shop->whatsapp) }}" target="_blank"
                                class="text-white hover:text-liquor-gold transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </a>
                        @endif
                        @if($shop->facebook ?? false)
                            <a href="{{ $shop->facebook }}" target="_blank"
                                class="text-white hover:text-liquor-gold transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3l-.5 3H13v6.8c4.56-.93 8-4.96 8-9.8z" />
                                </svg>
                            </a>
                        @endif
                        @if($shop->instagram ?? false)
                            <a href="{{ $shop->instagram }}" target="_blank"
                                class="text-white hover:text-liquor-gold transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.778 6.98 6.978 1.28.058 1.688.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        {{-- end drawer --}}

    </div>{{-- end x-data wrapper --}}

    @yield('content')

    {{-- ============================================================
    FOOTER — properly spaced, 3-column desktop / stacked mobile
    ============================================================ --}}
    <footer class="bg-black border-t border-white/8 mt-auto">
        <div class="container mx-auto px-6 py-16">

            {{-- 3 columns: Brand | Links | Connect --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-10">

                {{-- Brand --}}
                <div>
                    <div class="text-2xl font-bold tracking-tighter text-liquor-gold mb-4">
                        🔱 LIQUOR<span class="text-white">SHOP</span>
                    </div>
                    <p class="text-white/35 text-sm leading-relaxed max-w-xs">
                        {{ $shop->tagline ?? 'Premium spirits, curated for the discerning palate.' }}
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/30 mb-8 md:mb-10">Quick Links
                    </h4>
                    <ul class="space-y-3">
                        @foreach(['Home' => '/', 'Catalogue' => '/catalogue', 'About Us' => '/about', 'Contact' => '/contact'] as $label => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="text-white/45 hover:text-liquor-gold text-sm transition-colors duration-200 hover:pl-1 inline-block">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Connect --}}
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/30 mb-8 md:mb-10">Connect
                    </h4>

                    {{-- Contact info --}}
                    <ul class="space-y-4 mb-8">
                        @if($shop->phone ?? false)
                            <li class="flex items-center group">
                                <span
                                    class="w-5 h-5 flex items-center justify-start mr-3 text-liquor-gold group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </span>
                                <span class="text-white/45 text-sm">{{ $shop->phone }}</span>
                            </li>
                        @endif
                        @if($shop->email ?? false)
                            <li class="flex items-center group">
                                <span
                                    class="w-5 h-5 flex items-center justify-start mr-3 text-liquor-gold group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span class="text-white/45 text-sm break-all">{{ $shop->email }}</span>
                            </li>
                        @endif
                        @if($shop->address ?? false)
                            <li class="flex items-start group">
                                <span
                                    class="w-5 h-5 flex items-center justify-start mr-3 mt-0.5 text-liquor-gold group-hover:scale-110 transition-transform flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <span class="text-white/45 text-sm">{{ $shop->address }}</span>
                            </li>
                        @endif
                    </ul>

                    {{-- Social icons row --}}
                    @if(($shop->whatsapp ?? false) || ($shop->facebook ?? false) || ($shop->instagram ?? false))
                        <div class="flex items-center gap-6 pt-6 mt-2 border-t border-white/5">
                            @if($shop->whatsapp ?? false)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $shop->whatsapp) }}" target="_blank"
                                    class="text-white/35 hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="WhatsApp">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                </a>
                            @endif
                            @if($shop->facebook ?? false)
                                <a href="{{ $shop->facebook }}" target="_blank"
                                    class="text-white/35 hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="Facebook">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3l-.5 3H13v6.8c4.56-.93 8-4.96 8-9.8z" />
                                    </svg>
                                </a>
                            @endif
                            @if($shop->instagram ?? false)
                                <a href="{{ $shop->instagram }}" target="_blank"
                                    class="text-white/35 hover:text-[#C8A951] transition-all duration-300 hover:scale-110 inline-flex"
                                    title="Instagram">
                                    <svg style="width:20px;height:20px" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.778 6.98 6.978 1.28.058 1.688.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

            </div>

            {{-- Bottom bar --}}
            <div
                class="mt-12 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-white/20 text-xs tracking-wide">
                    © {{ date('Y') }} {{ $shop->name ?? 'LiquorShop' }}. All rights reserved.
                </p>
                <p class="text-white/10 text-xs tracking-wide">Drink responsibly. 18+ only.</p>
            </div>

        </div>
    </footer>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>