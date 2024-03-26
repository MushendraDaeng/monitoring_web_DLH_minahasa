<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\{Customer, SubKategori, Kategori, SubscriptionReport};
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersImport;

class CustomerWebController extends Controller
{
    public function validateForm($req){
        $req->validate([
            'id_kategori' => 'required',
            'id_sub_kategori' => 'required',
            'name' => 'required',
            'urban_village' => 'required',
            'sub_district' => 'required',
            'status' => 'required',
            'tarif' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
    }
    public function findId($id){
        $find = Customer::find($id);
        return $find;
    }
    public function index()
    {
        //
        return view('customer.index', ['data' => 
            Customer::leftJoin('kategoris', 'customers.id_kategori', 'kategoris.id')
                    ->leftJoin('sub_kategoris', 'customers.id_sub_kategori', 'sub_kategoris.id')
                    ->select('customers.*', 'kategoris.category_name AS kategori', 'sub_kategoris.subcategory_name as sub_kategori')
                    ->get()
        ]);
    }

    public function createSubscription($id)
    {
        //
        return view('customer.create-subscription', [
            'customer' => Customer::all(),
            'id' => $id
        ]);
    }

    public function storeSubscription(Request $request)
    {
        //
        $request->validate([
            'customer_id' => 'required',
            'total_payment' => 'required',
            'payment_date' => 'required',
        ]);
        $input = $request->except(['_token']);
        $subcriptionreport = SubscriptionReport::create($input);
        return redirect()->route('customer.show', $request->customer_id)->with('success','Data Subcription Report telah tersimpan!!');
        
    }

    public function create()
    {
        //
        $kategori = Kategori::all();
        $subKategori = SubKategori::all();
        return view('customer.create',
            [
                'kategori' => $kategori,
                'subKategori' => $subKategori
            ]
        );
    }

    
    public function store(Request $request)
    {
        //
        $this->validateForm($request);
        $input = $request->except(['_token']);
        $customer = Customer::create($input);
        return redirect()->route('customer.index')->with('success','Data Customer telah tersimpan!!');
        
    }

    public function show($id)
    {
        $kategori = Kategori::all();
        $subKategori = SubKategori::all();
        return view('customer.show', 
            [
                'data' => $this->findId($id),
                'kategori' => $kategori,
                'subKategori' => $subKategori,
                'subcription_report' => SubscriptionReport::leftJoin('customers', 'subscription_reports.customer_id', 'customers.id')
                        ->where('subscription_reports.customer_id', $id)
                        ->select('subscription_reports.*','customers.name AS customer_name')
                        ->orderBy('created_at','desc')
                        ->get()
            ]
        );
    }

    public function edit($id)
    {
        //
        $kategori = Kategori::all();
        $subKategori = SubKategori::all();
        return view('customer.edit', 
            [
                'data' => $this->findId($id),
                'kategori' => $kategori,
                'subKategori' => $subKategori
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
        
        $customer = Customer::where('id',$id)->update($input);
        
        return redirect()->route('customer.index')->with('success','Data Customer telah diperbaharui!!');
    }

    public function destroySubs($id, $idSubs)
    {
        //
        SubscriptionReport::find($idSubs)->delete();

        return redirect()->route('customer.show',$id)->with('deleted','Data Subcription Report terhapus!!');
        
    }

   
    public function destroy($id)
    {
        //
        $this->findId($id)->delete();
        return redirect()->route('customer.index')->with('deleted','Data Customer terhapus!!');
        
    }

    public function importCustomers(Request $request){
        try {
            // dd($request);
            Excel::import(new CustomersImport, $request->fileCSV);
        
            return response()->json([
                'success'=> true,
                'message' => 'Data berhasil diimport!',
                // 'data' => $data
            ], 200);
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'error' => $e,
            ], 422);
        }
    }
}