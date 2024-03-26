<?php

namespace App\Http\Controllers\Web;

use App\Models\{Visit, Customer, Tracking};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use File;
class VisitWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'customer_id' => 'required',
            'tracking_id' => 'required',
            'photo_url' => 'required',
            'description' => 'required'
        ]);
    }
    public function findId($id){
        $find = Visit::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('visit.index', [
            'data' => Visit::leftJoin('customers', 'visits.customer_id', 'customers.id')
                        ->leftJoin('trackings', 'visits.tracking_id', 'trackings.id')
                        ->select('visits.*', 'customers.name AS customer_name', 'trackings.act_date AS act_date')
                        ->orderBy('visits.created_at', 'desc')
                        ->get()
        ]);
    }

    public function create()
    {
        //
        return view('visit.create',
            [
                'customer' => Customer::all(),
                'tracking' => Tracking::all()
            ]
        );
    }

    
    public function store(Request $request)
    {
        //
        // dd($request);
        $this->validateForm($request);
        $input = $request->except(['_token']);

        if($request->hasfile('photo_url')){
            $fileName = time().'_'.$request->photo_url->getClientOriginalName();
            // dd($fileName);
            $path = $request->photo_url->storeAs('gambar', $fileName);
            $input['photo_url'] = $fileName;
            // dd($input['photo_url']);
        }
        // dd($input);
        $tracking = Visit::create($input);
        return redirect()->route('visit.index')->with('success','Data Visit telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('visit.edit', 
            [
                'data' => $this->findId($id),
                'customer' => Customer::all(),
                'tracking' => Tracking::all()
            ]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);
        // $this->validateForm($request);
        $input = $request->except(['_token','_method']);

        if($request->photo_url == null){
            $this->validate($request, [
                'customer_id' => 'required',
                'tracking_id' => 'required',
                'description' => 'required'
            ]);
            $updateData = Visit::where('id', $id)->update($input);
            return redirect()->route('visit.index')->with('success','Data Visit telah diperbaharui!!');
        }else{
            $this->validateForm($request);
            if(is_file($request->photo_url)){
                $fileName = time().'_'.$request->photo_url->getClientOriginalName();
                    // dd($fileName);
                $path = $request->photo_url->storeAs('gambar', $fileName);
                $input['photo_url'] = $fileName;

                File::delete('gambar/'.$oldData->photo_url);
                $updateData = Visit::where('id', $id)->update($input);
            return redirect()->route('visit.index')->with('success','Data Visit telah diperbaharui!!');
            }
        }
        
        
        
        
    }

   
    public function destroy($id)
    {
        //
        $oldData = $this->findId($id);
        Storage::delete('gambar/'.$oldData->photo_url);
        $this->findId($id)->delete();
        return redirect()->route('visit.index')->with('deleted','Data Visit terhapus!!');
        
    }
}