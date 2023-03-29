@extends('layouts.app')

@section('links')
    <style>
        /* loaded */
    </style>
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
                <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
                <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> -->
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Calories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
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
                              <h3 class="card-title"><small>All Calories</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Calorie Name</th>
                                            <th>Serving</th>
                                            <th>Macro</th>
                                            <th>SubGroup</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calories as $index => $calorie)
                                            <tr>
                                                <td><small>{{ $loop->index + 1 }}</small></td>
                                                <td colspan="" class="text-danger"><small>{{ $calorie->name }}</small>
                                                </td>
                                                <td colspan="" class="text-danger"><small>
                                                        @if (isset($calorie->servingsize))
                                                            {{ $calorie->servingsize->name }}
                                                        @endif
                                                    </small>
                                                </td>
                                                <td colspan="" class="text-danger"><small>
                                                        @if (isset($calorie->macro))
                                                            {{ $calorie->macro->name }}
                                                        @endif
                                                    </small>
                                                </td>
                                                <td colspan="" class="text-danger"><small>
                                                        @if (isset($calorie->subgroup))
                                                            {{ $calorie->subgroup->name }}
                                                        @endif
                                                    </small>
                                                </td>
                                                <td class="d-flex ">
                                                    <button class="btn btn-sm btn-info mr-3">
                                                        <a href="{{route('calories-show',$calorie->id)}}" target="_self"
                                                            class="text-white">View</a>
                                                    </button>
                                                    {{--  --}}
                                                    <button class="btn btn-sm btn-info mr-3">
                                                        <a href="{{route('calories-edit',$calorie->id)}}" target="_self"
                                                            class="text-white">Edit</a>
                                                    </button>
                                                    <!--  -->
                                                    <form method="POST" action="{{ route('calories-status') }}"
                                                        id="calorieStatusForm">
                                                        <div class="d-none">
                                                            @csrf
                                                            <input type="text" id="calorielist_id" name="calorielist_id" />
                                                            <input type="text" id="calorielist_status" name="calorielist_status" />
                                                        </div>
                                                    </form>
                                                    <!--  -->
                                                    @if($calorie->status =='1')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="changeStatus('{{$calorie->id}}','2')">
                                                        Disable
                                                    </button>
                                                    @elseif($calorie->status =='2')
                                                    <button class="btn btn-sm btn-success"
                                                        onclick="changeStatus('{{$calorie->id}}','1')">
                                                        Enable
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script>
        const selectedData = [];

        // Add event listener to each checkbox
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', (event) => {
                const itemId = checkbox.getAttribute('data-id');

                if (checkbox.checked) {
                    // If checkbox is checked, retrieve the data for the corresponding item
                    const itemData = {
                        id: itemId,
                    };

                    // Add itemData to the selectedData array
                    selectedData.push(itemData);
                } else {
                    // If checkbox is unchecked, remove the corresponding itemData from the selectedData array
                    const index = selectedData.findIndex((item) => item.id === itemId);
                    selectedData.splice(index, 1);
                }

                // Debugging: log the selectedData array to the console
                console.log(selectedData);
            });
        });

        // Send selectedData array to the server via AJAX request
        // ...
    </script>


<script>
    function changeStatus(id,status) {
        $("#calorielist_id").val(id);
        $("#calorielist_status").val(status);
        $("#calorieStatusForm").submit();
    }
</script>

@endsection
