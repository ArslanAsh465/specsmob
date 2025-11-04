<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use App\Models\User;

class BackendBrandsController extends Controller
{
    protected $data = [];
    
    public function index(Request $request)
    {
        $this->data['title'] = 'Brands';

        // Filter Data
        $this->data['users'] = User::whereHas('brands')->get();

        $query = Brand::with(['user', 'mobiles']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['brands'] = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('backend.brands.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add Brand';

        return view('backend.brands.create', $this->data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|unique:brands,name',
            'status' => 'required|in:0,1',
        ]);

        Brand::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'status'  => $request->status,
        ]);

        return redirect()->route('backend.brands.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Brand created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View Brand';

        $this->data['brand'] = Brand::with('mobiles')->findOrFail($id);

        return view('backend.brands.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Brand';

        $this->data['brand'] = Brand::findOrFail($id);

        return view('backend.brands.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:brands,name,' . $brand->id,
            'status' => 'required|in:0,1',
        ]);

        $status = $request->status;

        if ($brand->mobiles()->exists() && $status == 0) {
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'This brand has associated mobiles and cannot be marked as inactive.');
        }

        $brand->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('backend.brands.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->mobiles()->exists()) {
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Cannot delete this brand because it has associated mobiles.');
        }

        $brand->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Brand deleted successfully!');
    }
}
