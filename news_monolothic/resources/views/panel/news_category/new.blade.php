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
          <form method="POST" id="news_category_form" action="{{ route('categories.store')}}"  role="form" >
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="category_id" >Parent Category</label>
                    <select  class="form-control"  name="category_id" title="">
                        <option value="">--- Please choose Parent ---</option>
                        @if($newsCategories)
                            @foreach($newsCategories as $newsCategory)
                                <option  {{ old('category_id') == $newsCategory->id ? 'selected' : '' }} value="{{$newsCategory->id}}">{{$newsCategory->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
              <div class="form-group">
                <label for="name">Title</label>
                <input value="{{ old('title')}}"  type="text" name="title" class="form-control"   placeholder="Enter news title" required>
              </div>
              <div class="form-group">
                <label for="name">Slug</label>
                <input  value="{{ old('slug')}}"  type="text" name="slug" class="form-control"  placeholder="Enter news slug" required>
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

@stop
