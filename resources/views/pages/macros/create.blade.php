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
                    <h1>MACROS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Macro</a></li>
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
                            <h3 class="card-title"> <small>Add Macro</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="macroForm" method="post" action="{{route('macro-store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub-Group</label>
                                            <select name="subgroup" class="form-control select2bs4" style="width: 100%;">
                                                @foreach($subgroups as $group)
                                                <option value="{{$group->id}}" {{ old('subgroup')==$group->id ?
                                                    'selected' : '' }}>{{$group->name}}</option>
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
                                            <label for="macro_name">Macro Name</label>
                                            <input type="text" name="macro_name" class="form-control" id="macro_name" value="{{ old('macro_name') }}"
                                                placeholder="enter group name">
                                            @error('macro_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="carbohydrate">Carbohydrate (grams)</label>
                                            <input type="text" name="carbohydrate" class="form-control" value="{{ old('carbohydrate') }}"
                                                id="carbohydrate" placeholder="enter carbohydrate">
                                            @error('carbohydrate')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="protein">Protein (grams)</label>
                                            <input type="text" name="protein" class="form-control" id="protein" value="{{ old('protein') }}"
                                                placeholder="enter protein">
                                            @error('protein')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fat">Fat (grams)</label>
                                            <input type="text" name="fat" class="form-control" id="fat" value="{{ old('fat') }}"
                                                placeholder="enter fat">
                                            @error('fat')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calories">Calories</label>
                                            <input type="text" name="calories" class="form-control" id="calories" value="{{ old('calories') }}"
                                                placeholder="enter calories">
                                            @error('calories')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="countas">Count as</label>
                                            <input type="text" name="countas" class="form-control" id="countas" value="{{ old('countas') }}"
                                                placeholder="enter count as">
                                            @error('countas')
                                            <small class="text-danger">{{ $message }}</small>
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
<!-- AdminLTE App -->
<!-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> -->
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

        $.validator.setDefaults({
            submitHandler: function () {
                alert("Form successful submitted!");
                $('#macroForm')[0].submit();
            }
        });

        $.validator.addMethod('floatRegex', function (value, element) {
            return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
        }, 'Please enter a valid number with up to 2 decimal places');

        $('#macroForm').validate({
            rules: {
                macro_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 45
                },
                carbohydrate: {
                    required: true,
                    floatRegex: true
                },
                protein: {
                    required: true,
                    floatRegex: true
                },
                fat: {
                    required: true,
                    floatRegex: true
                },
                calories: {
                    required: true,
                    floatRegex: true
                },
                countas:{
                    required: true,
                    minlength: 3,
                    maxlength: 45
                }
            },
            messages: {
                macro_name: {
                    required: "Please enter a group name",
                    minlength: "Your group name must be at least 3 characters long",
                    maxlength: "Your group name not exceed than 25 characters"
                },
                carbohydrate: {
                    required: 'Please enter a number',
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                protein: {
                    required: 'Please enter a number',
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                fat: {
                    required: 'Please enter a number',
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                calories: {
                    required: 'Please enter a number',
                    floatRegex: 'Please enter a valid number with up to 2 decimal places'
                },
                countas:{
                    required: "Please enter a count as",
                    minlength: "Your count as must be at least 3 characters long",
                    maxlength: "Your count as not exceed than 25 characters"
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
    });
</script>
@endsection