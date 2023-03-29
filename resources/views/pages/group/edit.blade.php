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
                    <h1>Group</h1>
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
                            <h3 class="card-title"><small>Edit Group</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="groupForm" method="post" action="{{route('group-update')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="group_id" value="{{$group->id}}" />
                                            <label for="groupname">Group Name</label>
                                            <input type="text" value="{{$group->name}}" name="group_name"
                                                class="form-control" id="groupname" placeholder="enter group name">
                                            @error('group_name')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="carbohydrate">Carbohydrate (grams)</label>
                                                <input type="text" name="carbohydrate" class="form-control" value="{{$group->carbohydrate}}"
                                                    id="carbohydrate" placeholder="enter carbohydrate">
                                                @error('carbohydrate')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="protein">Protein (grams)</label>
                                                <input type="text" name="protein" class="form-control" id="protein" value="{{$group->protein}}"
                                                    placeholder="enter protein">
                                                @error('protein')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fat">Fat (grams)</label>
                                                <input type="text" name="fat" class="form-control" id="fat" value="{{$group->fat}}"
                                                    placeholder="enter fat">
                                                @error('fat')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="calories">Calories</label>
                                                <input type="text" name="calories" class="form-control" id="calories" value="{{$group->calories}}"
                                                    placeholder="enter calories">
                                                @error('calories')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                $('#groupForm')[0].submit();
            }
        });

        $.validator.addMethod('floatRegex', function (value, element) {
            return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
        }, 'Please enter a valid number with up to 2 decimal places');

        $('#groupForm').validate({
            rules: {
                group_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                carbohydrate: {
                    floatRegex: true
                },
                protein: {
                    floatRegex: true
                },
                fat: {
                    floatRegex: true
                },
                calories: {
                    floatRegex: true
                }
            },
            messages: {
                group_name: {
                    required: "Please enter a group name",
                    minlength: "Your group name must be at least 3 characters long",
                    maxlength: "Your group name not exceed than 25 characters"
                },
                carbohydrate: {
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                protein: {
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                fat: {
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                calories: {
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
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