@extends('layouts.app')

@section('title', 'Welcome to the Finest Liquor Shop')

@section('content')
    <!-- Hero Slider Section -->
    @if($banners->count() > 0)
        <section class="relative w-full overflow-hidden" style="height: 100vh; min-height: 750px;">
            <div class="swiper heroSwiper" style="height: 100%;">
                <div class="swiper-wrapper" style="height: 100%;">
                    @foreach($banners as $banner)
                        <div class="swiper-slide relative w-full flex items-center" style="height: 100%;">
                            @if($banner->type === 'video')
                                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                                    <video autoplay muted loop playsinline class="w-full h-full object-cover">
                                        <source src="{{ asset('storage/' . $banner->image) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="absolute inset-0 bg-black/50"></div>
                                </div>
                            @else
                                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                                    <div class="absolute inset-0 bg-black/60"></div>
                                </div>
                            @endif

                            <div class="container mx-auto px-6 relative z-10 pt-48 md:pt-64 pb-32">
                                <div class="max-w-4xl">
                                    <h2 class="text-liquor-gold font-bold uppercase tracking-[0.5em] text-sm md:text-base mb-6 animate-fade-in-up">
                                        {{ $banner->subtitle ?? 'Premium Collection' }}
                                    </h2>
                                    <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-bold text-white mb-8 md:mb-12 leading-[1.1] md:leading-[1] tracking-tighter drop-shadow-2xl">
                                        {!! $banner->title ?? 'THE ART OF <br class="hidden sm:block"> <span class="text-liquor-gold">FINE DRINKING</span>' !!}
                                    </h1>
                                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 items-center mt-4 animate-fade-in-up" style="animation-delay: 0.4s">
                                        <!-- Primary CTA -->
                                        <a href="{{ $banner->button_link ?? '/catalogue' }}" 
                                            class="group relative overflow-hidden inline-flex items-center justify-center bg-liquor-gold text-black font-bold py-4 px-10 uppercase tracking-[0.2em] text-xs transition-all duration-500 shadow-lg shadow-liquor-gold/20 hover:shadow-liquor-gold/40 text-center">
                                            <span class="relative z-10">{{ $banner->button_text ?? 'Catalogue' }}</span>
                                            <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                                        </a>
                                        <!-- Secondary CTA -->
                                        <a href="/contact" 
                                            class="inline-flex items-center justify-center border-2 border-white/50 text-white font-bold py-4 px-10 uppercase tracking-[0.2em] text-xs hover:border-liquor-gold hover:bg-liquor-gold hover:text-black transition-all duration-500 text-center">
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Navigation Click Zones (Invisible) -->
                @if($banners->count() > 1)
                    <div class="absolute inset-y-0 left-0 w-1/6 z-30 cursor-pointer swiper-prev-zone" title="Previous"></div>
                    <div class="absolute inset-y-0 right-0 w-1/6 z-30 cursor-pointer swiper-next-zone" title="Next"></div>
                    <div class="swiper-pagination !bottom-12"></div>
                @endif
            </div>
        </section>
    @else
        <section class="relative h-screen flex items-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
                <div class="absolute inset-0 bg-black/60"></div>
            </div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-2xl">
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tighter">
                        THE ART OF <br>
                        <span class="text-liquor-gold">FINE DRINKING</span>
                    </h1>
                    <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                        Explore our curated collection of premium spirits, world-class wines, and refreshing craft beers. Delivered to your doorstep.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                        <a href="/catalogue" class="bg-liquor-gold text-black font-bold py-4 px-10 text-center uppercase tracking-widest hover:scale-105 transition-transform">
                            Explore Catalogue
                        </a>
                        <a href="/contact" class="border border-white/30 text-white font-bold py-4 px-10 text-center uppercase tracking-widest hover:bg-white/10 transition-all">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Categories Showcase -->
    <section class="py-24 bg-liquor-dark">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">Discover</h2>
                <h3 class="text-4xl font-bold">SHOP BY CATEGORY</h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <a href="/catalogue?category={{ $category->slug }}" class="group relative aspect-square overflow-hidden bg-black/40 border border-white/5 flex flex-col items-center justify-center p-8 hover:border-liquor-gold/50 transition-all">
                        <div class="w-full h-full absolute inset-0 group-hover:scale-110 transition-transform">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover opacity-40">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-3xl">
                                    @if($category->slug == 'whisky') 🥃
                                    @elseif($category->slug == 'beer') 🍺
                                    @elseif($category->slug == 'wine') 🍷
                                    @elseif($category->slug == 'vodka') 🍸
                                    @else 🍾 @endif
                                </div>
                            @endif
                        </div>
                        <span class="text-lg font-bold group-hover:text-liquor-gold transition-colors uppercase tracking-widest">{{ $category->name }}</span>
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-liquor-gold transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-24 bg-black">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">Premium Selection</h2>
                    <h3 class="text-4xl font-bold">FEATURED BOTTLES</h3>
                </div>
                <a href="/catalogue" class="text-liquor-gold font-bold uppercase tracking-widest border-b border-liquor-gold/30 hover:border-liquor-gold transition-all pb-1">
                    View Entire List
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
                @foreach($featuredProducts as $product)
                    <div class="group">
                        <div class="relative aspect-[3/4] bg-liquor-dark mb-6 overflow-hidden border border-white/5 group-hover:border-liquor-gold/30 transition-all">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                @else
                                    <span class="text-6xl group-hover:scale-110 transition-transform">
                                         @if($product->category->slug == 'whisky') 🥃
                                         @elseif($product->category->slug == 'beer') 🍺
                                         @elseif($product->category->slug == 'wine') 🍷
                                         @else 🍸 @endif
                                    </span>
                                @endif
                            </div>
                            <div class="absolute top-4 left-4 bg-liquor-gold text-black text-[10px] font-bold px-2 py-1 uppercase tracking-tighter">
                                Featured
                            </div>
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="/product/{{ $product->slug }}" class="bg-white text-black text-xs font-bold py-3 px-6 uppercase tracking-widest hover:bg-liquor-gold transition-colors">
                                    Quick View
                                </a>
                            </div>
                        </div>
                        <h4 class="text-sm text-gray-400 uppercase tracking-widest mb-1">{{ $product->brand }}</h4>
                        <h5 class="text-xl font-bold mb-2 group-hover:text-liquor-gold transition-colors">{{ $product->name }}</h5>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">{{ $product->bottle_size }}</span>
                            <span class="text-liquor-gold font-bold">Rs. {{ number_format($product->price) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-24 bg-liquor-dark">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="aspect-square bg-gray-900 overflow-hidden">
                    <img src="{{ $heritage && $heritage->image ? asset('storage/' . $heritage->image) : 'https://images.unsplash.com/photo-1563191799-2c7e8c185bb3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80' }}" 
                     alt="Liquor Store" loading="lazy" decoding="async" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-8 -right-8 bg-liquor-gold p-8 hidden md:block">
                    <p class="text-4xl font-bold text-black tracking-tighter">{{ $heritage->experience_years ?? '25+' }}</p>
                    <p class="text-black text-xs font-bold uppercase tracking-widest">{{ $heritage->experience_text ?? 'Years of Trust' }}</p>
                </div>
            </div>
            <div>
                <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">{{ $heritage->subtitle ?? 'Established 1995' }}</h2>
                <h3 class="text-4xl font-bold mb-8 leading-tight">{!! $heritage->title ?? 'THE MOST TRUSTED NAME <br> IN PREMIUM SPIRITS.' !!}</h3>
                <p class="text-gray-400 mb-8 leading-relaxed">
                    {{ $heritage->description ?? "Our legacy is built on a simple promise: to bring you the world's most exceptional liquors and brews, selected for their authenticity, quality, and heritage. Whether you're a connoisseur or just beginning your journey, we're here to guide you." }}
                </p>
                <a href="{{ $heritage->button_link ?? '/about' }}" class="inline-block text-white font-bold uppercase tracking-widest border-b-2 border-liquor-gold pb-2 hover:text-liquor-gold transition-colors">
                    {{ $heritage->button_text ?? 'Our Heritage' }}
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-black relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-8">LOOKING FOR SOMETHING <span class="text-liquor-gold">SPECIFIC?</span></h2>
            <p class="text-gray-400 mb-12 max-w-2xl mx-auto">
                Our inventory is updated daily. If you can't find what you're looking for, reach out to us and we'll source it for you.
            </p>
            <a href="/contact" class="bg-white text-black font-bold py-4 px-12 inline-block uppercase tracking-widest hover:bg-liquor-gold transition-colors">
                Contact Our Sommelier
            </a>
        </div>
        <!-- Background decorative element -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[20rem] font-black text-white/[0.02] pointer-events-none select-none">
            DRINK
        </div>
    </section>
@push('styles')
<style>
    .heroSwiper {
        --swiper-navigation-color: #D4AF37;
        --swiper-pagination-color: #D4AF37;
    }
    .swiper-pagination-bullet {
        background: #fff !important;
        opacity: 0.3;
        width: 10px !important;
        height: 10px !important;
        margin: 0 8px !important;
        transition: all 0.3s ease;
    }
    .swiper-pagination-bullet-active {
        background: #D4AF37 !important;
        opacity: 1;
        transform: scale(1.4);
    }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            effect: 'fade',
            speed: 1000,
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-next-zone',
                prevEl: '.swiper-prev-zone',
            },
        });
    });
</script>
@endpush