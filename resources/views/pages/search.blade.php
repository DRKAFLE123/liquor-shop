<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search — {{ $shop->name ?? 'Liquor Shop' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: #000;
        }

        /* Background — pure CSS, zero network delay */
        .search-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(120, 80, 20, 0.18) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(180, 120, 30, 0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 60% 80%, rgba(80, 40, 10, 0.15) 0%, transparent 50%),
                linear-gradient(160deg, #0a0804 0%, #050300 50%, #0c0806 100%);
        }

        /* Subtle grain overlay for texture */
        .search-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.6;
        }

        /* Main content */
        .search-content {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Close button */
        .close-btn {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 20;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.2s;
            animation: fadeUp 0.4s ease both;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: scale(1.05);
        }

        .close-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Logo top-left */
        .page-logo {
            position: fixed;
            top: 1.5rem;
            left: 1.75rem;
            z-index: 20;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #c9a84c;
            text-decoration: none;
            animation: fadeUp 0.4s ease both;
        }

        .page-logo span {
            color: rgba(255, 255, 255, 0.85);
        }

        /* Title */
        .search-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 5vw, 3.75rem);
            font-weight: 300;
            color: #fff;
            letter-spacing: 0.04em;
            text-align: center;
            line-height: 1.15;
            margin-bottom: 0.5rem;
        }

        .search-title em {
            font-style: normal;
            color: #c9a84c;
        }

        /* Gold underline */
        .gold-rule {
            width: 48px;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
            margin: 1.25rem auto 2.5rem;
        }

        /* Search form wrapper */
        .search-form-wrap {
            width: 100%;
            max-width: 640px;
        }

        /* Input row */
        .search-input-row {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon-left {
            position: absolute;
            left: 1.25rem;
            color: #c9a84c;
            pointer-events: none;
            flex-shrink: 0;
        }

        .search-icon-left svg {
            width: 20px;
            height: 20px;
        }

        .search-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 4px;
            padding: 1.1rem 1.25rem 1.1rem 3.5rem;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 300;
            color: #fff;
            letter-spacing: 0.02em;
            outline: none;
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
            -webkit-appearance: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.28);
        }

        .search-input:focus {
            border-color: #c9a84c;
            background: rgba(255, 255, 255, 0.09);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.12), 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .search-btn {
            position: absolute;
            right: 0.5rem;
            background: #c9a84c;
            border: none;
            border-radius: 2px;
            padding: 0.6rem 1.25rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #000;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: #e0b94f;
            transform: translateY(-1px);
        }

        /* Hint text */
        .search-hint {
            text-align: center;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.2);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        /* Popular tags */
        .popular-label {
            text-align: center;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.2);
            margin-top: 2.5rem;
            margin-bottom: 0.9rem;
        }

        .tags-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .tag {
            display: inline-block;
            padding: 0.4rem 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.03);
        }

        .tag:hover {
            border-color: #c9a84c;
            color: #c9a84c;
            background: rgba(201, 168, 76, 0.06);
        }

        /* Decorative corner lines */
        .corner {
            position: fixed;
            width: 40px;
            height: 40px;
            z-index: 5;
            opacity: 0.2;
        }

        .corner-tl {
            top: 1.5rem;
            left: 1.5rem;
            border-top: 1px solid #c9a84c;
            border-left: 1px solid #c9a84c;
        }

        .corner-tr {
            top: 1.5rem;
            right: 1.5rem;
            border-top: 1px solid #c9a84c;
            border-right: 1px solid #c9a84c;
        }

        .corner-bl {
            bottom: 1.5rem;
            left: 1.5rem;
            border-bottom: 1px solid #c9a84c;
            border-left: 1px solid #c9a84c;
        }

        .corner-br {
            bottom: 1.5rem;
            right: 1.5rem;
            border-bottom: 1px solid #c9a84c;
            border-right: 1px solid #c9a84c;
        }
    </style>
</head>

<body>

    {{-- Blurred bg --}}
    <div class="search-bg"></div>
    <div class="search-overlay"></div>

    {{-- Decorative corners --}}
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    {{-- Logo --}}
    <a href="/" class="page-logo">LIQUOR<span>SHOP</span></a>

    {{-- Close button --}}
    <a href="{{ url()->previous() != url('/search') ? url()->previous() : '/' }}" class="close-btn" title="Close">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>

    {{-- Main content --}}
    <div class="search-content">

        <h1 class="search-title">Search Our <em>Collection</em></h1>
        <div class="gold-rule"></div>

        <div class="search-form-wrap">
            <form action="/catalogue" method="GET">
                <div class="search-input-row">
                    <span class="search-icon-left">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" id="searchInput" class="search-input"
                        placeholder="Search spirits, brands, categories..." value="{{ request('q') }}"
                        autocomplete="off" autofocus>
                    <button type="submit" class="search-btn">Search</button>
                </div>
            </form>

            <p class="search-hint">Press Enter to search our full collection</p>

            {{-- Dynamic tags: real categories + popular products from DB --}}
            @if(isset($categories) && $categories->count())
                <p class="popular-label">Browse by Category</p>
                <div class="tags-row">
                    @foreach($categories as $cat)
                        <a href="/catalogue?category={{ $cat->slug }}" class="tag">{{ $cat->name }}</a>
                    @endforeach
                </div>
            @endif

            @if(isset($popularProducts) && $popularProducts->count())
                <p class="popular-label" style="margin-top:1.5rem">Popular Products</p>
                <div class="tags-row">
                    @foreach($popularProducts as $product)
                        <a href="/catalogue?search={{ urlencode($product->name) }}" class="tag">{{ $product->name }}</a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <script>
        // Auto-fill tag into input on click, submit form
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function  (e) {
                // Let href navigate directly
            });
        });

        // Keyboard: Escape goes back
        document.addEventListener('keydown', functio n (e) {
            if (e.key === 'Escape') {
                window.history.back();
            }
        });

        // Focus input on load
        document.getElementById('searchInput').focus();
    </script>
</body>

</html>