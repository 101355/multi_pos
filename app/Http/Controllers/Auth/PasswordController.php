<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class PasswordController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.change-password', [
            'user' => $request->user(),
        ]);
    }

    public function update(ChangePasswordRequest $request)
    {
        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('success', 'Successfully changed');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return back()->with('error', $e->getMessage());
    }
}
