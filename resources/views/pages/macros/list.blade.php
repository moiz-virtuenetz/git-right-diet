@extends('layouts.app')

@section('links')
<style>
    /* loaded */
</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MACROS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Macro</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><small>All Macros</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Carbohydrate</th>
                                        <th>Protein</th>
                                        <th>Fat</th>
                                        <th>Calories</th>
                                        <th>Count-as</th>
                                        <th>Sub-Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($macros as $index => $macro)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$macro->name}}</td>
                                        <td>{{$macro->carbohydrate}}</td>
                                        <td>{{$macro->protein}}</td>
                                        <td>{{$macro->fat}}</td>
                                        <td>{{$macro->calories}}</td>
                                        <td>{{$macro->countas}}</td>
                                        <td>
                                            @if(isset($macro->subgroup))
                                            {{$macro->subgroup->name}}
                                            @endif
                                        </td>
                                        <td class="d-flex ">
                                            <button class="btn btn-sm btn-info mr-3">
                                                <a href="{{route('macro-edit',$macro->id)}}" target="_self"
                                                    class="text-white">Edit</a>
                                            </button>
                                            <!--  -->
                                            <form method="POST" action="{{ route('macro-status') }}"
                                                id="macroStatusForm">
                                                <div class="d-none">
                                                    @csrf
                                                    <input type="text" id="macro_id" name="macro_id" />
                                                    <input type="text" id="macro_status" name="macro_status" />
                                                </div>
                                            </form>
                                            <!--  -->
                                            @if($macro->status =='1')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="changeStatus('{{$macro->id}}','2')">
                                                Disable
                                            </button>
                                            @elseif($macro->status =='2')
                                            <button class="btn btn-sm btn-success"
                                                onclick="changeStatus('{{$macro->id}}','1')">
                                                Enable
                                            </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Carbohydrate</th>
                                        <th>Protein</th>
                                        <th>Fat</th>
                                        <th>Calories</th>
                                        <th>Count-as</th>
                                        <th>Sub-Group</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<script>
    // extra
</script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<script>
    function changeStatus(id,status) {
        $("#group_id").val(id);
        $("#group_status").val(status);
        $("#groupStatusForm").submit();
    }
</script>
@endsection