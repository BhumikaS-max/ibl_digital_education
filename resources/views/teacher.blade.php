@extends('master')
@section('title', env('APP_NAME').' - Teacher')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading wrapper-content">
        <div class="col-sm-4">
            <h2>Teacher</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <button class="btn btn-primary add_btn">Add new</button>
                <button class="btn btn-primary back_btn"> < Back</button>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight tblIbl">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   id="ibl_table">
                                <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Unique id</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date of Join</th>
                                    <th>Salary per hour</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sr</th>
                                    <th>Unique id</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date of Join</th>
                                    <th>Salary per hour</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight add_content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 id="modelHeading">Add Teacher </h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['method' => 'post', 'id' => 'iblForm', 'name'=>'iblForm', 'class'=>'form-horizontal']) !!}
                        {{ Form::hidden('id', null, ['id' => 'id']) }}
                        <div class="hr-line-dashed"></div>
                        <div class="form-group  row">
                            {{Form::label('full_name', 'Full name', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                {{ Form::text('full_name', null, ['class' => 'form-control', 'id' => 'full_name', 'placeholder'=>'Enter Full name']) }}
                            </div>
                        </div>
                        <div class="form-group  row">
                            {{Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder'=>'Enter Email']) }}
                            </div>
                        </div>
                        <div class="form-group  row pass_row">
                            {{Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                <input id="hide_password" type="hidden" name="hide_password">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('gender', 'Gender', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                <input type="radio" name="gender" value="Male" class="gender" id="gender_m"> Male
                                <input type="radio" name="gender" value="Female" class="gender" id="gender_f"> Female
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('date_of_join', 'Date of Join', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                {{ Form::date('date_of_join', null, ['class' => 'form-control', 'id' => 'date_of_join']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{Form::label('salary_per_hour', 'Salary Per hour', ['class' => 'col-sm-2 col-form-label'])}}
                            <div class="col-sm-10">
                                {{ Form::number('salary_per_hour', null, ['class' => 'form-control', 'id' => 'salary_per_hour']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-sm-offset-12" style="text-align: center;">
                                <input type="reset" value="Clear" id="btnCancel" class="btn btn-white btn-lg">
                                {{ FORM::button('Submit', ['class'=>'btn btn-primary btn-lg','type'=>'button','id'=>'btnSave']) }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                let dataTable = $('#ibl_table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    bPaginate: true,
                    ajax: "{{ route('teacher.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'unique_id'},
                        {data: 'email'},
                        {data: 'full_name'},
                        {data: 'gender'},
                        {data: 'date_of_join'},
                        {data: 'salary_per_hour'},
                        {data: 'action', orderable: false, searchable: false},
                    ]
                });

                $('.add_btn').click(function () {
                    $('#id').val('');
                    $('#iblForm').trigger("reset");
                    $('#modelHeading').html("Add New Record");
                    $(".tblIbl").css('display', 'none');
                    $(".add_content").css('display', 'block');
                    $(".add_btn").css('display', 'none');
                    $(".back_btn").css('display', 'block');
                });

                $(".back_btn").click(function () {
                    $(".tblIbl").css('display', 'block');
                    $(".add_content").css('display', 'none');
                    $(".add_btn").css('display', 'inline-block');
                    $(".back_btn").css('display', 'none');
                });

                $('#btnSave').click(function () {
                    showLoader();
                    $.ajax({
                        url: "{{ route('teacher.store') }}",
                        data: new FormData($('#iblForm')[0]),
                        type: 'post',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            hideLoader();
                            if (response.success) {
                                swal("Success", response.message, "success", {
                                    button: "Ok",
                                });
                                window.location.reload();
                            } else {
                                swal("Error", response.message, "error", {
                                    button: "Ok",
                                });
                            }
                        },
                        error: function (data) {
                            hideLoader();
                            swal("Error", data, "error", {
                                button: "Ok",
                            });
                        }
                    });
                });
                $('body').on('click', '#btnEdit', function () {
                    window.scrollTo(0, 0);
                    let id = $(this).data('id'); //alert(id);
                    let url = "{{ route('teacher.edit', ['id' => ':id']) }}";
                    url = url.replace(':id', id);
                    $(".add_btn").css('display', 'none');
                    $(".pass_row").css('display', 'none');
                    $(".back_btn").css('display', 'block');

                    $.post(url, function (data) {
                        $('#modelHeading').html("Edit Record");
                        $('.add_content').css('display', 'block');
                        $('.tblIbl').css('display', 'none');
                        $('#id').val(data.id);
                        $('#email').val(data.email);
                        $('#full_name').val(data.full_name);
                        if (data.gender == "Male") {
                            $('#gender_m').attr('checked',true);
                        } else {
                            $('#gender_f').attr('checked',true);
                        }
                        $('#hide_password').val(data.password);
                        $('#date_of_join').val(data.date_of_join);
                        $('#salary_per_hour').val(data.salary_per_hour);
                    });
                });

                $('body').on('click', '#btnDelete', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id'); //alert(id);
                    let url = "{{ route('teacher.destroy', ['id' => ':id']) }}";
                    url = url.replace(':id', id);

                    swal({
                        title: 'Are you sure?',
                        text: "It will be deleted permanently!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: 'Yes, delete it!'
                    }, function () {
                        $.ajax({
                            url: url,
                            type: 'delete',
                            dataType: 'json',
                            success: function (response) {
                                if (response.success === true) {
                                    swal('Deleted!', response.message, 'success');
                                    window.location.reload();
                                } else {
                                    swal("Error", response.message, "error", {
                                        button: "Ok",
                                    });
                                }
                            },
                            error: function (data) {
                                console.log(data);
                                swal("Error", data, "error", {
                                    button: "Ok",
                                });
                            }
                        })
                    });
                });
            })
        });
    </script>
@stop
