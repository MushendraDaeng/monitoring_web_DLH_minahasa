<?php

namespace App\Http\Controllers\Web;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KategoriWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'category_name'=> 'required'
        ]);
    }
    public function findId($id){
        $find = Kategori::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('kategori.index', ['data' => Kategori::all()]);
    }

    public function create()
    {
        //
        return view('kategori.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $input['password'] = bcrypt($request->password); 
        $kategori = Kategori::create($input);
        return redirect()->route('kategori.index')->with('success','Data Kategori telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('kategori.edit', 
            ['data' => $this->findId($id)]
        );
    }

   
    public function update(Request $request, $id)
    {
        //
        // dd($request);
        $oldData = $this->findId($id);
        $this->validateForm($request);
        
        $input = $request->except(['_token','_method']);
        
        $kategori = Kategori::where('id',$id)->update($input);
        
        return redirect()->route('kategori.index')->with('success','Data Kategori telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        $this->findId($id)->delete();
        return redirect()->route('kategori.index')->with('deleted','Data Kategori terhapus!!');
        
    }
}