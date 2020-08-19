@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
<h1>Manager  <small>{{$news->title}}</small></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">News Form</h3>
          </div>
          <form method="POST" id="news_form" action="{{ route('news.update',['news'=>$news->id])}}"  role="form" novalidate="novalidate">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card-body">
              <div class="form-group">
                <label for="name">Title</label>
                <input   type="text" name="name" class="form-control"  value="{{$news->title}}" placeholder="Enter news title" required>
              </div>
              <div class="form-group">
                <label for="name">Slug</label>
                <input   type="text" name="slug" class="form-control" value="{{$news->slug}}" placeholder="Enter news slug" required>
              </div>
              <div class="form-group">
                <label for="short_description">Short description</label>
                  <textarea cols="3" rows="3" name="short_description" >{!! $news->short_description !!}</textarea>
              </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea cols="3" rows="3" name="description" >{!! $news->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="external_link" >External Url</label>
                    <input value="{{ $news->external_link }}" type="text" placeholder="e.g. www.news24/de/article/news-slug" name="external_link" required pattern="/^de/article\/[a-zA-Z]\w*/i"  title="External link"/>
                </div>
              <div class="form-group">
                <label for="publish_date" >Publish date</label>
                <input type="text" name="publish_date" required value="{{ $news->publish_date }}"  />
              </div>
              <div class="form-group">
                <label for="publish_date" >Publish date</label>
                <select id="status">
                  <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                  <option value="publish" {{ $news->status == 'publish' ? 'selected' : '' }}>Publish</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="button" class="btn btn-primary">Submit</button>
              <a href="{{route('news.index')}}" class="btn btn-default">Back</a>
            </div>
          </form>
        </div>
        </div>
      <div class="col-md-6">
      </div>
    </div>
  </div>

@stop

@section('css')

@stop
@section('js')
<script>


$(document).ready(function () {


  $.validator.setDefaults({

    submitHandler: function (form) {
      //console.log('ok');
      form.submit();
    }
  });
  $('#news_form').validate({
    rules: {
      title: {
        required: true,
      },
      slug: {
        required: true,
      },

        description: {
            required: true,
        },
    },
    messages: {
      title: {
        required: "Please enter a title",
      },
      slug: {
        required: "Please enter a slug",
      },
      description: {
        required: "Please enter a description",
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
