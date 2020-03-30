<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_produk;
use App\Models\M_supplier;
use DB;

class Produk_controller extends Controller
{
     public function index(){
        $title='Daftar Produk';
        $data=M_produk::orderBy('nama','desc')->get();

        return view ('produk.index',compact('title','data'));

     }

    public function add(){
        $title='Tambah Produk';
        $supplier=M_supplier::get();
        $kode=rand();

        return view('produk.add',compact('title','supplier','kode'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'supplier'=>'required',
            'nama'=>'required',
            'kode'=>'required',
            'minimal_stock'=>'required',
            'harga'=>'required',
            'buy'=>'required'
        ]);

        $data=$request->except('_token');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        $data['stock']=0;

        M_produk::insert($data);

        \Session::flash('sukses', 'Data Produk Berhasil Di Tambah');

        return redirect ('produk/add');
        
    }

    public function edit($id){
        $title='Edit Produk';
        $supplier=M_supplier::get();

        $dt=M_produk::findOrFail($id);

        return view('produk.edit', compact('supplier' ,'title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'supplier'=>'required',
            'nama'=>'required',
            'kode'=>'required',
            'minimal_stock'=>'required',
            'harga'=>'required',
            'buy'=>'required'
        ]);

        $data=$request->except('_token','_method');
        // $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');

        M_produk::where('id',$id)->update($data);

        \Session::flash('sukses', 'Data Produk Berhasil DiUpdate');

        return redirect ('produk');
        
    }

    public function delete($id){
        try {
            M_produk::where('id',$id)->delete();
            \Session::flash('sukses','Data Berhasil Dihapus');

        } catch (Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }

        return redirect('produk');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("m_produk")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function detail($id){
        $title='Detail Produk';

        $dt=M_produk::findOrFail($id);

        return view('produk.detail',compact('title','dt'));
    }
}
