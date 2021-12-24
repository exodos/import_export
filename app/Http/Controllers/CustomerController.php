<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Site;
use App\Notifications\SiteCreateNotify;
use App\Notifications\SiteDeleteNotify;
use App\Notifications\SiteUpdateNotify;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Swift_SmtpTransport;

class CustomerController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:site-list|site-create|site-edit|site-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:site-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:site-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:site-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $search = request()->query('search');
        if ($search) {
            $customers = Customer::where('id', 'LIKE', "%{$search}%")
                ->orWhere('customer_name', 'LIKE', "%{$search}%")
                ->orWhere('customer_email', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $customers = Customer::latest()->paginate(10);
        }

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('customers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id' => 'required|unique:sites|min:6|max:6',
            'customers_name' => 'required',
            'customers_tel' => 'required',
            'customers_email' => 'required',
            'customers_address' => 'required',
            'customers_account' => 'required',
            'group_id' => 'required',
        ]);

        Customer::create($request->all());
        session()->flash('success', 'Site Created Successfully.');
        return redirect()->route('customers.index');



    }

    /**
     * Display the specified resource.
     *
     * @param Site $site
     * @return Response
     */

    public function show(Site $site)
    {
        $sites = Site::find($site);
        if (empty($sites)) {
            redirect()->route('sites.index');
        }
//        $sites = $sites->load('air_conditioners', 'batteries', 'powers', 'rectifiers', 'solar_panels', 'towers', 'ups', 'work_orders');

        return view('sites.show', compact('site'));

    }

//    public function search()
//    {
//        return view('sites.search');
//    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Site $site
     * @return Response
     */
    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Site $site
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Site $site)
    {
        request()->validate([
            'id' => 'required|min:6|max:6',
            'sites_name' => 'required',
            'ps_configuration' => 'required',
            'monitoring_status' => 'required',
            'sites_latitude' => 'required',
            'sites_longitude' => 'required',
            'sites_region_zone' => 'required',
            'sites_political_region' => 'required',
            'sites_location' => 'required',
            'sites_class' => 'required',
            'sites_value' => 'required',
            'sites_type' => 'required',
            'maintenance_center' => 'required',
            'distance_mc' => 'required',
            'list_of_ne' => 'required',
            'number_of_towers' => 'required',
            'number_of_generator' => 'required',
            'number_of_airconditioners' => 'required',
            'number_of_rectifiers' => 'required',
            'number_of_solar_system' => 'required',
            'number_of_down_links' => 'required',
            'work_order_id' => 'required',
        ]);

        try {
            $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525, 'tls'))
                ->setUsername('d64ebeb2b3a8d6')
                ->setPassword('29853082ca6ace');

            $mailer = new \Swift_Mailer($transport);
            $mailer->getTransport()->start();

            $site->update($request->all());

            Notification::route('mail', 'exodosbob@gmail.com')
                ->notify(new SiteUpdateNotify($site));

            session()->flash('updated', 'Sites Successfully Updated!');
            return redirect()->route('sites.index');
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            session()->flash('connection', $message);
            return redirect()->route('sites.index');
        } catch (\Exception $e) {

            session()->flash('unable', 'Cannot Update Site With This Id!');
            return redirect()->route('sites.index');
        }

//        $site->update($request->all());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Site $site
     * @return Response
     * @throws \Exception
     */
    public function destroy(Site $site)
    {
        try {
            $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525, 'tls'))
                ->setUsername('d64ebeb2b3a8d6')
                ->setPassword('29853082ca6ace');

            $mailer = new \Swift_Mailer($transport);
            $mailer->getTransport()->start();

            $site->delete();

            Notification::route('mail', 'exodosbob@gmail.com')
                ->notify(new SiteDeleteNotify($site));

            session()->flash('deleted', 'Site Successfully Deleted!');
            return redirect()->route('sites.index');
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
//            session()->flash('connection', 'Connection Error! Please Check If You Have Internet Connection');
            session()->flash('connection', $message);
            return redirect()->route('sites.index');
        } catch (\Exception $e) {

            session()->flash('unable', 'Cannot Delete Site With This Id: Please Check If This Site Id Is Connected To Any Devices');
            return redirect()->route('sites.index');
        }
    }


}
