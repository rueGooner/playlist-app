<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class PasswordController extends Controller
{
  /**
   * Update the user's password.
   */
  public function update(Request $request): RedirectResponse
  {
    if ($request->user()->password_needs_reset) {
      return $this->updateFirstPassword($request);
    }

    $validated = $request->validate([
      'current_password' => ['required', 'current_password'],
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
    ]);

    return back();
  }

  /**
   * Display the update first password view.
   */
  public function index(Request $request): Response
  {
    return Inertia::render('Dashboard/ResetPassword', [
      'email' => $request->email,
      'token' => $request->route('token'),
    ]);
  }

  protected function updateFirstPassword(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
      'password_needs_reset' => false,
    ]);

    $request->session()->regenerate();

    return redirect()->route('dashboard')->with('message', 'Password updated successfully.');
  }
}
