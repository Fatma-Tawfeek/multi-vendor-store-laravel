<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $countries = Countries::getNames();
        $locales = Locales::getNames();
        return view('dashboard.profile.edit', compact('user', 'countries', 'locales'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'required|in:male,female',
            'country' => 'required|string|size:2',
            'locale' => 'required|string|size:2',
        ]);

        $user = Auth::user();

        $user->profile->fill($request->all())->save();

        // if ($profile->first_name) {
        //     $profile->update($request->all());
        // } else {
        //     $user->profile()->create($request->all());
        // }

        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated successfully');
    }
}
