<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\StoreSetting;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // 1. Save to database
        Contact::create($validated);

        // 2. Send email notification to the store
        try {
            $recipientEmail = StoreSetting::first()?->email ?? config('mail.from.address');

            Mail::to($recipientEmail)->send(new ContactFormMail(
                senderName: $validated['name'],
                senderEmail: $validated['email'],
                contactSubject: $validated['subject'] ?? null,
                senderMessage: $validated['message'],
            ));
        } catch (\Exception $e) {
            // Log the error but don't block the user — their message is already saved
            Log::error('Contact form email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you for your message! We\'ll get back to you shortly.');
    }
}

