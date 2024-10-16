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

  public function store(Request $request)
  {
    $this->validateRequest($request);

    $user = $this->findUserByID($request->user_email);

    if (!$user) {
      return redirect()->back()->withErrors(['user_email' => 'User not found.']);
    }

    $event = $this->createNewEvent($request, $user->id);

    return $this->renderEventIndexWithSuccessMessage();
  }

  private function validateRequest(Request $request): void
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'user_id' => 'required|integer',
      'date' => 'required|date',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i|after:start_time',
      'address' => 'required|string|max:255',
    ]);
  }

  private function findUserByID(int $userId): ?User
  {
    return User::where('id', $userId)->first();
  }

  private function createNewEvent(Request $request, int $userId): Event
  {
    return Event::create([
      'title' => $request->title,
      'event_date' => $request->date,
      'start_time' => Carbon::parse($request->date . ' ' . $request->start_time)->toDateTimeString(),
      'end_time' => Carbon::parse($request->date . ' ' . $request->end_time)->toDateTimeString(),
      'address' => $request->address,
      'user_id' => $userId,
    ]);
  }

  private function renderEventIndexWithSuccessMessage()
  {
    $events = Event::with('user')->orderBy('created_at', 'desc')->get(); // Fetching the events again for rendering
    return Inertia::render('Events/Index', [
      'events' => $events,
      'message' => 'New Event Created Successfully.',
    ]);
  }
}
