@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
  <h1>Add New  <small>News</small></h1>
@stop

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">News Form</h3>
          </div>
          <form method="POST" id="news_form" action="{{ route('news.store')}}"  role="form" novalidate="novalidate">
            {{ csrf_field() }}
            <div class="card-body">

                <div class="form-group">
                    <label for="news_category" >Publish date</label>
                    <select  class="form-control"  name="news_category" title="">
                        <option value="">--- Please choose a category ---</option>
                        @if($newsCategories)
                            @foreach($newsCategories as $newsCategory)
                                <option value="{{$newsCategory->title}}">{{$newsCategory->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
              <div class="form-group">
                <label for="name">Title</label>
                <input   type="text" name="name" class="form-control"   placeholder="Enter news title" required>
              </div>
              <div class="form-group">
                <label for="name">Slug</label>
                <input   type="text" name="slug" class="form-control"  placeholder="Enter news slug" required>
              </div>
              <div class="form-group">
                <label for="short_description">Short description</label>
                <textarea   class="form-control"  cols="3" rows="2" name="short_description"  title=""></textarea>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea  class="form-control"  cols="3" rows="5" name="description" title="" ></textarea>
              </div>
              <div class="form-group">
                <label for="external_link" >External Url</label>
                <input  class="form-control"  value="" type="text" placeholder="e.g. www.news24/de/article/news-slug" name="external_link" required pattern="/^de/article\/[a-zA-Z]\w*/i"  title="External link"/>
              </div>
              <div class="form-group">
                <label for="publish_date" >Publish date</label>
                <input  class="form-control"  type="datetime-local" name="publish_date" required value=""  />
              </div>
              <div class="form-group">
                <label for="publish_date" >Publish date</label>
                <select  class="form-control"  name="status" title="">
                  <option value="draft">Draft</option>
                  <option value="publish">Publish</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
