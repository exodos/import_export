<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Power;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\SolarPanel;
use App\Models\Tower;
use App\Models\Ups;
use App\Models\WorkOrder;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SiteController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        if (Auth::guest()) {
//            return redirect()->route('login');
//        }

        $sites = Site::paginate(10);

        return view('sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sites.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'id' => 'required|unique:sites',
            'sites_name' => 'required',
            'sites_latitude' => 'required',
            'sites_longitude' => 'required',
            'sites_region_zone' => 'required',
            'sites_political_region' => 'required',
            'sites_category' => 'required',
            'sites_class' => 'required',
            'sites_value' => 'required',
            'sites_type' => 'required',
            'sites_configuration' => 'required',
            'monitoring_system_name' => 'required',
            'commercial_power_line_voltage' => 'required',
        ]);

        Site::create([
            'id' => $request->id,
            'sites_name' => $request->sites_name,
            'sites_latitude' => $request->sites_latitude,
            'sites_longitude' => $request->sites_longitude,
            'sites_region_zone' => $request->sites_region_zone,
            'sites_political_region' => $request->sites_political_region,
            'sites_category' => $request->sites_category,
            'sites_class' => $request->sites_class,
            'sites_value' => $request->sites_value,
            'sites_type' => $request->sites_type,
            'sites_configuration' => $request->sites_configuration,
            'monitoring_system_name' => $request->monitoring_system_name,
            'commercial_power_line_voltage' => $request->commercial_power_line_voltage,
            'distance_maintenance_center' => $request->distance_maintenance_center
        ]);

        session()->flash('success', 'Site Created Successfully.');

        return redirect()->route('sites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $site = Site::find($id);
        if (empty($site)) {
            redirect()->route('sites.index');
        }
        $site = $site->load('air_conditioners', 'batteries', 'powers', 'rectifiers', 'solar_panels', 'towers', 'ups', 'work_orders');

//        $site = $site->load('batteries');
//        $airconditioners_id = $site->air_conditioners_id;
////        $airconditioner = AirConditioner::find($airconditioners_id);
//        $batteries_id = $site->batteries_id;
//        $battery = Battery::find($batteries_id);
//        $power_id = $site->powers_id;
//        $powers = Power::find($power_id);
//        $rectifiers_id = $site->rectifiers_id;
//        $rectifiers = Rectifier::find($rectifiers_id);
//        $solar_panels_id = $site->solar_panels_id;
//        $solar_panels = SolarPanel::find($solar_panels_id);
//        $tower_id = $site->towers_id;
//        $towers = Tower::find($tower_id);
//        $ups_id = $site->ups_id;
//        $ups = Ups::find($ups_id);
//        $work_orders_id = $site->work_orders_id;
//        $work_orders = WorkOrder::find($work_orders_id);


        return view('sites.show', compact('site'));

//       die(print_r($airconditioners));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sites = Site::find($id);

        return View::make('sites.edit')->with('sites', $sites);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sites_id = Site::find($id);

        $this->validate($request, [
            'id' => 'required',
            'sites_name' => 'required',
            'sites_latitude' => 'required',
            'sites_longitude' => 'required',
            'sites_region_zone' => 'required',
            'sites_political_region' => 'required',
            'sites_category' => 'required',
            'sites_class' => 'required',
            'sites_value' => 'required',
            'sites_type' => 'required',
            'sites_configuration' => 'required',
            'monitoring_system_name' => 'required',
            'commercial_power_line_voltage' => 'required',
            'distance_maintenance_center' => 'required',
        ]);

        $input = $request->all();
        $sites_id->fill($input)->save();

        session()->flash('updated', 'Sites Successfully Updated!');

        return redirect()->route('sites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site = Site::find($id);

        try {
            $site->delete();
            session()->flash('deleted', 'Site Successfully Deleted!');
            return redirect()->route('sites.index');
        } catch (QueryException $e) {
            session()->flash('unable', 'Integrity constraint violation: Cannot Delete Site With This Id!');
//            session()->flash('unable', $e->getMessage());
            return redirect()->route('sites.index');
        }

    }
}
