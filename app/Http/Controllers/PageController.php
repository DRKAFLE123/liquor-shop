<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with('category')->where('is_featured', true)->take(4)->get();
        $categories = Category::all();
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();
        $heritage = \App\Models\Heritage::first();
        return view('welcome', compact('featuredProducts', 'categories', 'banners', 'heritage'));
    }

    public function search()
    {
        $categories = Category::all();
        $popularProducts = Product::where('is_featured', true)->take(8)->get();
        if ($popularProducts->isEmpty()) {
            $popularProducts = Product::latest()->take(8)->get();
        }
        return view('pages.search', compact('categories', 'popularProducts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSend(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // In a real app, send mail here
        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
