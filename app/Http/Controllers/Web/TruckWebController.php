<?php

namespace App\Http\Controllers\Web;


use App\Models\Truck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class TruckWebController extends Controller
{
 
    public function validateForm($req, $tipe){
        if($tipe == 'store'){
            $req->validate([
                'name' => 'required',
                'plate' => 'required',
                'mnf_year' => 'required',
                'brand' => 'required',
                'fuel_type' => 'required',
                'foto' => 'required'
            ]);
        }else{
            $req->validate([
                'name' => 'required',
                'plate' => 'required',
                'mnf_year' => 'required',
                'brand' => 'required',
                'fuel_type' => 'required',
            ]);
        }
        
    }
    public function findId($id){
        $find = Truck::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('truck.index', [
            'data' => Truck::all()
        ]);
    }

    public function create()
    {
        //
        return view('truck.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request, 'store');
        $input = $request->except(['_token']);

        if($request->hasFile('foto')){
            $imageName = time().'_truck.'.$request->foto->extension();
            $request->foto->move('fto_truck', $imageName);
            $input['foto'] = $imageName;
        }


        $truck = Truck::create($input);
        return redirect()->route('truck.index')->with('success','Data Truck telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('truck.edit', 
            ['data' => $this->findId($id)]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);
        $this->validateForm($request, 'update');
        $input = $request->except(['_token','_method']);
        if($request->hasFile('foto')){
            $imageName = time().'_truck.'.$request->foto->extension();
            $request->foto->move('fto_truck', $imageName);
            $input['foto'] = $imageName;
            
            File::delete('fto_truck/'.$oldData->foto);
        }
        
        $truck = Truck::where('id',$id)->update($input);
        
        return redirect()->route('truck.index')->with('success','Data Truck telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('truck.index')->with('deleted','Data Truck terhapus!!');
        
    }
}