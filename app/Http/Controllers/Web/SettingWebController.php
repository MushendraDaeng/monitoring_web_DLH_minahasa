<?php

namespace App\Http\Controllers\Web;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingWebController extends Controller
{
   public function validateForm($req){
        $req->validate([
            'ops_name'=> 'required',
            'status'=> 'required',
            'values'=> 'required',
            'unit'=>'required'
        ]);
    }
    public function findId($id){
        $find = Setting::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('setting.index', ['data' => Setting::all()]);
    }

    public function create()
    {
        //
        return view('setting.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $setting = Setting::create($input);
        return redirect()->route('setting.index')->with('success','Data Setting telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('setting.edit', 
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
        
        $setting = Setting::where('id',$id)->update($input);
        
        return redirect()->route('setting.index')->with('success','Data Setting telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('setting.index')->with('deleted','Data Setting terhapus!!');
        
    }
}