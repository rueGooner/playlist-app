<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): Response
  {
    return Inertia::render('Auth/Login', [
      'canResetPassword' => Route::has('password.request'),
      'status' => session('status'),
    ]);
  }

  /**
   * Handle an incoming authentication request.
   * @throws ValidationException
   */
  public function store(LoginRequest $request): Response
  {
    $this->validateLogin($request);

    if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
      $request->session()->regenerate();
      $user = Auth::user();

      // Check if user needs to reset password
      if (Auth::user()->password_needs_reset) {
        return Inertia::render('Auth/ResetPassword', [
          'user' => $user,
          'resetRequired' => true,
        ]);
      }

      return Inertia::render('Dashboard', [
        'role' => $user->role
      ]);
    }

    throw ValidationException::withMessages([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  protected function validateLogin(Request $request): void
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);
  }
}
