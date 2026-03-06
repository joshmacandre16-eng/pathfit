<?php

namespace App\Http\Controllers;

use App\Models\WelcomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeContentController extends Controller
{
    /**
     * Display a listing of all welcome content sections.
     */
    public function index()
    {
        $contents = WelcomeContent::orderBy('section')
            ->orderBy('order')
            ->get()
            ->groupBy('section');

        return view('admin.welcome-content.index', compact('contents'));
    }

    /**
     * Show the form for editing the specified content.
     */
    public function edit($section)
    {
        $contents = WelcomeContent::where('section', $section)
            ->orderBy('order')
            ->get()
            ->keyBy('key');

        return view('admin.welcome-content.edit', compact('section', 'contents'));
    }

    /**
     * Update the specified content in storage.
     */
    public function update(Request $request, $section)
    {
        $request->validate([
            'contents' => 'required|array',
        ]);

        foreach ($request->contents as $key => $data) {
            $content = WelcomeContent::where('section', $section)
                ->where('key', $key)
                ->first();

            if ($content) {
                // Handle image upload
                if ($request->hasFile("contents.{$key}.image")) {
                    $image = $request->file("contents.{$key}.image");
                    $path = $image->store('welcome-content', 'public');
                    
                    // Delete old image if exists
                    if ($content->value && Storage::disk('public')->exists($content->value)) {
                        Storage::disk('public')->delete($content->value);
                    }
                    
                    $content->update(['value' => $path]);
                } elseif (isset($data['value'])) {
                    $content->update(['value' => $data['value']]);
                }

                // Update content field (for longer text)
                if (isset($data['content'])) {
                    $content->update(['content' => $data['content']]);
                }
            }
        }

        return redirect()->route('admin.welcome-content.index')
            ->with('success', ucfirst(str_replace('-', ' ', $section)) . ' content updated successfully!');
    }

    /**
     * Store new content item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'key' => 'required|string',
            'value' => 'nullable|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Check if already exists
        $exists = WelcomeContent::where('section', $request->section)
            ->where('key', $request->key)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Content with this key already exists in the section.');
        }

        WelcomeContent::create([
            'section' => $request->section,
            'key' => $request->key,
            'value' => $request->value,
            'content' => $request->content,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.welcome-content.index')
            ->with('success', 'Content added successfully!');
    }

    /**
     * Remove the specified content from storage.
     */
    public function destroy($id)
    {
        $content = WelcomeContent::findOrFail($id);

        // Delete associated image if exists
        if ($content->value && Storage::disk('public')->exists($content->value)) {
            Storage::disk('public')->delete($content->value);
        }

        $content->delete();

        return redirect()->route('admin.welcome-content.index')
            ->with('success', 'Content deleted successfully!');
    }

    /**
     * Get available sections with their content for the welcome page.
     */
    public static function getWelcomeData()
    {
        $sections = WelcomeContent::orderBy('section')
            ->orderBy('order')
            ->get()
            ->groupBy('section');

        $data = [];
        foreach ($sections as $sectionName => $contents) {
            $data[$sectionName] = $contents->keyBy('key');
        }

        return $data;
    }
}

