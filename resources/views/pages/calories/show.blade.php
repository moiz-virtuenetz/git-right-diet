@extends('layouts.app')

@section('links')
    <style>
        /* loaded */
    </style>
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

                        {{-- <div class="bg-white p-2 pb-3 border rounded-top shadow-md d-flex justify-content-between">
                            <div class="card-title"><small>All Calories</small></div>
                            <div class="card-title bg-info"><small>All Calories</small></div>
                        </div> --}}
                        <div class="card">
                            <div class="p-2 pb-3 border-bottom d-flex justify-content-between">
                                <div class="card-title"><small>All Calories</small></div>
                                <div class="card-title">
                                    <a href="{{ route('calories-edit', $calorie_with_details->id) }}" target="_self">
                                        <button class="btn btn-sm btn-info"> Edit </button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="font-weight-bold">Calorie Name</h6>
                                        <p class="text-sm">{{ $calorie_with_details->name }}</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="font-weight-bold">Serving Size</h6>
                                        <p class="text-sm">
                                            @if (isset($calorie_with_details->servingsize))
                                                {{ $calorie_with_details->servingsize->name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="font-weight-bold">Macro</h6>
                                        <p class="text-sm">
                                            @if (isset($calorie_with_details->macro))
                                                {{ $calorie_with_details->macro->name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="font-weight-bold">Sub Group</h6>
                                        <p class="text-sm">
                                            @if (isset($calorie_with_details->subgroup))
                                                {{ $calorie_with_details->subgroup->name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h6 class="font-weight-bold">Count as</h6>

                                        <table class="text-sm table table-sm">
                                            <tbody>
                                                @foreach ($calorie_with_details->calCaloriesField as $countas)
                                                    <tr>
                                                        <td>
                                                            {{ $countas->m_qty }}
                                                        </td>
                                                        <td>
                                                            @if (isset($countas->calCountas))
                                                                {{ $countas->calCountas->countas }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">

                                    </div>
                                </div>
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
@endsection
