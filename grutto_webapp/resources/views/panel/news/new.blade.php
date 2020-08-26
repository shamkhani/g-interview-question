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
          <form method="POST" id="news_form" action="{{ route('news.store')}}"  role="form"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="category_id" >Category</label>
                    <select  required class="form-control"  name="category_id" title="">
                        <option value="">--- Please choose a category ---</option>
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
              <div class="form-group">
                <label for="short_description">Short description</label>
                <textarea   class="form-control"  cols="3" rows="2" name="short_description"  title="">{{old('short_description')}}</textarea>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea  class="form-control"  cols="3" rows="5" name="description"  required title="" >{{old('description')}}</textarea>
              </div>
              <div class="form-group">
                <label for="external_url" >External Url</label>
                <input   value="{!!  old('external_url') !!}" class="form-control"  type="url" placeholder="e.g. https://news24/de/article/news-slug"
                         name="external_url" required pattern="^(http|https)://(.*)(/de/article(\/[a-zA-Z]\w*))"  title="External link"/>
              </div>

              <div class="form-group">
                <label for="feature_image" >Featured Image</label>
                <input  value="{{ old('feature_image')}}" type="file" data-max="8388608" class="form-control"  name="feature_image" required   />
              </div>
              <div class="form-group">
                <label for="publish_date" >Publish date</label>
                <input  value="{{ old('publish_date')}}" class="form-control" type="text"  placeholder="YYYY-MM-DD" required
                        title="Enter a date in this format YYYY-MM-DD" name="publish_date" required   />
              </div>
                <div class="form-group">
                    <label for="tags" >Tags</label>
                    <input type="text"  placeholder="split each tag with comma ',' e.g. great_news,grutto_company" name="tags" value="{{ old('tags')}}">
                </div>
              <div class="form-group">
                <label for="status" >Status</label>
                <select  class="form-control"  name="status" title="">
                  <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                  <option value="publish"  {{ old('status') == 'published' ? 'selected' : '' }}>Publish</option>
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

@stop
