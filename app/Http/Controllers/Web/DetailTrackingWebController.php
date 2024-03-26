<?php

namespace App\Http\Controllers\Web;

use App\Models\{DetailTracking, Tracking, Driver, Truck};;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DetailTrackingWebController extends Controller
{
    
    public function validateForm($req){
        $req->validate([
            'truck_id' => 'required',
            'driver_id' => 'required',
            'activity_id' => 'required',
            'tracking_date' => 'required',
            'geolocation_col' => 'required'
        ]);
    }
    public function findId($id){
        $find = DetailTracking::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('detail_trackings.index', [
            'data' => DetailTracking::leftJoin('drivers', 'detail_trackings.driver_id', 'drivers.id')
                        ->leftJoin('trackings', 'detail_trackings.activity_id', 'trackings.id')
                        ->leftJoin('trucks', 'detail_trackings.truck_id', 'trucks.id')
                        ->select('detail_trackings.*', 'drivers.name AS driver', 'trucks.name AS truck')
                        ->orderBy('detail_trackings.created_at', 'desc')
                        ->get()
        ]);
    }

    public function create()
    {
        //
        return view('detail_tracking.create',
            [
                'driver' => Driver::all(),
                'truck' => Truck::all(),
                'route' => RouteList::all()
            ]
        );
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $detail_tracking = DetailTracking::create($input);
        return redirect()->route('detail_tracking.index')->with('success','Data DetailTracking telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('detail_tracking.edit', 
            [
                'data' => $this->findId($id),
                'driver' => Driver::all(),
                'truck' => Truck::all(),
                'route' => RouteList::all()
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
        
        $detail_tracking = DetailTracking::where('id',$id)->update($input);
        
        return redirect()->route('detail_tracking.index')->with('success','Data Detail Tracking telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('detail_tracking.index')->with('deleted','Data Detail Tracking terhapus!!');
        
    }
}