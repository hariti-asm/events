<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
      {  return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  
    
    public function store(Request $request): RedirectResponse
    {  
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required'],
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        
        if ($request->hasFile('profile_picture')) { 
            $profilePicture = $request->file('profile_picture');
            $imageName = $profilePicture->getClientOriginalName(); 
            $imagePath = $profilePicture->storeAs('profile_pictures', $imageName);
        } else {
            $imagePath = null;
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'image' => $imagePath,
        ]);
        
        event(new Registered($user));
    
        Auth::login($user);
    
        if ($request->user_type == 1) {
            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect()->route('admin.clients');
            return true;
        }
    }
    
    



}