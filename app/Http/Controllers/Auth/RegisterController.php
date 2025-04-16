<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'whatsapp_number' => 'required|max:15|unique:' . User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);


        if (Str::startsWith($data['whatsapp_number'], '08')) {
            $data['whatsapp_number'] = preg_replace('/^08/', '628', $data['whatsapp_number']);
        } elseif (Str::startsWith($data['whatsapp_number'], '8')) {
            $data['whatsapp_number'] = '62' . $data['whatsapp_number'];
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        $rto = '/';
        switch (auth()->user()->role) {
            case 'customer':
                $rto = '/';
                break;
            case 'admin':
                $rto = '/admin/dashboard';
                break;
            case 'kasir':
                $rto = '/kasir/dashboard';
                break;
            case 'staff':
                $rto = '/pelayan/dashboard';
                break;
            default:
                $rto = '/';
                break;
                break;
        }
        return redirect($rto);
    }
}
