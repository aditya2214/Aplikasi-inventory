@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('po/add')}}" class="btn btn-sm btn-flat btn-success"><i class="fa fa-plus"></i> Tambah Data PO</a>
                </p>
            </div>
            <div class="box-body">
               <div class="table_reponsive">
                    <table class="table table-stripped myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>delete</th> -->
                                <th>Detail</th>
                                <th>Approved</th>
                                <th>Document No</th>
                                <th>Supplier</th>
                                <th>Total Item</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $e=>$dt)
                                <tr>
                                    <td>{{$e+1}}</td>
                                    <!-- <td>
                                        <a href="{{url('po/hapus/'.$dt->id)}}">
                                            <i class="fa fa-trash btn-danger"></i>
                                        </a>
                                    </td> -->
                                    <td>
                                        <a href="{{url('po/'.$dt->id)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('po/approved/'.$dt->id)}}">
                                            <i class="fa fa-paint-brush"></i>
                                        </a>
                                    </td>
                                    <td>{{$dt->document_no}}</td>
                                    <td>{{$dt->suppliers->nama}}</td>
                                    <td>{{$dt->line_count}}</td>
                                    <td>{{number_format($dt->grand_total(),0)}}</td>
                                    @if($dt->status==1)
                                    <td>
                                        <label class="label label-warning" >{{$dt->statuss->nama}}</label>
                                    </td>
                                    @else
                                    <td>
                                        <label class="label label-success" >{{$dt->statuss->nama}}</label>
                                    </td>
                                    @endif
                                    <td>{{date('d M Y',strtotime($dt->created_at))}}</td>
                                </tr>
                            @endforeach
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