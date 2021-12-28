<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Site;
use App\Notifications\SiteCreateNotify;
use App\Notifications\SiteDeleteNotify;
use App\Notifications\SiteUpdateNotify;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
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
//        $search = request()->query('search');

        $customerName = request()->query('customer_name');
        $customerTel = request()->query('customer_tel');
        $customerEmail = request()->query('customer_email');
        $customerAddress = request()->query('customer_address');
        $customerGroup = request()->query('customer_group');

        if ($customerName || $customerTel || $customerEmail || $customerAddress || $customerGroup){
            $customers = DB::table('customers')
                ->where('customer_name','=',"{$customerName}")
                ->orWhere('customer_tel','=',"{$customerTel}")
                ->orWhere('customer_email','=',"{$customerEmail}")
                ->orWhere('customer_address','=',"{$customerAddress}")
                ->orWhere('customer_group','=',"{$customerGroup}")
                ->paginate(10);
        }else{
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
    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->all());
        session()->flash('success', 'Customer Created Successfully.');
        return redirect()->route('customers.index');


    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */

    public function show($id)
    {
        $customer = Customer::find($id);
        if (empty($customer)) {
            redirect()->route('customers.index');
        }
//        $sites = $sites->load('air_conditioners', 'batteries', 'powers', 'rectifiers', 'solar_panels', 'towers', 'ups', 'work_orders');

        return view('customers.show', compact('customer'));

    }

//    public function search()
//    {
//        return view('sites.search');
//    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {

        try {
            $customer->update($request->all());
            session()->flash('updated', 'Customer Successfully Updated!');
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            session()->flash('unable', 'Cannot Update Customer With This Id!');
            return redirect()->route('customers.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        try {

            $customer->delete();

            session()->flash('deleted', 'Customer Successfully Deleted!');
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            session()->flash('unable', 'Cannot Update Customer With This Id!');
            return redirect()->route('customers.index');
        }
    }
}
