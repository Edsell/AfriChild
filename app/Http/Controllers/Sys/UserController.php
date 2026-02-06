<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Keep aligned with your project style (DB facade + Page wrapper)
    private array $roles = ['admin', 'editor', 'reader'];

    // Protect your primary/system account if needed (adjust values to match your project)
    private int $protectedId = 1;

    public function index(Request $request)
    {
        $q = DB::table('users')->select('*');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $q->where(function ($x) use ($search) {
                $x->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $role = $request->role;
            if (in_array($role, $this->roles, true)) {
                $q->where('role', $role);
            }
        }

        $users = $q->orderByDesc('id')->paginate(12)->withQueryString();

        return view('sys.index', [
            'Page'  => 'sys.users.index',
            'Title' => 'Users',
            'Desc'  => 'Manage system users',
            'users' => $users,
            'roles' => $this->roles,
        ]);
    }


    public function create()
{
    return view('sys.index', [
        'Page'  => 'sys.users.create',   // ✅ THIS MUST BE create
        'Title' => 'Create User',
        'Desc'  => 'Add a new system user',
        'roles' => $this->roles,
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in($this->roles)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::table('users')->insert([
            'role' => $validated['role'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('sys.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);

        return view('sys.index', [
            'Page'  => 'sys.users.edit',     // ✅ THIS MUST BE edit
            'Title' => 'Edit User',
            'Desc'  => 'Update ' . ($user->name ?? 'User'),
            'user'  => $user,
            'roles' => $this->roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);

        if ((int)$user->id === $this->protectedId) {
            abort(404);
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in($this->roles)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            // optional password
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $update = [
            'role' => $validated['role'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ];

        if (!empty($validated['password'])) {
            $update['password'] = Hash::make($validated['password']);
        }

        DB::table('users')->where('id', $id)->update($update);

        return redirect()->route('sys.users.index')->with('success', 'User updated successfully.');
    }

    public function updateAvatar(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);

        if ((int)$user->id === $this->protectedId) {
            abort(404);
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
        ]);

        // delete old avatar if exists
        if (!empty($user->avatar) && File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }

        $file = $request->file('avatar');
        $name = time() . '_user_' . $id . '.' . $file->extension();
        $file->move(public_path('uploads/users/avatars'), $name);

        DB::table('users')->where('id', $id)->update([
            'avatar' => 'uploads/users/avatars/' . $name,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'User avatar updated.');
    }

    public function deleteAvatar($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);

        if ((int)$user->id === $this->protectedId) {
            abort(404);
        }

        if (!empty($user->avatar) && File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }

        DB::table('users')->where('id', $id)->update([
            'avatar' => null,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'User avatar removed.');
    }

    public function destroy($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);

        // prevent deleting protected or yourself (avoids locking admin out)
        if ((int)$user->id === $this->protectedId) abort(404);
        if (auth()->id() === (int)$user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // delete avatar file
        if (!empty($user->avatar) && File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('sys.users.index')->with('success', 'User deleted successfully.');
    }
}
