@extends('layouts.app')

@section('title', 'Product Catalogue')

@section('content')
    <section class="pt-40 pb-20 bg-black min-h-screen" style="padding-top: 6rem;">
        <div class="mx-auto px-6 sm:px-10 lg:px-16 max-w-screen-xl">

            {{-- Page Header --}}
            <div class="mb-10">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-liquor-gold mb-2">Premium Collection</p>
                <h1 class="text-4xl sm:text-5xl font-bold text-white uppercase tracking-tighter leading-none mb-3">Our
                    Selection</h1>
                <div class="w-16 h-0.5 bg-liquor-gold mb-4"></div>
                <p class="text-gray-400 text-sm">Discover a world of premium spirits and fine wines.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-10">

                {{-- Sidebar Filters --}}
                <aside class="w-full lg:w-64 flex-shrink-0">
                    <div class="bg-white/5 border border-white/10 p-6 sticky top-28">
                        <form action="{{ route('catalogue.index') }}" method="GET">

                            <div class="mb-8">
                                <h3 class="text-[10px] font-bold text-liquor-gold uppercase tracking-[0.3em] mb-3">Search
                                </h3>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search products..."
                                    class="w-full bg-black border border-white/10 px-4 py-2.5 text-white text-sm placeholder-white/30 focus:border-liquor-gold outline-none transition-colors">
                            </div>

                            <div>
                                <h3 class="text-[10px] font-bold text-liquor-gold uppercase tracking-[0.3em] mb-3">
                                    Categories</h3>
                                <div class="flex flex-col space-y-2.5">
                                    <a href="{{ route('catalogue.index') }}"
                                        class="text-sm font-semibold uppercase tracking-widest transition-colors {{ !request('category') ? 'text-liquor-gold' : 'text-white/50 hover:text-white' }}">
                                        All Categories
                                    </a>
                                    @foreach($categories as $category)
                                        <a href="{{ route('catalogue.index', ['category' => $category->slug]) }}"
                                            class="text-sm font-semibold uppercase tracking-widest transition-colors {{ request('category') == $category->slug ? 'text-liquor-gold' : 'text-white/50 hover:text-white' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="hidden">Filter</button>
                        </form>
                    </div>
                </aside>

                {{-- Product Grid --}}
                <div class="flex-1">
                    @if($products->isEmpty())
                        <div class="text-center py-24 bg-white/5 border border-white/10">
                            <p class="text-gray-400 mb-4">No products found matching your criteria.</p>
                            <a href="{{ route('catalogue.index') }}"
                                class="text-xs font-bold uppercase tracking-widest text-liquor-gold hover:text-white transition-colors">
                                Clear Filters
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-5 sm:gap-8">
                            @foreach($products as $product)
                                <div class="group">
                                    <div
                                        class="relative aspect-[3/4] bg-white/5 mb-4 overflow-hidden border border-white/5 group-hover:border-liquor-gold/40 transition-all duration-300">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                    loading="lazy" decoding="async"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <span class="text-5xl group-hover:scale-110 transition-transform duration-300">
                                                    @if($product->category->slug == 'whisky') 🥃
                                                    @elseif($product->category->slug == 'beer') 🍺
                                                    @elseif($product->category->slug == 'wine') 🍷
                                                    @else 🍸 @endif
                                                </span>
                                            @endif
                                        </div>
                                        {{-- Hover overlay --}}
                                        <div
                                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <a href="{{ route('catalogue.show', $product->slug) }}"
                                                class="bg-liquor-gold text-black text-[10px] font-bold py-2.5 px-5 uppercase tracking-widest hover:bg-white transition-colors">
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-1">{{ $product->brand }}</p>
                                    <h5 class="text-sm font-bold mb-1 group-hover:text-liquor-gold transition-colors leading-snug">
                                        {{ $product->name }}
                                    </h5>
                                    <div class="flex justify-between items-center mt-2 pt-2 border-t border-white/10">
                                        <span class="text-gray-500 text-xs">{{ $product->bottle_size }}</span>
                                        <span class="text-liquor-gold font-bold text-sm">Rs.
                                            {{ number_format($product->price) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection