<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(User $users) {
        return view('user.index', [
            'users' => $users
                ->select(['id', 'name', 'role'])
                ->paginate(10),
        ]);
    }

    public function delete(User $user)
    {
        if ($user->id == 1) throw ValidationException::withMessages(['builtInUser' => 'Not allow to delete this user']);

        $user->delete();

        return redirect('/user');
    }

    public function store() {
        $request = request()->validate([
            'name' => 'required',
            'role' => 'required',
        ]);


        User::factory()->create([
            'name' => $request['name'],
            'role' => $request['role'],
        ]);

        return redirect('/user');
    }
}
