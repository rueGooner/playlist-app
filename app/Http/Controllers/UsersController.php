<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function index()
  {
    $users = User::query()
      ->select('id', 'name', 'email', 'role')
      ->where('role', '!=', 'admin')
      ->get();
    return response()->json($users);
  }
}
