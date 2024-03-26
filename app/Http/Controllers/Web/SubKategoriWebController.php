<?php

namespace App\Http\Controllers\Web;

use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubKategoriWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'subcategory_name'=> 'required'
        ]);
    }
    public function findId($id){
        $find = SubKategori::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('subkategori.index', ['data' => SubKategori::all()]);
    }

    public function create()
    {
        //
        return view('subkategori.create');
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $input['password'] = bcrypt($request->password); 
        $subkategori = SubKategori::create($input);
        return redirect()->route('sub-kategori.index')->with('success','Data SubKategori telah tersimpan!!');
        
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
        return view('subkategori.edit', 
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
        
        $subkategori = SubKategori::where('id',$id)->update($input);
        
        return redirect()->route('sub-kategori.index')->with('success','Data SubKategori telah diperbaharui!!');
    }

   
    public function destroy($id)
    {
        $this->findId($id)->delete();
        return redirect()->route('sub-kategori.index')->with('deleted','Data SubKategori terhapus!!');
        
    }
}