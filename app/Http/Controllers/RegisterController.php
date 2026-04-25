<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function registerread(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('failed', 'Registration failed! Please check the errors below.');
        }

        try {
            DB::beginTransaction();
            
            $fullName = trim($request->fname . ' ' . ($request->mname ? $request->mname . ' ' : '') . $request->lname);
            $user = User::create([
                'name' => $fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'course' => $request->course,
                'gender' => $request->gender,
                'role' => 'Athlete',
                'email_verified_at' => now(),
            ]);
            
            DB::commit();

            return redirect()->route('login')->with('success', 'Registration successful! Please login to continue.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Registration failed: ' . $e->getMessage());
        }
    }
}
