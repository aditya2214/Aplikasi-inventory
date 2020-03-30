@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('produk')}}" class="btn btn-sm btn-flat btn-danger "><i class="fa fa-arrow-left"></i> </a>
                </p>
            </div>
            <div class="box-body">
               <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Barcode</th>
                            <td>:</td>
                            <td><img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($dt->kode, 'QRCODE')}}" alt="barcode" style="width: 80px;" /></td>

                            <th>Nama Produk</th>
                            <td>:</td>
                            <td>{{$dt->nama}}</td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td>:</td>
                            <td>{{$dt->supplier_r->nama}}</td>

                            <th>Kode Produk</th>
                            <td>:</td>
                            <td>{{$dt->kode}}</td>

                        </tr>
                        <tr>
                            <th>Stock Produk</th>
                            <td>:</td>
                            <td>{{$dt->stock}}</td>

                            <th>Minimal Stock</th>
                            <td>:</td>
                            <td>{{$dt->minimal_stock}}</td>
                        </tr>
                        <tr>
                            <th>Create_at</th>
                            <td>:</td>
                            <td>{{$dt->created_at}}</td>

                            <th>Updated_at</th>
                            <td>:</td>
                            <td>{{$dt->updated_at}}</td>
                        </tr>
                        <tr>
                            <th>Harga Beli Produk</th>
                            <td>:</td>
                            <td>{{number_format($dt->buy,0)}}</td>

                            <th>Harga Jual Produk</th>
                            <td>:</td>
                            <td>{{number_format($dt->harga,0)}}</td>
                        </tr>
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection