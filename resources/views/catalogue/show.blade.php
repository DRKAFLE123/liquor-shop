@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="bg-black py-16">
        <div class="container mx-auto px-6">
            <nav class="flex mb-8 text-xs font-bold uppercase tracking-widest" aria-label="Breadcrumb">
                <a href="/" class="text-gray-500 hover:text-white">Home</a>
                <span class="mx-2 text-gray-700">/</span>
                <a href="/catalogue" class="text-gray-500 hover:text-white">Catalogue</a>
                <span class="mx-2 text-gray-700">/</span>
                <span class="text-liquor-gold">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
                <!-- Product Image -->
                <div
                    class="bg-liquor-dark aspect-square flex items-center justify-center border border-white/5 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <span class="text-[12rem]">
                            @if($product->category->slug == 'whisky') 🥃
                            @elseif($product->category->slug == 'beer') 🍺
                            @elseif($product->category->slug == 'wine') 🍷
                            @else 🍸 @endif
                        </span>
                    @endif
                </div>

                <!-- Product Content -->
                <div class="py-4">
                    <h2 class="text-liquor-gold font-bold uppercase tracking-widest mb-2 text-sm">{{ $product->brand }}</h2>
                    <h1 class="text-5xl font-bold mb-6 tracking-tighter">{{ $product->name }}</h1>

                    <div class="flex items-center space-x-6 mb-8 pb-8 border-b border-white/10">
                        <div class="text-3xl font-bold text-white">
                            Rs. {{ number_format($product->price) }}
                        </div>
                        <div
                            class="px-3 py-1 bg-white/5 border border-white/10 text-gray-400 text-xs font-bold uppercase tracking-widest">
                            {{ $product->bottle_size }}
                        </div>
                    </div>

                    <div class="prose prose-invert mb-10">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Description</h3>
                        <p class="text-gray-400 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <a href="https://wa.me/yournumber?text=Hi, I am interested in {{ $product->name }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-10 text-center uppercase tracking-widest transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Enquire on WhatsApp
                        </a>
                        <a href="/contact"
                            class="border border-white/20 text-white font-bold py-4 px-10 text-center uppercase tracking-widest hover:bg-white/5 transition-all">
                            Send Message
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-32">
                <div class="text-center mb-16">
                    <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">You may also like</h2>
                    <h3 class="text-3xl font-bold">RELATED PRODUCTS</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $rel)
                        <div class="group">
                            <a href="/product/{{ $rel->slug }}">
                                <div
                                    class="relative aspect-square bg-liquor-dark mb-4 overflow-hidden border border-white/5 group-hover:border-liquor-gold/30 transition-all">
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black/20 text-4xl group-hover:scale-110 transition-transform">
                                        @if($rel->image)
                                            <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            @if($rel->category->slug == 'whisky') 🥃
                                            @elseif($rel->category->slug == 'beer') 🍺
                                            @elseif($rel->category->slug == 'wine') 🍷
                                            @else 🍸 @endif
                                        @endif
                                    </div>
                                </div>
                                <h4 class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">{{ $rel->brand }}</h4>
                                <h5 class="text-sm font-bold truncate group-hover:text-liquor-gold transition-colors">
                                    {{ $rel->name }}
                                </h5>
                                <div class="text-liquor-gold font-bold mt-1">Rs. {{ number_format($rel->price) }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection