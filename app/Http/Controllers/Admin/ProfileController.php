<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        else {
            unset($data['password']);
        }

        unset($data['password_confirmation']);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists and is not an external URL
            if ($user->avatar && !Str::startsWith($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($user->logo && !Str::startsWith($user->logo, 'http')) {
                Storage::disk('public')->delete($user->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Handle logo_dark upload
        if ($request->hasFile('logo_dark')) {
            if ($user->logo_dark && !Str::startsWith($user->logo_dark, 'http')) {
                Storage::disk('public')->delete($user->logo_dark);
            }
            $data['logo_dark'] = $request->file('logo_dark')->store('logos', 'public');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($user->favicon && !Str::startsWith($user->favicon, 'http')) {
                Storage::disk('public')->delete($user->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('logos', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
