<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function getKategori(){
        $data = Kategori::get();
        return response()->json(['status'=>'success','data'=>$data],200);
    }
}
