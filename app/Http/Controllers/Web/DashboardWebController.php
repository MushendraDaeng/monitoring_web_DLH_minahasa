<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Customer, Driver, Truck, RouteList};
use DB, Carbon\Carbon;


class DashboardWebController extends Controller
{
    
    public function index()
    {
        //
        // dd(Customer::get()->count());
        $customerPerBulan = DB::table('customers')
                      ->where('created_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(created_at) as Year, MONTHNAME(created_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(created_at), MONTHNAME(created_at)")
                      ->orderBy('created_at', 'asc')
                      ->take(5)
                      ->get();
        $truckPerBulan = DB::table('trucks')
                      ->where('created_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(created_at) as Year, MONTHNAME(created_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(created_at), MONTHNAME(created_at)")
                      ->orderBy('created_at', 'asc')
                      ->take(5)
                      ->get();
        $driverPerBulan = DB::table('drivers')
                      ->where('created_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(created_at) as Year, MONTHNAME(created_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(created_at), MONTHNAME(created_at)")
                      ->orderBy('created_at', 'asc')
                      ->take(5)
                      ->get();
        $routePerBulan = DB::table('route_lists')
                      ->where('created_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(created_at) as Year, MONTHNAME(created_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(created_at), MONTHNAME(created_at)")
                      ->orderBy('created_at', 'asc')
                      ->take(5)
                      ->get();
        $laporanBerlanggananPerBulan = DB::table('subscription_reports')
                      ->where('payment_date','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(payment_date) as Year, MONTHNAME(payment_date) as month, sum(total_payment) as value")
                      ->groupByRaw("YEAR(payment_date), MONTHNAME(payment_date)")
                      ->orderBy('payment_date', 'asc')
                      ->get();
        // dd($laporanBerlanggananPerBulan);    
        

        $berlanggananPerBulan = DB::table('customers')
                      ->where('status', 'Berlangganan')
                      ->where('updated_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(updated_at) as Year, MONTH(updated_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(updated_at), MONTH(updated_at)")
                      ->orderBy('updated_at', 'asc')
                      ->get();
        $tidakBerlanggananPerBulan = DB::table('customers')
                      ->where('status', 'Berhenti Berlangganan')
                      ->where('updated_at','LIKE',Carbon::now()->year."%")
                      ->whereNull('deleted_at')
                      ->selectRaw("YEAR(updated_at) as Year, MONTH(updated_at) as month, count(id) as value")
                      ->groupByRaw("YEAR(updated_at), MONTH(updated_at)")
                      ->orderBy('updated_at', 'asc')
                      ->get();
        $totalPerBulanBerlangganan = $this->totalPerBulan($berlanggananPerBulan);
        $totalPerBulanTidakBerlangganan = $this->totalPerBulan($tidakBerlanggananPerBulan);
        
        // dd($totalPerBulanTidakBerlangganan);
        
        return view('dashboard.index',[
            'customer' => Customer::get()->count(),
            'truck' => Truck::get()->count(),
            'driver' => Driver::get()->count(),
            'route' => RouteList::get()->count(),
            'customerPerBulan' => $customerPerBulan,
            'truckPerBulan' => $truckPerBulan,
            'driverPerBulan' => $driverPerBulan,
            'routePerBulan' => $routePerBulan,
            'laporanBerlanggananPerBulan' => $laporanBerlanggananPerBulan,
            // 'berlanggananPerBulan' => $berlanggananPerBulan,
            // 'berhentiBerlanggananPerBulan' => $berhentiBerlanggananPerBulan,
            'totalPerBulanBerlangganan' => $totalPerBulanBerlangganan,
            'totalPerBulanTidakBerlangganan' => $totalPerBulanTidakBerlangganan
        ]);
    }

    public function totalPerBulan($data){
        $rebArray = [];
        $total = 0;

        for ($a = 1; $a <= 12; $a++) { 
            $monthlyTotal = 0;

            foreach ($data as $key) {
                if ($a == $key->month) {
                    $key->prevMonth = $total;
                    $monthlyTotal += $key->value;
                    $key->total = $total += $key->value;
                }
             
            }
            if ($monthlyTotal > 0) {
                $rebArray[] = (object)[
                    'month' => $a,
                    'prevMonth' => $total - $monthlyTotal,
                    'total' => $total,
                ];
            }else{
                $rebArray[] = (object)[
                    'month' => $a,
                    'prevMonth' => 0,
                    'total' => 0,
                ];
            }
        }

        // dd($rebArray);

        return $rebArray;
    }

    
   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
