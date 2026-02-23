@extends('layouts.app')

@section('title', $about->hero_subtitle ?? 'About Our Heritage')

@section('content')
    <!-- About Hero -->
    <section class="relative py-32 bg-black overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-xs font-bold text-liquor-gold tracking-[0.4em] uppercase mb-6">
                {{ $about->hero_subtitle ?? 'Our Story' }}
            </h2>
            <h1 class="text-4xl md:text-7xl font-bold text-white mb-8 tracking-tighter">
                {!! nl2br(e($about->hero_title ?? 'CRAFTING TASTE SINCE 1995')) !!}
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                {{ $about->hero_intro ?? 'From a small boutique store to Kathmandu\'s most trusted destination for premium spirits.' }}
            </p>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-liquor-gold/5 blur-[120px]"></div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 md:py-24 bg-liquor-dark">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 items-center">
            <div>
                @if($about->image_path ?? false)
                    <img src="{{ asset('storage/' . $about->image_path) }}"
                        alt="About Us" class="border border-white/5 shadow-2xl w-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                        alt="Vintage Wine Cellar" class="border border-white/5 shadow-2xl">
                @endif
            </div>
            <div>
                <h3 class="text-3xl font-bold mb-8">{{ $about->vision_heading ?? 'OUR VISION' }}</h3>
                <p class="text-gray-400 mb-8 leading-relaxed">
                    {{ $about->vision_text ?? 'We believe that every bottle tells a story—of the earth it came from, the hands that crafted it, and the moments it celebrates. Our vision is to be the bridge between global heritage and local connoisseurs.' }}
                </p>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-liquor-gold font-bold mb-2">{{ $about->value1_title ?? 'Authenticity' }}</h4>
                        <p class="text-xs text-gray-500">{{ $about->value1_text ?? 'Every bottle in our shop is 100% authentic and ethically sourced.' }}</p>
                    </div>
                    <div>
                        <h4 class="text-liquor-gold font-bold mb-2">{{ $about->value2_title ?? 'Expertise' }}</h4>
                        <p class="text-xs text-gray-500">{{ $about->value2_text ?? 'Our staff are trained to help you find the perfect match for any occasion.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compliance Section -->
    <section class="py-24 bg-black">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-3xl font-bold mb-12 uppercase tracking-tighter">
                    {{ $about->compliance_heading ?? 'LICENSED & REGULATED' }}
                </h3>
                <div class="bg-liquor-dark p-12 border border-liquor-gold/10">
                    <p class="text-gray-400 italic mb-8">
                        "{{ $about->compliance_quote ?? 'We operate with the highest standards of integrity and comply with all local liquor licensing regulations. We are committed to promoting responsible drinking across Nepal.' }}"
                    </p>
                    <div class="flex justify-center space-x-12 grayscale opacity-50">
                        @if($about->cert1 ?? false)
                            <span class="text-xs font-bold uppercase tracking-widest">{{ $about->cert1 }}</span>
                        @endif
                        @if($about->cert2 ?? false)
                            <span class="text-xs font-bold uppercase tracking-widest">{{ $about->cert2 }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection