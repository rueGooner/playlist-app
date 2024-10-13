<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Carbon\Carbon;

class EventsController extends Controller
{
  /*
   * Display a listing of all events on /events page.
   */
  public function index()
  {
    if (!Gate::allows('events')) {
      return redirect()->route('home')->with('error', 'Unauthorised access.');
    }

    $events = Event::with('user')->orderBy('created_at', 'desc')->get();

    return Inertia::render('Events/Index', [
      'events' => $events,
    ]);
  }

  public function create(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'user_name' => 'required|string|max:255',
      'user_email' => 'required|string|max:255',
      'date' => 'required|date',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i|after:start_time',
      'address' => 'required|string|max:255',
    ]);

    $user = User::firstOrCreate(
      ['email' => $request->user_email],
      [
        'name' => $request->user_name,
        'email' => $request->user_email,
        'password' => Hash::make('password!1'),
        'role', 'client'
      ],
    );

    $event = Event::create([
      'title' => $request->title,
      'event_date' => $request->date,
      'start_time' => Carbon::parse($request->date . ' ' . $request->start_time)->toDateTimeString(),
      'end_time' => Carbon::parse($request->date . ' ' . $request->end_time)->toDateTimeString(),
      'address' => $request->address,
      'user_id' => $user->id,
    ]);

    return redirect()->route('events.index')->with('success', 'Event Created');
  }
}
