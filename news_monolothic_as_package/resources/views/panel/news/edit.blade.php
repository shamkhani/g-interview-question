@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>Edit <small>News</small></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">News Form</h3>
                    </div>
                    <form method="POST" id="news_form" action="{{ route('news.update',['news'=>$news->id])}}"  role="form"  enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id" >Category</label>
                                <select  required class="form-control"  name="category_id" title="">
                                    <option value="">--- Please choose a category ---</option>
                                    @if($newsCategories)
                                        @foreach($newsCategories as $newsCategory)
                                            <option  {{ $news->category_id == $newsCategory->id ? 'selected' : '' }}
                                                     value="{{$newsCategory->id}}">{{$newsCategory->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input value="{{ $news->title }}"  type="text" name="title" class="form-control"   placeholder="Enter news title" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input  value="{{ $news->slug}}"  type="text" name="slug" class="form-control"  placeholder="Enter news slug" required>
                            </div>
                            <div class="form-group">
                                <label for="short_description">Short description</label>
                                <textarea   class="form-control"  cols="3" rows="2" name="short_description"  title="">{!! $news->short_description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea  class="form-control"  cols="3" rows="5" name="description"  required title="" >{!! $news->description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="external_url" >External Url</label>
                                <input   value="{!!  $news->external_url  !!}" class="form-control"  type="url"
                                         placeholder="e.g. https://news24/de/article/news-slug" name="external_url"
                                         required pattern="^(http|https)://(.*)(/de/article(\/[a-zA-Z]\w*))"  title="External link"/>
                            </div>

                            <div class="form-group">
                                <label for="feature_image">Featured Image</label>
                                <input   type="file" class="form-control"  name="feature_image"    />
                            </div>
                            @if($news->feature_image)
                            <div class="form-group">
                                <img src="{{ Storage::url('images/'. $news->feature_image)}}"  />
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="publish_date" >Publish date</label>
                                <input  value="{{ $news->publish_date }}" class="form-control" type="text"
                                        placeholder="YYYY-MM-DD" required
                                        title="Enter a date in this format YYYY-MM-DD" name="publish_date" required  />
                            </div>
                            <div class="form-group">
                                <label for="tags" >Tags</label>
                                <input class="form-control" placeholder="Separate each tag with comma ',' e.g. great_news,grutto_company" type="text" name="tags" value="{{$news->newsTags}}">

                            </div>
                            <div class="form-group">
                                <label for="status" >Status</label>
                                <select  class="form-control"  name="status" title="">
                                    <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published"  {{ $news->status == 'published' ? 'selected' : '' }}>Publish</option>
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
