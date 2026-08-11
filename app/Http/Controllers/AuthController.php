<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   
    public function showLogin()
    {
        return view('login');
    }


    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ]);


        $remember = $request->boolean('remember');


        if (! Auth::attempt($credentials, $remember)) {

            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->isPatient()) {

            return redirect('/dashboard')
                ->with(
                    'status',
                    'Welcome back!'
                );
        }
        if (
            $user->isAdmin() ||
            $user->isDoctor() ||
            $user->isTestingStaff()
        ) {

            return redirect('/admin')
                ->with(
                    'status',
                    'Welcome back!'
                );
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        throw ValidationException::withMessages([
            'email' => 'Your account has an invalid role. Please contact the administrator.',
        ]);
    }


    public function showRegister()
    {
        return view('register');
    }


    public function register(Request $request)
    {
        $data = $request->validate([
    'name'     => ['required', 'string', 'max:255'],
    'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
    'password' => ['required', 'confirmed', Password::defaults()],
    'address'  => ['nullable', 'string', 'max:255'],
    'phone'    => ['nullable', 'string', 'max:20'],
    'gender'   => ['required', 'in:male,female'],
]);


        $user = User::create([
    'name'     => $data['name'],
    'email'    => $data['email'],
    'password' => Hash::make($data['password']),
    'address'  => $data['address'] ?? null,
    'phone'    => $data['phone'] ?? null,
    'gender'   => $data['gender'],
]);


        Auth::login($user);

        $request->session()->regenerate();


        return redirect('/dashboard')
            ->with(
                'status',
                'Account created — welcome to Omma Health Center!'
            );
    }



    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/')
            ->with(
                'status',
                'You have been signed out.'
            );
    }
}