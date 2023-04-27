<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::all();
            return view('loaduser', ['users' => $users]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            return response()->json(['users' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function showadd()
    {
        try {
            return view('adduser');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('users.index')->with('success', 'User added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }

    public function showupdate($id)
    {
        try {
            $user = User::find($id);
            return view('updateuser', ['user' => $user]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');

        }
    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::destroy($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }
}
