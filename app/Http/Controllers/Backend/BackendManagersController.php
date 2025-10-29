<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class BackendManagersController extends Controller
{
    protected $data = [];
    
    public function index()
    {
        $this->data['title'] = 'Managers';

        $this->data['managers'] = User::where('role', User::ROLE_MANAGER)->get();

        return view('backend.managers.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add Manager';

        return view('backend.managers.create', $this->data);
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
        $validated['role'] = User::ROLE_MANAGER;

        User::create($validated);

        return redirect()->route('backend.managers.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Manager created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View Manager';

        $this->data['manager'] = User::where('role', User::ROLE_MANAGER)->findOrFail($id);

        return view('backend.managers.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Manager';

        $this->data['manager'] = User::where('role', User::ROLE_MANAGER)->findOrFail($id);

        return view('backend.managers.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $manager = User::where('role', User::ROLE_MANAGER)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $manager->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:0,1',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $manager->update($validated);

        return redirect()->route('backend.managers.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Manager updated successfully.');
    }

    public function destroy($id)
    {
        $manager = User::where('role', User::ROLE_MANAGER)->findOrFail($id);

        $hasRelations = $manager->brands()->exists()
            || $manager->mobiles()->exists()
            || $manager->mobileComments()->exists()
            || $manager->news()->exists()
            || $manager->newsComments()->exists()
            || $manager->reviews()->exists()
            || $manager->reviewComments()->exists();

        if ($hasRelations) {
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Cannot delete this manager because they have associated data.');
        }

        $manager->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Manager deleted successfully!');
    }
}
