<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $fullName = trim($request->fname . ' ' . ($request->mname ? $request->mname . ' ' : '') . $request->lname);

            $user = User::create([
                'name' => $fullName,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'course' => $request->course,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'Athlete',
                'email_verified_at' => now(),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'db_connection' => config('database.default'),
            ]);
            
            return back()->withInput()->with('failed', 'Registration failed. Please try again later.');
        }
    }
}
