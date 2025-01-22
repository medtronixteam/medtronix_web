<?php

// app/Http/Controllers/SettingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\OfficeTime;
use App\Models\IpRange;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class SettingController extends Controller
{
     public function index(Request $request)
    {
        $yearlyLeaves = Setting::where('name', 'yearly_leaves')->first();
        $relaxion = Setting::where('name', 'relaxion')->first();
        $ipRange = IpRange::all();

        // Fetch the office time settings
        $officeTime = OfficeTime::first();

        // Handle the case where the setting doesn't exist
        if ($yearlyLeaves === null) {
            $yearlyLeaves = new Setting();
            $yearlyLeaves->value = 0; // Default value
        }

        $currentIp = $request->ip();

        return view('admin.settings.settings', compact('yearlyLeaves', 'ipRange', 'currentIp', 'relaxion', 'officeTime'));
    }


    public function update(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'yearly_leaves' => 'required|integer|min:0',
        'relaxion' => 'nullable|integer|min:0', // Relaxion field is optional
    ]);

    // Update or create the yearly_leaves setting
    $yearlyLeaves = Setting::updateOrCreate(
        ['name' => 'yearly_leaves'],
        ['value' => $request->yearly_leaves]
    );

    // Update or create the relaxion setting, if provided
    if ($request->has('relaxion')) {
        $relaxion = Setting::updateOrCreate(
            ['name' => 'relaxion'],
            ['value' => $request->relaxion]
        );
    }

    // Redirect back or wherever you want after saving
    flashy()->success('Settings updated successfully.');
    return redirect()->back()->with('success', 'Settings updated successfully.');
}
public function deleteIpRange($id) {

    $ipRange = IpRange::find($id);
    $ipRange->delete();
    flashy()->success('IP has been deleted successfully.');
    return redirect()->back();
}

    public function updateIpRange(Request $request)
    {
        $request->validate([
            'network_name' => 'required',
            'network_ip' => 'required|ip',
        ]);



        try {
            IpRange::updateOrCreate([
                'network_ip'=>$request->network_ip,
            ],[
                'network_name'=>$request->network_name,

            ]);
            flashy()->success('IP has added successfully.');
            return redirect()->back()->with('success', 'IP range Added successfully.');
        } catch (\Exception $e) {
            flashy()->error('Failed to update IP range.');
            return redirect()->back()->withErrors(['error' => 'Failed to update IP range.']);
        }
    }

 public function updateOfficeTime(Request $request)
    {
        $request->validate([
            'open_time' => 'required',
            'close_time' => 'required',
            'max_reporting_time' => 'required',
            'min_reporting_time' => 'required',

        ]);

        $officeTime = OfficeTime::firstOrNew();

        $officeTime->open_time = $request->open_time;
        $officeTime->close_time = $request->close_time;
        $officeTime->max_reporting_time = $request->max_reporting_time;
        $officeTime->min_reporting_time = $request->min_reporting_time;


        $officeTime->save();

        flashy()->success('Office time settings updated successfully.');
        return redirect()->back()->with('success', 'Office time settings updated successfully.');
    }
    function generate(Request $request){

        Setting::updateOrCreate(
        ['name' => 'qr_code'],

        [
            'value' =>"https://www.medtronix.world?dump=".md5('medtronix')."&timestamp=". md5(Carbon::now()),

        ] );
        flashy()->success('QR Code has been Updated.');


        return back();
}
public function loctionSettings(Request $request)
{
    $request->validate([
        'longitude' => 'required|string',
        'latitude' => 'required|string',
        'radius' => 'required|string',
    ]);
    Setting::updateOrCreate(
        ['name' => 'longitude'],
        ['value' => $request->longitude]
    );
    Setting::updateOrCreate(
        ['name' => 'latitude'],
        ['value' => $request->latitude]
    );
    Setting::updateOrCreate(
        ['name' => 'radius'],
        ['value' => $request->radius]
    );

    flashy()->success('Location details have been updated');

    return back();
}
public function generateQrCode()
{


    $setting=Setting::where('name','qr_code')->first();
    $qrCode = QrCode::size(300)->generate($setting->value);

    return view('admin.qr-code', compact('qrCode', 'setting'));
}
}
