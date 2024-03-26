<?php

namespace App\Http\Controllers\Web;

use App\Models\{SubscriptionReport, Customer};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

use Carbon\Carbon;

class SubscriptionReportWebController extends Controller
{
     

    public function validateForm($req){
        $req->validate([
            'customer_id' => 'required',
            'total_payment' => 'required',
            'payment_date' => 'required',
        ]);
    }
    public function findId($id){
        $find = SubscriptionReport::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('subcriptionreport.index', [
            'data' => SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->select('subscription_reports.*','customers.name AS customer_name')
                        ->orderBy('created_at','desc')
                        ->get()
        ]);
    }

    public function create()
    {
        //
        return view('subcriptionreport.create', [
            'customer' => Customer::all()   
        ]);
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $subcriptionreport = SubscriptionReport::create($input);
        return redirect()->route('subscription_report.index')->with('success','Data Subcription Report telah tersimpan!!');
        
    }

    public function show($id)
    {
        //
        dd('request');

    }

    public function edit($id)
    {
        //
        return view('subcriptionreport.edit', 
            [
                'data' => $this->findId($id),
                'customer' => Customer::all()
            ]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);
        $this->validateForm($request);
        
        $input = $request->except(['_token','_method']);
        
        $subcriptionreport = SubscriptionReport::where('id',$id)->update($input);
        
        return redirect()->route('subscription_report.index')->with('success','Data Subcription Report telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('subscription_report.index')->with('deleted','Data Subcription Report terhapus!!');
        
    }

    public function view_export()
    {
        // dd('request');
        $monthList = $this->showListMonth();
        return view('subcriptionreport.export', [
            
            'listMonth' => $monthList
        ]);
    }

    public function showListMonth(){
        
        $currentMonth = date('m'); // Get the current month (e.g., '07' for July)
        $arrayMonth = array();

        // Create an array of month names
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        for ($i=1; $i <= 12 ; $i++) { 
            $monthObject = new \stdClass();
            $monthObject->month = $monthNames[$i];
            // $monthObject->date = date('Y-m-d');
            $monthObject->date = Carbon::create(date('Y'), $i, 1)->toDateString();

            array_push($arrayMonth, $monthObject);
        }


        // Set the month name and date inside the object

         // Get the current date in 'Y-m-d' format
        // dd($arrayMonth);
        return $arrayMonth;
        // Encode the object as JSON
        // $jsonObject = json_encode($monthObject);
    }
    public function filter($tipe, $value){
        // dd($tipe, $value);
        // dd($request);
        $input  = (object) [
                'tipe' => $tipe,
                'value' => $value
        ];
        // $input = new \stdClass();
        // $input->tipe = $request->tipe;
        // $input->value = $request->value;
        // dd($input);

        $dataFilter;
        if ($input->tipe == 'triwulan') {
            $dataFilter = $this->filterTriwulan($input);
        }
        if($input->tipe == 'perbulan'){
            $dataFilter = $this->filterPerbulan($input);
        }
        if($input->tipe == 'pertahun'){
            $dataFilter = $this->filterPertahun($input);
        }
        if($input->tipe == 'rentangWaktu'){
            $input->value = explode('=', $input->value);
            // dd($input);
            $dataFilter = $this->filterRentangWaktu($input);
        }

        
        // dd($dataFilter);
        // Log::info($input);
        

        // return response()->json(['success'=> $dataFilter]);
        return Excel::download(new LaporanExport("export.export-transaksi", $dataFilter), 'new_subscriptionReport.xlsx');

    }
    public function filterRentangWaktu($input){
        
        $records = SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->whereDate('subscription_reports.created_at', '>=', $input->value[0])
                        ->whereDate('subscription_reports.created_at', '<=', $input->value[1])
                        ->select('subscription_reports.*','customers.tarif as customer_tarif','customers.status as customer_status', 'customers.name AS customer_name', 'customers.urban_village as customer_kelurahan','customers.sub_district as customer_kecamatan', )
                        ->orderBy('created_at','desc')
                        ->get();
        // dd($records);
        return $records;
    }

    public function filterPertahun($input){
        $startDate  = Carbon::create($input->value.'-01-01')->format('Y-m-d');
        $endDate = Carbon::create($startDate)->endOfYear()->format('Y-m-d');

        // dd($startDate, $endDate);
        
        $records = SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->whereDate('subscription_reports.created_at', '>=', $startDate)
                        ->whereDate('subscription_reports.created_at', '<=', $endDate)
                        ->select('subscription_reports.*','customers.tarif as customer_tarif','customers.status as customer_status', 'customers.name AS customer_name', 'customers.urban_village as customer_kelurahan','customers.sub_district as customer_kecamatan', )
                        ->orderBy('subscription_reports.created_at','desc')

                        ->get();
        return $records;
    }

    public function filterPerbulan($input){
        $startDate  = $input->value;
        $endDate = Carbon::create($startDate)->endOfMonth()->format('Y-m-d');
        $records = SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->whereDate('subscription_reports.created_at', '>=', $startDate)
                        ->whereDate('subscription_reports.created_at', '<=', $endDate)
                        ->select('subscription_reports.*','customers.tarif as customer_tarif','customers.status as customer_status', 'customers.name AS customer_name', 'customers.urban_village as customer_kelurahan','customers.sub_district as customer_kecamatan', )
                        ->orderBy('subscription_reports.created_at','desc')

                        ->get();
        return $records;
    }

    public function filterTriwulan($input){
        switch ($input->value) {
            case 'triwulan1':
                $startDate = Carbon::create(Carbon::now()->year, 1, 1);
                $endDate = Carbon::create(Carbon::now()->year, $startDate->month)->addDays(89);
                break;
            case 'triwulan2':
                $startDate = Carbon::create(Carbon::now()->year, 4, 1);
                $endDate = Carbon::create(Carbon::now()->year, $startDate->month)->addDays(90);
                break;
            case 'triwulan3':
                $startDate = Carbon::create(Carbon::now()->year, 7, 1);
                $endDate = Carbon::create(Carbon::now()->year, $startDate->month)->addDays(91);
                break;
            case 'triwulan4':
                $startDate = Carbon::create(Carbon::now()->year, 10, 1);
                $endDate = Carbon::create(Carbon::now()->year, $startDate->month)->addDays(91);
                break;
            default:
                # code...
                break;
        }
        // dd($startDate, $endDate);
        // dd($records);
        

        $records = SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->whereDate('subscription_reports.created_at', '>=', $startDate)
                        ->whereDate('subscription_reports.created_at', '<=', $endDate)
                        ->select('subscription_reports.*','customers.tarif as customer_tarif','customers.status as customer_status', 'customers.name AS customer_name', 'customers.urban_village as customer_kelurahan','customers.sub_district as customer_kecamatan', )
                        ->orderBy('subscription_reports.created_at','desc')

                        ->get();
        return $records;
    }   
}