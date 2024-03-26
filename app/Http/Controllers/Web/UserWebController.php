<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserWebController extends Controller
{
    
    public function validateForm($req){
        $req->validate([
            'name'=> 'required',
            'email'=> 'required',
            'password'=>'required'
        ]);
    }
    public function findId($id){
        $find = User::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('user.index', ['data' => User::all()]);
    }

    public function create()
    {
        //
        return view('user.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $input['password'] = bcrypt($request->password); 
        $user = User::create($input);
        return redirect()->route('user.index')->with('success','Data User telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('user.edit', 
            ['data' => $this->findId($id)]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request->password == '');
        $oldData = $this->findId($id);

         $validate = $this->validate($request, [
            'email'=> 'required',
            'name'=> 'required',
            
        ]);
        $input = $request->except(['_token','_method']);
        $input['password'] = $request->password == '' ? $oldData->password : bcrypt($request->password);
        
        $user = User::where('id',$id)->update($input);
        
        return redirect()->route('user.index')->with('success','Data User telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('user.index')->with('deleted','Data User terhapus!!');
        
    }
}
