<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
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

    $events = Event::with('user')->get();

    return Inertia::render('Events/Index', [
      'events' => $events,
    ]);
  }
}
