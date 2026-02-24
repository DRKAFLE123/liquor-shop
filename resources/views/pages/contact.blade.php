@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="py-16 md:py-24 bg-black">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">

                {{-- ── Contact Form ─────────────────────────────────────── --}}
                <div>
                    <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">Get in touch</h2>
                    <h1 class="text-4xl font-bold mb-8 tracking-tighter">CONTACT OUR STORE</h1>

                    @if(session('success'))
                        <div
                            class="bg-green-600/20 border border-green-500 text-green-500 p-4 mb-8 text-sm font-bold uppercase tracking-widest">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Your
                                    Name</label>
                                <input type="text" name="name" required
                                    class="w-full bg-liquor-dark border border-white/10 px-4 py-3 text-white focus:border-liquor-gold outline-none transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email
                                    Address</label>
                                <input type="email" name="email" required
                                    class="w-full bg-liquor-dark border border-white/10 px-4 py-3 text-white focus:border-liquor-gold outline-none transition-colors">
                            </div>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Subject</label>
                            <input type="text" name="subject"
                                class="w-full bg-liquor-dark border border-white/10 px-4 py-3 text-white focus:border-liquor-gold outline-none transition-colors">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Message</label>
                            <textarea name="message" rows="6" required
                                class="w-full bg-liquor-dark border border-white/10 px-4 py-4 text-white focus:border-liquor-gold outline-none transition-colors"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-liquor-gold text-black font-bold py-4 uppercase tracking-widest hover:bg-liquor-amber transition-all">
                            Send Message
                        </button>
                    </form>
                </div>

                {{-- ── Store Info & Map ──────────────────────────────────── --}}
                <div class="space-y-10">

                    {{-- Structured Address --}}
                    <div>
                        <h4
                            class="text-white font-bold mb-6 uppercase tracking-widest text-sm border-b border-white/10 pb-3">
                            Store Information</h4>
                        <div class="space-y-6">

                            {{-- Address --}}
                            @if($shop->address_line_1 ?? false)
                                <div class="flex items-start gap-4">
                                    <span class="text-liquor-gold mt-0.5 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <address class="not-italic">
                                        <p class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-2">Visit
                                            Us</p>
                                        <p class="text-white font-semibold text-sm">{{ $shop->store_name }}</p>
                                        <p class="text-gray-400 text-sm">{{ $shop->address_line_1 }}</p>
                                        @if($shop->address_line_2)
                                            <p class="text-gray-400 text-sm">{{ $shop->address_line_2 }}</p>
                                        @endif
                                        <p class="text-gray-400 text-sm">{{ $shop->cityStateLine() }}</p>
                                        <p class="text-gray-500 text-xs mt-0.5">United States</p>
                                    </address>
                                </div>
                            @endif

                            {{-- Phone --}}
                            @if($shop->phone ?? false)
                                <div class="flex items-start gap-4">
                                    <span class="text-liquor-gold flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-1">Call Us
                                        </p>
                                        <a href="{{ $shop->phoneHref() }}"
                                            class="text-gray-400 text-sm hover:text-white transition-colors">{{ $shop->phone }}</a>
                                        @if($shop->secondary_phone)
                                            <br>
                                            <a href="tel:+1{{ preg_replace('/[^0-9]/', '', $shop->secondary_phone) }}"
                                                class="text-gray-400 text-sm hover:text-white transition-colors">{{ $shop->secondary_phone }}</a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Email --}}
                            @if($shop->email ?? false)
                                <div class="flex items-start gap-4">
                                    <span class="text-liquor-gold flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-1">Email
                                            Us</p>
                                        <a href="mailto:{{ $shop->email }}"
                                            class="text-gray-400 text-sm hover:text-white transition-colors break-all">{{ $shop->email }}</a>
                                    </div>
                                </div>
                            @endif

                            {{-- WhatsApp --}}
                            @if($shop->whatsapp ?? false)
                                <div class="flex items-start gap-4">
                                    <span class="text-liquor-gold flex-shrink-0">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-1">
                                            WhatsApp</p>
                                        <a href="{{ $shop->whatsappUrl() }}" target="_blank"
                                            class="text-gray-400 text-sm hover:text-white transition-colors">{{ $shop->whatsapp }}</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- Business Hours --}}
                    @if($shop->business_hours ?? false)
                        <div class="bg-white/5 border border-white/10 p-6">
                            <h4 class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-4">Business Hours
                            </h4>
                            <div class="space-y-1">
                                @foreach(explode("\n", $shop->business_hours) as $line)
                                    @if(trim($line))
                                        <p class="text-gray-400 text-sm">{{ trim($line) }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Google Map Embed (rendered safely) --}}
                    @if($shop->google_map_embed ?? false)
                        <div>
                            <h4 class="text-[10px] font-bold text-liquor-gold uppercase tracking-widest mb-4">Find Us</h4>
                            <div class="aspect-video bg-liquor-dark border border-white/5 relative overflow-hidden">
                                {{--
                                SECURITY: google_map_embed only allows <iframe> tags from the admin.
                                    For extra hardening, consider using HTMLPurifier to strip all but iframe.
                                    --}}
                                    {!! $shop->google_map_embed !!}
                            </div>
                            {{-- Fallback map style for embedded iframe --}}
                            <style>
                                .contact-map-section iframe {
                                    width: 100%;
                                    height: 100%;
                                    position: absolute;
                                    inset: 0;
                                    filter: grayscale(30%) contrast(1.05);
                                    border: 0;
                                }
                            </style>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection