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
                    <h1>Serving Size</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Group</a></li>
                        <li class="breadcrumb-item"><a href="#">List</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title"><small>Edit Serving Size</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="servingSizeForm" method="post" action="{{route('serving-size-update')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="size_id" value="{{$servingsize->id}}" />
                                    <label for="servingsizename">Group Name</label>
                                    <input type="text" value="{{$servingsize->name}}" name="name" class="form-control" id="servingsizename"
                                        placeholder="enter serving size">
                                    @error('name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
<!-- AdminLTE App -->
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->
<!-- Page specific script -->
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                alert("Form successful submitted!");
                $('#servingSizeForm')[0].submit();
            }
        });
        $('#servingSizeForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
            },
            messages: {
                name: {
                    required: "Please enter a group name",
                    minlength: "Your group name must be at least 3 characters long",
                    maxlength: "Your group name not exceed than 25 characters"
                },
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
    });
</script>
@endsection