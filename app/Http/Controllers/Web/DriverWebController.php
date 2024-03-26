<?php

namespace App\Http\Controllers\Web;

use App\Models\Driver;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DriverWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'user_name'=> 'required',
            'name'=> 'required',
            'password'=>'required',
            'phone'=>'required'
        ]);
    }
    public function findId($id){
        $find = Driver::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('driver.index', ['data' => Driver::all()]);
    }

    public function create()
    {
        //
        return view('driver.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $input['password'] = bcrypt($request->password); 
        $driver = Driver::create($input);
        return redirect()->route('driver.index')->with('success','Data Driver telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('driver.edit', 
            ['data' => $this->findId($id)]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);

         $validate = $this->validate($request, [
            'user_name'=> 'required',
            'name'=> 'required',
            // 'password'=>'required',
            'phone'=>'required'
            // 'password' => 'required',
            
        ]);
        $input = $request->except(['_token','_method']);
        $input['password'] = $request->password == '' ? $oldData->password : bcrypt($request->password);
        
        $driver = Driver::where('id',$id)->update($input);
        
        return redirect()->route('driver.index')->with('success','Data Driver telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('driver.index')->with('deleted','Data Driver terhapus!!');
        
    }
}