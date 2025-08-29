<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    public function index()
    {
        $users = User::withCount('orders')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin'
        ]);

        $user->update($request->all());

        session()->flash('success', 'Utilisateur mis à jour avec succès !');

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Vous ne pouvez pas supprimer votre propre compte !');
            return redirect()->route('admin.users.index');
        }

        $user->delete();

        session()->flash('success', 'Utilisateur supprimé avec succès !');

        return redirect()->route('admin.users.index');
    }
} 