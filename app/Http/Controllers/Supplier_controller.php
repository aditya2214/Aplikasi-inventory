<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_supplier;
use DB;

class Supplier_controller extends Controller
{
    public function index(){
        $title='Master Data Supplier';
        $data=M_supplier::orderBy('nama','asc')->get();

        return view('supplier.index',compact('title','data'));
    }

    public function add(){
        $title='Tambah Data Supplier';

        return view('supplier.add',compact('title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'no_telp'=>'required',
            'alamat'=>'required'
        ]);

        $nilai['nama']=$request->nama;
        $nilai['no_telp']=$request->no_telp;
        $nilai['alamat']=$request->alamat;
        $nilai['created_at']=date('Y-m-d H:i:s');
        $nilai['updated_at']=date('Y-m-d H:i:s');

        M_supplier::insert($nilai);

        \Session::flash('sukses','Data Berhasil DiTambah');

        return redirect ('supplier/add');
    }

    public function edit($id){
        $title='Edit Supplier';
        $dt=M_supplier::findOrFail($id);

        return view('supplier.edit', compact('title','dt'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama'=>'required',
            'no_telp'=>'required',
            'alamat'=>'required'
        ]);

        $nilai['nama']=$request->nama;
        $nilai['no_telp']=$request->no_telp;
        $nilai['alamat']=$request->alamat;
        // $nilai['created_at']=date('Y-m-d H:i:s');
        $nilai['updated_at']=date('Y-m-d H:i:s');

        M_supplier::where('id',$id)->update($nilai);

        \Session::flash('sukses','Data Berhasil DiUpdate');

        return redirect ('supplier');
    }

    public function delete($id){
        try {
            M_supplier::where('id',$id)->delete();
            \Session::flash('sukses','Data Berhasil Dihapus');
        } catch (Exception $e) {
            \Session::flash('gaagl',$e->getMessage());
        }

        return redirect('supplier');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("m_supplier")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}

