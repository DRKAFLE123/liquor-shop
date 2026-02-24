<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Premium Liquor Shop') - {{ config('app.name') }}</title>
    {{-- DNS prefetch & preconnect for faster external resource resolution --}}
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    {{-- Fonts with display=swap to prevent render blocking --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
    {{--
    JSON-LD Structured Data — LiquorStore Schema
    Auto-generated from database values. NEVER stored manually in admin.
    This powers Google rich results and local SEO for "Liquor Store Granbury TX".
    --}}
    @if(isset($shop) && $shop)
        <script type="application/ld+json">
                                    {
                                        "@context": "https://schema.org",
                                        "@type": "LiquorStore",
                                        "name": "{{ $shop->store_name ?? config('app.name') }}",
                                        "image": "{{ $shop->logo ? asset('storage/' . $shop->logo) : '' }}",
                                        "url": "{{ url('/') }}",
                                        "telephone": "{{ $shop->phone }}",
                                        "email": "{{ $shop->email }}",
                                        "address": {
                                            "@type": "PostalAddress",
                                            "streetAddress": "{{ trim(($shop->address_line_1 ?? '') . ($shop->address_line_2 ? ', ' . $shop->address_line_2 : '')) }}",
                                            "addressLocality": "{{ $shop->city }}",
                                            "addressRegion": "{{ $shop->state }}",
                                            "postalCode": "{{ $shop->postal_code }}",
                                            "addressCountry": "{{ $shop->country ?? 'US' }}"
                                        },
                                        "geo": {
                                            "@type": "GeoCoordinates",
                                            "latitude": 32.4441,
                                            "longitude": -97.7937
                                        },
                                        "openingHours": "Mo-Sa 10:00-21:00",
                                        "priceRange": "$$",
                                        "servesCuisine": "Liquor Store",
                                        "areaServed": {
                                            "@type": "City",
                                            "name": "{{ $shop->city }}, {{ $shop->state }}"
                                        }
                                    }
                                    </script>
    @endif
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
    AGE VERIFICATION POPUP — 21+ (Texas / US compliance)
    Appears once per browser. Stored in localStorage.
    ============================================================ --}}
    <div x-data="{
            verified: localStorage.getItem('age_verified') === 'true',
            confirm() {
                localStorage.setItem('age_verified', 'true');
                this.verified = true;
            },
            deny() {
                window.location.href = 'https://www.google.com';
            }
        }" x-show="!verified" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-md"
        style="overscroll-behavior: contain;" @keydown.escape.prevent>

        {{-- Card --}}
        <div x-show="!verified" x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 scale-90 translate-y-8"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            class="relative mx-4 w-full max-w-md bg-gradient-to-b from-[#1a1a1a] to-[#111] border border-white/10 rounded-2xl shadow-2xl p-8 sm:p-10 text-center overflow-hidden">

            {{-- Gold accent line --}}
            <div
                class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#C8A951] to-transparent">
            </div>

            {{-- Logo or Store Name --}}
            <div class="mb-6">
                @if($shop->logo ?? false)
                    <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->store_name ?? 'Store Logo' }}"
                        class="h-16 mx-auto object-contain mb-3">
                @endif
                <h2 class="text-xl sm:text-2xl font-bold tracking-tighter text-liquor-gold">
                    {{ $shop->store_name ?? config('app.name') }}
                </h2>
            </div>

            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 rounded-full bg-[#C8A951]/10 flex items-center justify-center mb-5">
                <span class="text-3xl">🍷</span>
            </div>

            {{-- Heading --}}
            <h3 class="text-lg sm:text-xl font-bold text-white mb-2">Age Verification Required</h3>
            <p class="text-sm text-white/50 mb-8 leading-relaxed">
                You must be <span class="text-liquor-gold font-bold">21 years or older</span> to enter this site.<br>
                By clicking "Yes", you confirm that you are of legal drinking age.
            </p>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <button @click="confirm()"
                    class="flex-1 bg-[#C8A951] hover:bg-[#b8993d] text-black font-bold py-3.5 px-6 rounded-lg uppercase tracking-widest text-sm transition-all duration-300 hover:shadow-lg hover:shadow-[#C8A951]/20">
                    Yes, I'm 21+
                </button>
                <button @click="deny()"
                    class="flex-1 bg-transparent border border-white/20 hover:border-red-500/50 hover:text-red-400 text-white/50 font-bold py-3.5 px-6 rounded-lg uppercase tracking-widest text-sm transition-all duration-300">
                    No, I'm Not
                </button>
            </div>

            {{-- Legal --}}
            <p class="text-[10px] text-white/20 mt-6 leading-relaxed">
                This website contains information about alcoholic beverages. It is intended for an audience of legal
                drinking age.
                Please drink responsibly.
            </p>
        </div>
    </div>

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

                {{-- Logo/Name — mobile: one or the other, desktop: both if toggle on --}}
                <a href="/" class="flex items-center gap-3 group flex-shrink-0">
                    @if($shop->logo ?? false)
                        <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->store_name ?? 'Store Logo' }}"
                            class="h-10 sm:h-14 md:h-16 w-auto object-contain">
                    @endif
                    @if(!($shop->logo ?? false))
                        {{-- No logo: always show name on all screens --}}
                        <span class="text-lg sm:text-xl md:text-2xl font-bold tracking-tighter text-liquor-gold">
                            {{ $shop->store_name ?? 'LIQUOR SHOP' }}
                        </span>
                    @elseif($shop->show_name_in_navbar ?? true)
                        {{-- Logo exists + toggle on: show name only on md+ (hidden on mobile) --}}
                        <span class="hidden md:inline text-xl md:text-2xl font-bold tracking-tighter text-liquor-gold">
                            {{ $shop->store_name ?? 'LIQUOR SHOP' }}
                        </span>
                    @endif
                </a>

                {{-- Desktop nav links --}}
                <div class="hidden md:flex items-center gap-8 lg:gap-12">
                    {{-- Home --}}
                    <a href="/"
                        class="group relative py-2 px-1 text-sm font-bold uppercase tracking-[0.2em] {{ Request::is('/') ? 'text-liquor-gold' : 'text-white/75' }} hover:text-white transition-colors">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>

                    {{-- Catalogue — with hover dropdown --}}
                    <div class="relative" x-data="{ catOpen: false }" @mouseenter="catOpen = true"
                        @mouseleave="catOpen = false">
                        <a href="/catalogue"
                            class="group relative py-2 px-1 text-sm font-bold uppercase tracking-[0.2em] {{ Request::is('catalogue*') ? 'text-liquor-gold' : 'text-white/75' }} hover:text-white transition-colors flex items-center gap-1">
                            Catalogue
                            <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                :class="catOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                        </a>

                        {{-- Categories dropdown --}}
                        <div x-show="catOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute left-0 top-full mt-2 min-w-[220px] bg-black/95 border border-white/10 rounded-lg shadow-2xl backdrop-blur-sm py-2 z-50">

                            {{-- "All Products" link --}}
                            <a href="/catalogue"
                                class="block px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-liquor-gold hover:bg-white/5 transition-colors">
                                All Products
                            </a>
                            <div class="border-t border-white/5 my-1"></div>

                            {{-- Dynamic categories --}}
                            @if(isset($categories) && $categories->count())
                                @foreach($categories as $category)
                                    <a href="/catalogue?category={{ $category->slug }}"
                                        class="block px-5 py-2.5 text-sm text-white/70 hover:text-liquor-gold hover:bg-white/5 transition-colors">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            @else
                                <p class="px-5 py-2.5 text-xs text-white/30 italic">No categories yet</p>
                            @endif
                        </div>
                    </div>

                    {{-- About Us --}}
                    <a href="/about"
                        class="group relative py-2 px-1 text-sm font-bold uppercase tracking-[0.2em] {{ Request::is('about') ? 'text-liquor-gold' : 'text-white/75' }} hover:text-white transition-colors">
                        About Us
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>

                    {{-- Contact --}}
                    <a href="/contact"
                        class="group relative py-2 px-1 text-sm font-bold uppercase tracking-[0.2em] {{ Request::is('contact') ? 'text-liquor-gold' : 'text-white/75' }} hover:text-white transition-colors">
                        Contact
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                </div>

                {{-- Right-side icons --}}
                <div class="flex items-center gap-1 md:gap-10 flex-shrink-0">

                    {{-- Social dropdown — opens on hover --}}
                    <div class="relative" @mouseenter="socialOpen = true" @mouseleave="socialOpen = false">
                        <button :class="socialOpen ? 'text-liquor-gold' : 'text-white/80'"
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
                            class="absolute right-0 top-9 flex items-center gap-5 py-2 px-3 bg-black/90 border border-white/10 rounded-lg shadow-xl backdrop-blur-sm">
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

                {{-- Logo/Header — stacked: logo on top, name below --}}
                <div class="mb-12 flex flex-col items-start gap-2">
                    @if($shop->logo ?? false)
                        <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->store_name ?? 'Store Logo' }}"
                            class="h-12 w-auto object-contain">
                    @endif
                    @if((!($shop->logo ?? false)) || ($shop->show_name_in_navbar ?? true))
                        <div class="text-lg font-bold tracking-tighter text-liquor-gold">
                            {{ $shop->store_name ?? 'LIQUOR SHOP' }}
                        </div>
                    @endif
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

                {{-- Brand & Structured Address --}}
                <div>
                    @if($shop->logo ?? false)
                        <a href="/" class="inline-block mb-3">
                            <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->store_name ?? 'Store Logo' }}"
                                class="h-12 w-auto object-contain">
                        </a>
                    @endif
                    <div class="text-xl font-bold tracking-tighter text-liquor-gold mb-1 leading-tight">
                        {{ $shop->store_name ?? 'LIQUOR SHOP' }}
                    </div>
                    <p class="text-white/30 text-xs mb-5 leading-relaxed max-w-xs">
                        {{ $shop->tagline ?? 'Premium spirits, curated for the discerning palate.' }}
                    </p>
                    {{-- Structured address block — mirrors JSON-LD schema --}}
                    <address class="not-italic space-y-0.5">
                        @if($shop->address_line_1 ?? false)
                            <p class="text-white/45 text-sm">{{ $shop->address_line_1 }}</p>
                        @endif
                        @if($shop->address_line_2 ?? false)
                            <p class="text-white/45 text-sm">{{ $shop->address_line_2 }}</p>
                        @endif
                        @if($shop->city ?? false)
                            <p class="text-white/45 text-sm">{{ $shop->cityStateLine() }}</p>
                        @endif
                        @if(($shop->country ?? 'US') === 'US')
                            <p class="text-white/30 text-xs">United States</p>
                        @else
                            <p class="text-white/30 text-xs">{{ $shop->country }}</p>
                        @endif
                    </address>
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

                    {{-- Contact info — all links are clickable --}}
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
                                <a href="{{ $shop->phoneHref() }}"
                                    class="text-white/45 hover:text-liquor-gold text-sm transition-colors">{{ $shop->phone }}</a>
                            </li>
                        @endif
                        @if($shop->secondary_phone ?? false)
                            <li class="flex items-center group">
                                <span
                                    class="w-5 h-5 flex items-center justify-start mr-3 text-liquor-gold group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </span>
                                <a href="tel:+1{{ preg_replace('/[^0-9]/', '', $shop->secondary_phone) }}"
                                    class="text-white/45 hover:text-liquor-gold text-sm transition-colors">{{ $shop->secondary_phone }}</a>
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
                                <a href="mailto:{{ $shop->email }}"
                                    class="text-white/45 hover:text-liquor-gold text-sm break-all transition-colors">{{ $shop->email }}</a>
                            </li>
                        @endif
                    </ul>

                    {{-- Social icons row — WhatsApp auto-formatted via model helper --}}
                    @if(($shop->whatsapp ?? false) || ($shop->facebook ?? false) || ($shop->instagram ?? false) || ($shop->google_business ?? false))
                        <div class="flex items-center gap-6 pt-6 mt-2 border-t border-white/5">
                            @if($shop->whatsapp ?? false)
                                <a href="{{ $shop->whatsappUrl() }}" target="_blank"
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
                    © {{ date('Y') }} {{ $shop->store_name ?? config('app.name') }}. All rights reserved.
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-3 text-right">
                    <p class="text-white/10 text-xs">Must be 21+ to purchase alcohol. Drink responsibly.</p>
                    @if($shop->license_number ?? false)
                        <p class="text-white/10 text-xs">TABC License: {{ $shop->license_number }}</p>
                    @endif
                </div>
            </div>

        </div>
    </footer>

    @stack('scripts')
    {{-- Swiper JS deferred to end of body --}}
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- Instant.page: preloads links on hover, making navigation feel instant --}}
    <script src="//instant.page/5.2.0" type="module"></script>
</body>

</html>