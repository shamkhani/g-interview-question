@extends('adminlte::page')

@section('title', 'Manager View')

@section('content_header')
<h1>Manager <small>{{$manager->name}}</small></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">

      <!-- left column -->
      <div class="col-md-12">
        <div>
            <a  class="btn btn-success" href="{{route("news.index")}}"><i class="fa-return fa"></i>Back</a>
            </div>
            <br>
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Manager Detail</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->


            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Manager Name:</label>
              <span  >{{$manager->name}}</span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Manager Name:</label>
              <span  >{{$manager->user->email}}</span>
              </div>
              <div class="form-group mb-0">

                    <label >Status:</label>
                <span > {{$manager->is_active_title}} </span>


              </div>
            </div>

        </div>
        <!-- /.card -->
        </div>
        <div class="card-footer">
          <a href="{{route('news.index')}}" class="btn btn-default">Back</a>
        </div>
  </div>

@stop

@section('css')

@stop
@section('js')
<script>


$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      form.submit();
    }
  });
  $('#branch_form').validate({
    rules: {
      title: {
        required: true,
      },

    },
    messages: {
      title: {
        required: "Please enter a branch name",

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
@stop
