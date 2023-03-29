@extends('layouts.app')

@section('links')
    <style>
        /* loaded */
    </style>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                            <li class="breadcrumb-item active">Validation</li>
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
                                <h3 class="card-title"><small>Add Calories</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="caloriesForm" method="post" action="{{ route('calories-store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 d-none">
                                            {{-- <div class="form-group">
                                                <label>Multiple (.select2-purple)</label>
                                                <div class="select2-purple">
                                                    <select class="select2" name="macros[]" multiple="multiple"
                                                        data-placeholder="Select a State"
                                                        data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                        @foreach ($macros as $macro)
                                                            <option value="{{ $macro->id }}"
                                                                {{ old('macro') == $macro->id ? 'selected' : '' }}>
                                                                {{ $macro->countas }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div> --}}
                                            <!-- /.form-group -->
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub-Group</label>
                                                <select name="subgroup" id="subgroup_id" class="form-control select2bs4"
                                                    style="width: 100%;">
                                                    @foreach ($subgroups as $group)
                                                        <option value="{{ $group->id }}"
                                                            {{ old('subgroup') == $group->id ? 'selected' : '' }}>
                                                            {{ $group->name }}</option>
                                                    @endforeach
                                                    <!-- <option selected="selected">Alabama</option>
                                                                        <option disabled="disabled">California (disabled)</option> -->
                                                </select>
                                                @error('subgroup')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Macro</label>
                                                <select name="macro" id="macro_id" class="form-control select2bs4"
                                                    style="width: 100%;">
                                                    <!-- <option selected="selected">Alabama</option>
                                                                        <option disabled="disabled">California (disabled)</option> -->
                                                </select>
                                                @error('macro')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-none">
                                            <div class="form-group">
                                                <label>Sub-Macro</label>
                                                <select name="submacro" id="submacro_id" class="form-control select2bs4"
                                                    style="width: 100%;">
                                                    <!-- <option selected="selected">Alabama</option>
                                                                        <option disabled="disabled">California (disabled)</option> -->
                                                </select>
                                                @error('submacro')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="food_name">Food</label>
                                                <input type="text" name="food_name" class="form-control" id="food_name"
                                                    value="{{ old('food_name') }}" placeholder="enter food name">
                                                @error('food_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="serving">Serving</label>
                                                                            <input type="text" name="serving" class="form-control"
                                                                                value="{{ old('serving') }}" id="serving" placeholder="enter serving">
                                                                            @error('serving')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                                                        </div>
                                                                    </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Serving Size</label>
                                                <select name="servingsize" id="servingsize" class="form-control select2bs4"
                                                    style="width: 100%;">
                                                    <option value="">---select---</option>

                                                    @foreach ($servingsizes as $size)
                                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                    @endforeach
                                                    <!-- <option selected="selected">Alabama</option>
                                                                                                                    <option disabled="disabled">California (disabled)</option> -->
                                                </select>

                                                <!-- <select name="servingsize" id="servingsize" class="form-control">
                                                                                <option value="">-- Select serving size --</option>
                                                                                <option value="1">Small</option>
                                                                                <option value="2">Medium</option>
                                                                                <option value="3">Large</option>
                                                                              </select> -->
                                                @error('servingsize')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-12" id="addSection">
                                            <div class="row repeatSection">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Macro (Count as)</label>
                                                        <div class="select2-purple">
                                                            <select name="countas[]" class="form-control select2bs4 "
                                                                style="width: 100%;">
                                                                @foreach ($macros as $macro)
                                                                    <option value="{{ $macro->id }}"
                                                                        {{ old('macro') == $macro->id ? 'selected' : '' }}>
                                                                        {{ $macro->countas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="text" name="quantity[]"
                                                            class="form-control quantity" value=""
                                                            placeholder="enter food name">
                                                        @error('quantity')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            </div>
                                        </div>

                                        <span class="btn-sm btn-info text-sm" id="clone_btn">more</span>

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
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <!-- <script src="{{ asset('dist/js/adminlte.min.js') }}"></script> -->
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Page specific script -->

    <script>
        // Code to be executed on page load goes here
        let groupId = $("#subgroup_id").val();

        var macroElement = $('#macro_id');
        var submacElement = $('#submacro_id');

        macroElement.empty();
        submacElement.empty();

        macroElement.append($('<option>', {
            value: "0",
            text: 'no-macro-found'
        }));
        submacElement.append($('<option>', {
            value: "0",
            text: 'no-submacro-found'
        }));

        $('#subgroup_id').on('change', function() {
            let subgroup_id = $(this).val();
            mac_and_submac(subgroup_id);
        });

        function mac_and_submac(groupId) {
            // again make empty to append only options
            macroElement.empty();
            submacElement.empty();
            $.ajax({
                url: "{{ route('calories-get-macro') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    subgroup_id: groupId,
                },
                success: function(response) {
                    if (response.status == 200 || response.status == '200') {
                        $.each(response.macros, function(index, value) {
                            macroElement.append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                        macroElement.append($('<option>', {
                                value: '0',
                                text: 'select empty option '
                            }));
                        $.each(response.submacros, function(index, value) {
                            submacElement.append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                        //
                        if (response.macros.length == 0) {
                            // alert('macro');
                            macroElement.append($('<option>', {
                                value: "0",
                                text: 'no-macro-found'
                            }));
                        }
                        // if (response.submacros.length == 0) {
                        //     alert('submacro');
                        //     submacElement.append($('<option>', {
                        //         value: "",
                        //         text: 'no-submacro-found'
                        //     }));
                        // }
                    } else {
                        macroElement.append($('<option>', {
                            value: "0",
                            text: 'no-macro-found'
                        }));
                        submacElement.append($('<option>', {
                            value: "",
                            text: 'no-submacro-found'
                        }));
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(function() {
            let groupId = $("#subgroup_id").val();
            mac_and_submac(groupId);
        });

        //
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $.validator.setDefaults({

                submitHandler: function() {
                    alert("Form successful submitted!");
                    $('#caloriesForm')[0].submit();
                }
            });



            $('#caloriesForm').validate({
                rules: {
                    subgroup:{
                        required: true
                    },
                    food_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    count_as: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    servingsize: {
                        required: true
                    },
                    'countas[]': {
                        required: true
                    },
                    'quantity[]': {
                        required: true
                    }
                },
                messages: {
                    subgroup:{
                        required : 'Please select a subgroup'
                    },
                    food_name: {
                        required: "Please enter a food name",
                        minlength: "Your food name must be at least 3 characters long",
                        maxlength: "Your food name not exceed than 100 characters"
                    },
                    count_as: {
                        required: "Please enter a count as unit",
                        minlength: "Your count as unit must be at least 3 characters long",
                        maxlength: "Your count as unit not exceed than 100 characters"
                    },
                    servingsize: {
                        required: "Please select a serving size"
                    },
                    'countas[]': {
                        required: "Please select a count as"
                    },
                    'quantity[]': {
                        required: "Please select a quantity"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');;
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#servingsize').on('change', function() {
                $('#caloriesForm').validate().element($(this));
            });



        });
    </script>

    <script>
        // function addmore(){
        $('#clone_btn').click(function() {

            $("#addSection").append(`
            <div class="row repeatSection">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Macro (Count as)</label>
                                                        <div class="select2-purple">
                                                            <select name="countas[]" class="form-control select2bs4 "
                                                                style="width: 100%;">
                                                                @foreach ($macros as $macro)
                                                                    <option value="{{ $macro->id }}"
                                                                        {{ old('macro') == $macro->id ? 'selected' : '' }}>
                                                                        {{ $macro->countas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="text" name="quantity[]"
                                                            class="form-control quantity" value=""
                                                            placeholder="enter food name">
                                                        @error('quantity')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            </div>
             `);

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('input').each(function(index) {
                // Set focus on the input field
                $(this).focus();

                // Check if this is the last input field
                if (index === $('input').length - 1) {
                    // Don't move to the next input field
                    return false;
                }

                // Add a delay before moving to the next input field
                var delay = 1000; // 1 second
                setTimeout(function() {
                    // Remove focus from the input field
                    $(this).blur();

                    // Move to the next input field
                    $('input').eq(index + 1).focus();
                }.bind(this), delay);
            });



        });
    </script>
@endsection
