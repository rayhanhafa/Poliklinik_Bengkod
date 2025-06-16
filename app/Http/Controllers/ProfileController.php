<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $dokter = $request->user(); 

  
        $polies = Poli::all();

      
        return view('profile.edit', [
            'user' => $dokter,  
            'polies' => $polies, 
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       $user = $request->user();
    
        
        $user->fill($request->validated());
    
       
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
       
        if ($request->has('id_poli')) {
            $user->id_poli = $request->input('id_poli');
        }
    
      
        $user->save();
    
        return Redirect::route('profile.edit')->with('success', 'Profil Telah di Update');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
