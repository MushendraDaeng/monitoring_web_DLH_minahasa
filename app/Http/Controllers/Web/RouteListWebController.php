<?php

namespace App\Http\Controllers\Web;

use App\Models\{RouteList, RouteDetail, Customer};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteListWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'name'=> 'required',
            'description'=>'required'
        ]);
    }
    public function findId($id){
        $find = RouteList::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('routelist.index', ['data' => RouteList::all()]);
    }

    

    // create&store detail

    public function createDetail($id)
    {
        // dd($id);
        return view('routelist.create-detail',[
            'id' => $id,
            'customer' => Customer::all(),
            
        ]);
    }

    public function storeDetailRoute(Request $request)
    {
        //
        $request->validate([
            'route_id' => 'required',
            'customer_id' => 'required'
        ]);
        $input = $request->except(['_token']);
        $route_detail = RouteDetail::create($input);
        return redirect()->route('routelist.show', $request->route_id)->with('success','Data Route Detail telah tersimpan!!');
        
    }
    
    public function create()
    {
        //
        return view('routelist.create');
    }
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $routelist = RouteList::create($input);
        return redirect()->route('routelist.index')->with('success','Data RouteList telah tersimpan!!');
        
    }

    public function show($id)
    {
        //
        $listRoute = RouteDetail::leftJoin('customers', 'route_detail.customer_id','customers.id')
                        ->where('route_detail.route_id', $id)
                        ->select('route_detail.*', 
                                 'customers.name as customer_name', 
                                 'customers.urban_village as customer_kel', 
                                 'customers.sub_district as customer_kec',
                                 'customers.longitude as long',
                                 'customers.latitude as lat'
                                )
                        ->orderBy('created_at', 'desc')
                        ->get()->toArray();
        // $listRoute = $listRoute->pluck('long','lat');
        // dd($listRoute);
        
        return view('routelist.show', 
            [
                'data' => $this->findId($id),
                'route_detail' => RouteDetail::
                                    leftJoin('customers', 'route_detail.customer_id','customers.id')
                                    ->where('route_detail.route_id', $id)
                                    ->select('route_detail.*', 'customers.name as customer_name', 'customers.urban_village as customer_kel', 'customers.sub_district as customer_kec')
                                    ->orderBy('created_at', 'desc')
                                    ->get(),
                'listRoute' => $listRoute
            ]
        );

    }

    public function destroyRouteDetail($id, $idDetail)
    {
        //
        // dd($id, $idDetail);
        RouteDetail::find($idDetail)->delete();
        return redirect()->route('routelist.show', $id)->with('deleted','Data Route Detail terhapus!!');
        
    }

    public function edit($id)
    {
        //
        return view('routelist.edit', 
            ['data' => $this->findId($id)]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);
        $this->validateForm($request);
        
        $input = $request->except(['_token','_method']);
        
        $routelist = RouteList::where('id',$id)->update($input);
        
        return redirect()->route('routelist.index')->with('success','Data RouteList telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('routelist.index')->with('deleted','Data RouteList terhapus!!');
        
    }
}