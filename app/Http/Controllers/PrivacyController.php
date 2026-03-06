<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display the privacy policy page based on the slug.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function show($slug = null)
    {
        // If no slug provided, default to 'privacy-policy'
        if (!$slug) {
            $slug = 'privacy-policy';
        }

        // Validate the slug to prevent arbitrary file access
        $allowedSlugs = [
            'privacy-policy',
            'information-we-collect',
            'how-we-use',
            'data-protection',
            'cookies',
            'third-party',
            'your-rights',
            'childrens-privacy',
            'changes',
            'contact'
        ];

        if (!in_array($slug, $allowedSlugs)) {
            $slug = 'privacy-policy';
        }

        return view('privacy.show', compact('slug'));
    }

    /**
     * Display the terms of service page.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function terms($slug = null)
    {
        if (!$slug) {
            $slug = 'terms-of-service';
        }

        return view('privacy.terms', compact('slug'));
    }

    /**
     * Display the cookie policy page.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function cookie($slug = null)
    {
        if (!$slug) {
            $slug = 'cookie-policy';
        }

        return view('privacy.cookie', compact('slug'));
    }

    /**
     * Display the disclaimer page.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function disclaimer($slug = null)
    {
        if (!$slug) {
            $slug = 'disclaimer';
        }

        return view('privacy.disclaimer', compact('slug'));
    }

    /**
     * Display the contact page.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function contact($slug = null)
    {
        if (!$slug) {
            $slug = 'contact';
        }

        return view('privacy.contact', compact('slug'));
    }
}

