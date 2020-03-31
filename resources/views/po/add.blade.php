@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('po')}}" class="btn btn-sm btn-flat btn-danger "><i class="fa fa-arrow-left"></i> </a>
                </p>
            </div>
            <form role="form" method="post" action="{{url('po/add')}}">
                {{ csrf_field() }}
                <div class="box-body">
                    
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Document_no</label>
                                <input value="{{$docno}}" type="text" name="document_no" class="form-control" id="exampleInputEmail1" placeholder="Document No" readonly>
                            </div>

                            @if (isset($id_supplier))
                            <div class="form-group">
                                <label for="exampleInputEmail1">=Pilih Supplier=</label>
                                <select class="form-control select2" name="supplier">
                                    <option selected="" disabled="">=Pilih Supplier=</option>
                                    @foreach($supplier as $sp)
                                        
                                        <option value="{{$sp->id}}" {{ ($id_supplier == $sp->id) ? 'selected':'' }}>{{$sp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="exampleInputEmail1">=Pilih Supplier=</label>
                                <select class="form-control select2" name="supplier">
                                    <option selected="" disabled="">=Pilih Supplier=</option>
                                    @foreach($supplier as $sp)
                                        
                                        <option value="{{$sp->id}}">{{$sp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                        </div>
                    <!-- /.box-body -->
        
                        
                        
                        @if(isset($produk))
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table myTable">
                                    <thead>
                                        
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Harga Beli</th>
                                        <th>Qty Beli</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $e=>$pd)
                                        <tr>
                                            
                                            <td>{{$e+1}}</td>
                                            <td>{{$pd->nama}}</td>
                                            <td>{{number_format($pd->buy,0)}}</td>
                                            <td>
                                                <input type="hidden" name="produk[]" value="{{ $pd->id }}">
                                                <input type="number" value="0" class="form-control" name="qty[]" requred>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        @endif
                    </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                </form>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
        
        $("select[name='supplier']").change(function(e){
            var id_supplier = $(this).val();
            var url = "{{url('po/produk')}}"+'/'+id_supplier;

            window.location.href=url;
        })
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection