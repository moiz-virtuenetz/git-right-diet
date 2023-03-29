@extends('layouts.app')

@section('links')
<style>
    /* loaded */
</style>
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Group </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Group</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><small>Add Subgroup</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="subgroupForm" method="post" action="{{route('subgroup-store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Group-</label>
                                            <select id="group" name="group" class="form-control select2bs4" style="width: 100%;">
                                                @foreach($groups as $group)
                                                <option value="{{$group->id}}" 
                                                {{ old('group')==$group->id ? 'selected' : '' }}
                                                {{ $group->status ==2 ? "disabled bg-info" : '' }}>
                                                    {{$group->status}}-{{ $group->name}}
                                                </option>
                                                @endforeach
                                                <!-- <option selected="selected">Alabama</option>
                                        <option disabled="disabled">California (disabled)</option> -->
                                            </select>
                                            @error('group')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label for="countasname">Sub Group Name</label>
                                    <input type="text" name="name" class="form-control" id="countasname"
                                        placeholder="enter sub-group name">
                                    @error('name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<script>
    // extra
</script>


<!-- jquery-validation -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE App -->
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->
<!-- Page specific script -->
<script>



    $(function () {

        $('.select2').select2()

        $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

        $.validator.setDefaults({
            submitHandler: function () {
                alert("Form successful submitted!");
                $('#subgroupForm')[0].submit();
            }
        });
        $('#subgroupForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                group: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a group name",
                    minlength: "Your group name must be at least 3 characters long",
                    maxlength: "Your group name not exceed than 25 characters"
                },
                group:{
                    required: "Please select a group"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#group').on('change', function () {
            $('#subgroupForm').validate().element($(this));
        });
    });
</script>
@endsection