@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="py-16 md:py-24 bg-black">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-xs font-bold text-liquor-gold tracking-[0.3em] uppercase mb-4">Get in touch</h2>
                    <h3 class="text-4xl font-bold mb-8 tracking-tighter">CONTACT OUR STORE</h3>

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

                <!-- Contact Info & Map -->
                <div>
                    <div class="mb-12">
                        <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-sm">Store Information</h4>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <span class="text-liquor-gold mr-4">📍</span>
                                <div>
                                    <p class="font-bold mb-1">VISIT US</p>
                                    <p class="text-gray-400 text-sm">{!! nl2br(e($shop->address ?? 'Nepal')) !!}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <span class="text-liquor-gold mr-4">📞</span>
                                <div>
                                    <p class="font-bold mb-1">CALL US</p>
                                    <p class="text-gray-400 text-sm">{{ $shop->phone ?? 'Contact us' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <span class="text-liquor-gold mr-4">✉️</span>
                                <div>
                                    <p class="font-bold mb-1">EMAIL US</p>
                                    <p class="text-gray-400 text-sm">{{ $shop->email ?? 'info@site.com' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map (Iframe placeholder) -->
                    <div class="aspect-video bg-liquor-dark border border-white/5 relative overflow-hidden">
                        @if($shop->map_link ?? false)
                            {!! $shop->map_link !!}
                        @else
                            <iframe
                                class="absolute inset-0 w-full h-full grayscale invert opacity-40 hover:opacity-100 transition-opacity"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14127.42621453965!2d85.333333!3d27.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDQyJzAwLjAiTiA4NcKwMjAnMDAuMCJF!5e0!3m2!1sen!2snp!4v1620000000000!5m2!1sen!2snp"
                                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection