<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\{RouteDetail, RouteList, Customer};
use App\Http\Controllers\Controller;


class  RouteDetailWebController extends Controller
{
    
    public function validateForm($req){
        $req->validate([
            'route_id' => 'required',
            'customer_id' => 'required'
        ]);
    }
    public function findId($id){
        $find =  RouteDetail::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('route_detail.index', [
            'data' => RouteDetail::leftJoin('route_lists', 'route_detail.route_id', 'route_lists.id')
                        ->leftJoin('customers', 'route_detail.customer_id', 'customers.id')
                        ->select('route_detail.*', 'customers.name AS customer', 'route_lists.name AS route_name', 'route_lists.name AS route')
                        ->orderBy('route_detail.created_at', 'desc')
                        ->get()
        ]);
    }

    public function create()
    {
        //
        return view('route_detail.create',
            [
                'customer' => Customer::all(),
                'routeList' => RouteList::all()
            ]
        );
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $route_detail = RouteDetail::create($input);
        return redirect()->route('route-detail.index')->with('success','Data Route Detail telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('route_detail.edit', 
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
        
        $route_detail =  RouteDetail::where('id',$id)->update($input);
        
        return redirect()->route('route-detail.index')->with('success','Data Route Detail telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('route-detail.index')->with('deleted','Data Route Detail terhapus!!');
        
    }
}
