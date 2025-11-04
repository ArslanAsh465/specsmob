<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class BackendUsersController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'Users';

        $query = User::where('role', User::ROLE_USER);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['users'] = $query->orderBy('created_at', 'desc')->paginate(20)->appends($request->all());

        return view('backend.users.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add User';

        return view('backend.users.create', $this->data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|in:0,1',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = User::ROLE_USER;

        User::create($validated);

        return redirect()->route('backend.users.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'User created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View User';

        $this->data['user'] = User::where('role', User::ROLE_USER)->findOrFail($id);

        return view('backend.users.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit User';

        $this->data['user'] = User::where('role', User::ROLE_USER)->findOrFail($id);

        return view('backend.users.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', User::ROLE_USER)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:0,1',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('backend.users.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::where('role', User::ROLE_USER)->findOrFail($id);

        $hasRelations = $user->brands()->exists()
            || $user->mobiles()->exists()
            || $user->mobileComments()->exists()
            || $user->news()->exists()
            || $user->newsComments()->exists()
            || $user->reviews()->exists()
            || $user->reviewComments()->exists();

        if ($hasRelations) {
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Cannot delete this user because they have associated data.');
        }

        $user->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'User deleted successfully!');
    }
}
