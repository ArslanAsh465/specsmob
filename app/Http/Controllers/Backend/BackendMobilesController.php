<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Mobile;
use App\Models\Brand;
use App\Models\User;

class BackendMobilesController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'Mobiles';

        // Filter's Data
        $this->data['brands'] = Brand::whereHas('mobiles')->get();
        $this->data['users'] = User::whereHas('mobiles')->get();

        $query = Mobile::with('user', 'brand', 'comments');

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['mobiles'] = $query->paginate(20)->withQueryString();

        return view('backend.mobiles.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add Mobile';

        $this->data['brands'] = Brand::where('status', 1)->get();

        return view('backend.mobiles.create', $this->data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|unique:mobiles,name',

            // Versions
            'versions' => 'nullable|string',

            // Network
            'network_technology' => 'nullable|string',
            'network_2g_bands' => 'nullable|string',
            'network_3g_bands' => 'nullable|string',
            'network_4g_bands' => 'nullable|string',
            'network_5g_bands' => 'nullable|string',
            'network_speed' => 'nullable|string',

            // Launch
            'launch_date' => 'nullable|date',
            'launch_status' => 'nullable|string',

            // Body
            'body_dimensions' => 'nullable|string',
            'body_weight' => 'nullable|string',
            'body_build' => 'nullable|string',
            'body_sim' => 'nullable|string',

            // Display
            'display_type' => 'nullable|string',
            'display_size' => 'nullable|string',
            'display_resolution' => 'nullable|string',
            'display_protection' => 'nullable|string',

            // Platform
            'platform_os' => 'nullable|string',
            'platform_chipset' => 'nullable|string',
            'platform_cpu' => 'nullable|string',
            'platform_gpu' => 'nullable|string',

            // Memory
            'memory_card_slot' => 'nullable|string',
            'memory_internal' => 'nullable|string',

            // Cameras
            'main_camera_setup' => 'nullable|string',
            'main_camera_features' => 'nullable|string',
            'main_camera_video' => 'nullable|string',
            'selfie_camera_setup' => 'nullable|string',
            'selfie_camera_features' => 'nullable|string',
            'selfie_camera_video' => 'nullable|string',

            // Sound
            'sound_loudspeaker' => 'nullable|string',
            'sound_jack_3_5mm' => 'nullable|string',

            // Communications
            'comms_wlan' => 'nullable|string',
            'comms_bluetooth' => 'nullable|string',
            'comms_positioning' => 'nullable|string',
            'comms_nfc' => 'nullable|string',
            'comms_radio' => 'nullable|string',
            'comms_usb' => 'nullable|string',

            // Features
            'features_sensors' => 'nullable|string',
            'features_extra' => 'nullable|string',

            // Battery
            'battery_type' => 'nullable|string',
            'battery_charging' => 'nullable|string',

            // Misc
            'misc_colors' => 'nullable|string',
            'misc_models' => 'nullable|string',
            'misc_sar_us_head' => 'nullable|string',
            'misc_sar_us_body' => 'nullable|string',
            'misc_sar_eu_head' => 'nullable|string',
            'misc_sar_eu_body' => 'nullable|string',
            'misc_price' => 'nullable|numeric|min:0',

            // SEO
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',

            // General
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('mobiles', 'public');
        }

        Mobile::create($validated);

        return redirect()->route('backend.mobiles.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Mobile created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View Mobile';

        $this->data['mobile'] = Mobile::with('user', 'brand', 'comments')->findOrFail($id);

        return view('backend.mobiles.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Mobile';

        $this->data['mobile'] = Mobile::with('user', 'brand', 'comments')->findOrFail($id);

        $this->data['brands'] = Brand::where('status', 1)->get();

        return view('backend.mobiles.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $mobile = Mobile::findOrFail($id);

        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|unique:mobiles,name,' . $mobile->id,

            // Network
            'versions' => 'nullable|string',
            'network_technology' => 'nullable|string',
            'network_2g_bands' => 'nullable|string',
            'network_3g_bands' => 'nullable|string',
            'network_4g_bands' => 'nullable|string',
            'network_5g_bands' => 'nullable|string',
            'network_speed' => 'nullable|string',

            // Launch
            'launch_date' => 'nullable|date',
            'launch_status' => 'nullable|string',

            // Body
            'body_dimensions' => 'nullable|string',
            'body_weight' => 'nullable|string',
            'body_build' => 'nullable|string',
            'body_sim' => 'nullable|string',

            // Display
            'display_type' => 'nullable|string',
            'display_size' => 'nullable|string',
            'display_resolution' => 'nullable|string',
            'display_protection' => 'nullable|string',

            // Platform
            'platform_os' => 'nullable|string',
            'platform_chipset' => 'nullable|string',
            'platform_cpu' => 'nullable|string',
            'platform_gpu' => 'nullable|string',

            // Memory
            'memory_card_slot' => 'nullable|string',
            'memory_internal' => 'nullable|string',

            // Cameras
            'main_camera_setup' => 'nullable|string',
            'main_camera_features' => 'nullable|string',
            'main_camera_video' => 'nullable|string',
            'selfie_camera_setup' => 'nullable|string',
            'selfie_camera_features' => 'nullable|string',
            'selfie_camera_video' => 'nullable|string',

            // Sound
            'sound_loudspeaker' => 'nullable|string',
            'sound_jack_3_5mm' => 'nullable|string',

            // Communications
            'comms_wlan' => 'nullable|string',
            'comms_bluetooth' => 'nullable|string',
            'comms_positioning' => 'nullable|string',
            'comms_nfc' => 'nullable|string',
            'comms_radio' => 'nullable|string',
            'comms_usb' => 'nullable|string',

            // Features
            'features_sensors' => 'nullable|string',
            'features_extra' => 'nullable|string',

            // Battery
            'battery_type' => 'nullable|string',
            'battery_charging' => 'nullable|string',

            // Misc
            'misc_colors' => 'nullable|string',
            'misc_models' => 'nullable|string',
            'misc_sar_us_head' => 'nullable|string',
            'misc_sar_us_body' => 'nullable|string',
            'misc_sar_eu_head' => 'nullable|string',
            'misc_sar_eu_body' => 'nullable|string',
            'misc_price' => 'nullable|numeric|min:0',

            // SEO
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',

            // General
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('mobiles', 'public');
        }

        $mobile->update($validated);

        return redirect()->route('backend.mobiles.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Mobile updated successfully.');
    }

    public function destroy($id)
    {
        $mobile = Mobile::findOrFail($id);

        $mobile->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Mobile deleted successfully!');
    }
}
