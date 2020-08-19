@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>News List</h1>
@stop

@section('content')

<div>
<a  class="btn btn-primary" href="{{route("news.create")}}"><i class="fa-plus fa"></i> Create New</a>
</div>
<br>
<table class="table table-rounded" id="news_table" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Short description</th>
            <th>External Url</th>
            <th>Publish date</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>


    </tbody>

</table>
@stop

@section('css')

@stop
@section('plugins.Datatables', true)
@section('js')
<script>

$(document).ready( function () {



    $('#news_table tbody').
});
</script>
@stop
