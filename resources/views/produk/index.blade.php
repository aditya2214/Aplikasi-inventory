@extends('layouts.master')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('produk/add')}}" class="btn btn-sm btn-flat btn-success"><i class="fa fa-plus"></i> Tambah Data Produk</a>
                    <button class="btn btn-sm btn-flat btn-danger delete_all" data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected</button>
                </p>
            </div>
            <div class="box-body">
               <div class="table-reponsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>#</th>
                            <th>Supplier</th>
                            <th>Nama Produk</th>
                            <th>Kode Produk</th>
                            <th>Stock Produk</th>
                            <th>Minimal_Stock</th>
                            <th>Harga Beli Produk</th>
                            <th>Harga Jual Produk</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @if($data->count())
                        @foreach ($data as $e=>$dt)
                            <tr id="tr_{{$dt->id}}">
                                <td><input type="checkbox" class="sub_chk" data-id="{{$dt->id}}"></td>
                                <td>{{$e+1}}</td>
                                <td>{{$dt->supplier_r->nama}}</td>
                                <td>{{$dt->nama}}</td>
                                <td>{{$dt->kode}}</td>
                                <td>{{$dt->stock}}</td>
                                <td>{{$dt->minimal_stock}}</td>
                                <td>{{number_format($dt->buy,0)}}</td>
                                <td>{{number_format($dt->harga,0)}}</td>
                                <td>{{$dt->created_at}}</td>
                                <td>{{$dt->updated_at}}</td>
                                <td>
                                    <div style="width:60px">
                                        <a href="{{url('produk/'.$dt->id)}}" class="btn btn-primary btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> 
                                        <button href="{{url('produk/'.$dt->id)}}" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button>
                                        <a href="{{url('produk/detail/'.$dt->id)}}" class="btn btn-primary btn-xs btn-lihat" id="edit"><i class="fa fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif

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

<script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
 
@endsection