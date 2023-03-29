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
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>-</th>
                                            <th>Calorie Name</th>
                                            <th>Serving</th>
                                            <th>Count as</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cal_num = 0;
                                        @endphp
                                        @foreach ($allGroups as $allgroup)
                                            <tr>
                                                <td colspan="6" class="text-danger text-center bg-primary"><small>GROUP :
                                                        {{ $allgroup->name }}</small>
                                                </td>
                                            </tr>
                                            {{-- SUB GROUP --}}
                                            @foreach ($allgroup->calSubgroup as $allsubgroup)
                                                <tr>
                                                    <td colspan="6" class="text-danger text-center bg-info">
                                                        <small>SUB-GROUP :
                                                            {{ $allsubgroup->name }}</small>
                                                    </td>
                                                </tr>
                                                {{-- after subgroup calories --}}
                                                {{-- CALORIES --}}
                                                @foreach ($allsubgroup->calCalorieList as $allcalorie)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected[]"
                                                                value="{{ $allcalorie->id }}-{{ $allcalorie->name }}"
                                                                id="checkbox{{ $loop->iteration }}" class="item-checkbox">
                                                        </td>
                                                        <td colspan="2" class="text-danger text-center bg-light">
                                                            <small>Calorie :
                                                                {{ $allcalorie->name }}</small>
                                                        </td>
                                                        <td colspan="" class="text-danger text-center bg-light">
                                                            @if (isset($allcalorie->calServingSize))
                                                                <small>Calorie :
                                                                    {{ $allcalorie->calServingSize->name }}</small>
                                                            @endif
                                                        </td>
                                                        <td colspan="" class="text-danger text-center bg-light">
                                                            {{-- COUNTAS --}}
                                                            @php
                                                                $thiscal = 0;
                                                            @endphp
                                                            @foreach ($allcalorie->calCaloriesField as $allcountas)
                                                                <small>Countas {{ $allcountas->m_qty }}</small>
                                                                @if (isset($allcountas->calCountas))
                                                                    @php
                                                                        $thiscal += $allcountas->m_qty * $allcountas->calCountas->calories;
                                                                    @endphp
                                                                    <small>
                                                                        {{ $allcountas->calCountas->countas }}</small>
                                                                @endif
                                                                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{ $thiscal }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                {{-- MACRO --}}
                                                {{-- @if (count($allsubgroup->calMacro) > 0) --}}
                                                @foreach ($allsubgroup->calMacro as $allmacro)
                                                    <tr>
                                                        <td colspan="6" class="text-danger text-center bg-warning">
                                                            <small>MACRO :
                                                                {{ $allmacro->name }}</small>
                                                        </td>
                                                    </tr>
                                                    {{-- CALORIES --}}
                                                    @foreach ($allmacro->calCalorieList as $allcalorie)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="selected[]"
                                                                    value="{{ $allcalorie->id }}-{{ $allcalorie->name }}"
                                                                    id="checkbox{{ $loop->iteration }}"
                                                                    class="item-checkbox">
                                                            </td>
                                                            <td colspan="2" class="text-danger text-center bg-light">
                                                                <small>Calorie :
                                                                    {{ $allcalorie->name }}</small>
                                                            </td>
                                                            <td colspan="" class="text-danger text-center bg-light">
                                                                @if (isset($allcalorie->calServingSize))
                                                                    <small>Calorie :
                                                                        {{ $allcalorie->calServingSize->name }}</small>
                                                                @endif
                                                            </td>
                                                            <td colspan="" class="text-danger text-center bg-light">
                                                                {{-- COUNTAS --}}
                                                                @php
                                                                    $thiscal = 0;
                                                                @endphp
                                                                @foreach ($allcalorie->calCaloriesField as $allcountas)
                                                                    <small>Countas {{ $allcountas->m_qty }}</small>
                                                                    @if (isset($allcountas->calCountas))
                                                                        @php
                                                                            $thiscal += $allcountas->m_qty * $allcountas->calCountas->calories;
                                                                        @endphp
                                                                        <small>
                                                                            {{ $allcountas->calCountas->countas }}</small>
                                                                    @endif
                                                                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{ $thiscal }}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                {{-- @else --}}
                                                
                                                {{-- @endif --}}
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>-</th>
                                            <th>Calorie Name</th>
                                            <th>Serving</th>
                                            <th>Count as</th>
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

    <script>
        $(document).ready(function() {
            $('.item-checkbox').click(function() {
                var selectedValues = [];
                var sumCalories = 0;
                $('.item-checkbox:checked').each(function() {
                    var row = $(this).closest('tr');
                    var name = row.find('td:eq(1)').text().trim().replace(/\s+/g,
                        ' ');; // Replace 0 with the index of the column containing the name
                    var description = row.find('td:eq(2)').text().trim().replace(/\s+/g,
                        ' '); // Replace 1 with the index of the column containing the description
                    var calorie = row.find('td:eq(4)').text().trim().replace(/\s+/g,
                        ' '); // Replace 1 with the index of the column containing the description
                    selectedValues.push(name + ' - ' + description);
                    sumCalories += parseInt(calorie);
                });
                console.log(selectedValues);
                console.log(sumCalories);
            });
        });
    </script>
@endsection
