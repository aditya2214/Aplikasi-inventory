<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_supplier;
use App\Models\M_produk;

use App\Models\Purchase_order;
use App\Models\Purchase_order_line;


class Po_controller extends Controller
{
    public function add(){
        $title='ADD PO';
        $docno='PO-'.rand();
        $supplier=M_supplier::orderBy('nama','desc')->get();

        return view('po.add',compact('title','docno','supplier'));
    }

    public function store(Request $request){
        try {
            $produk=$request->produk;
            $qty=$request->qty;

            $document_no=$request->document_no;
            $supplier=$request->supplier;

            $id_po=Purchase_order::insertGetId([
                'document_no'=>$document_no,
                'supplier'=>$supplier,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);

            foreach ($qty as $e=>$qt) {
                if($qt==0){
                    continue;
                }

                $dt_produk=M_produk::where('id',$produk[$e])->first();
                $buy=$dt_produk->buy;
                $grand_total=$qt*$buy;

                Purchase_order_line::insert([
                    'purchase_order'=>$id_po,
                    'produk'=>$produk[$e],
                    'qty'=>$qt,
                    'buy'=>$buy,
                    'grand_total'=>$grand_total

                ]);
            }

            \Session::flash('sukses','PO Berhasil Dibuat');
        } catch (Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }

        return redirect()->back();
    }

    public function get_produk($id_supplier){
        $title='ADD PO';
        $docno='PO-'.rand();
        $supplier=M_supplier::orderBy('nama','desc')->get();
        $produk=M_produk::where('supplier',$id_supplier)->get();

        return view('po.add',compact('title','docno','supplier','produk','id_supplier'));
    }
}
