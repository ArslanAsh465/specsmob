<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class BackendAdminsController extends Controller
{
    protected $data = [];
    
    public function index()
    {
        $this->data['title'] = 'Admins';

        $this->data['admins'] = User::where('role', User::ROLE_ADMIN)->get();

        return view('backend.admins.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add Admin';

        return view('backend.admins.create', $this->data);
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
        $validated['role'] = User::ROLE_ADMIN;

        User::create($validated);

        return redirect()->route('backend.admins.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Admin created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View Admin';

        $this->data['admin'] = User::where('role', User::ROLE_ADMIN)->findOrFail($id);

        return view('backend.admins.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Admin';

        $this->data['admin'] = User::where('role', User::ROLE_ADMIN)->findOrFail($id);

        return view('backend.admins.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('role', User::ROLE_ADMIN)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:0,1',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('backend.admins.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = User::where('role', User::ROLE_ADMIN)->findOrFail($id);

        $hasRelations = $admin->brands()->exists()
            || $admin->mobiles()->exists()
            || $admin->mobileComments()->exists()
            || $admin->news()->exists()
            || $admin->newsComments()->exists()
            || $admin->reviews()->exists()
            || $admin->reviewComments()->exists();

        if ($hasRelations) {
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Cannot delete this admin because they have associated data.');
        }

        $admin->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Admin deleted successfully!');
    }
}
