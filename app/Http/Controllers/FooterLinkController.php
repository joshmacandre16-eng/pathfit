<?php

namespace App\Http\Controllers;

use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function index()
    {
        $footerLinks = FooterLink::orderBy('column')->orderBy('order')->get();
        return view('admin.footer-links.index', compact('footerLinks'));
    }

    public function create()
    {
        return view('admin.footer-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:footer_links,slug',
            'column' => 'required|string|in:product,company,resources,legal',
            'order' => 'nullable|integer|min:0',
            'content' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        FooterLink::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'column' => $request->column,
            'order' => $request->order ?? 0,
            'content' => $request->content,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link created successfully!');
    }

    public function edit(FooterLink $footerLink)
    {
        return view('admin.footer-links.edit', compact('footerLink'));
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:footer_links,slug,' . $footerLink->id,
            'column' => 'required|string|in:product,company,resources,legal',
            'order' => 'nullable|integer|min:0',
            'content' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $footerLink->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'column' => $request->column,
            'order' => $request->order ?? 0,
            'content' => $request->content,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link updated successfully!');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();
        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link deleted successfully!');
    }

    public function show($slug)
    {
        try {
            $footerLink = FooterLink::where('slug', $slug)->firstOrFail();
            return view('footer.show', compact('footerLink'));
        } catch (\Exception $e) {
            // If not found or DB error, redirect to home
            return redirect('/');
        }
    }
}

