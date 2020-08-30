@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>News List Items </h1>
@stop

@section('content')

<div>
<a  class="btn btn-primary" href="{{route("news.create")}}"><i class="fa-plus fa"></i> Create New</a>
<a  class="btn btn-default" href="#" onclick="deleteSelectedItem()"><i class="fa-remove fa"></i> Delete Selected Item</a>
</div>
<br>
<table class="table table-rounded" id="news_table" class="display">
    <thead>
        <tr>
            <th><input type="checkbox" id="chkSelectAll"></th>
            <th>Title</th>
            <th>Category</th>
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
@section('js')
@section('js')
<script>
    function deleteItem(id) {

        if(confirm('Are you sure?')){
            $.ajax({
                url: "{{ url('api/v1/news/') }}"+ "/"+id ,
                method: "DELETE",
                data: { },
                dataType: "json",
                success:function( response ) {
                    alert(response.msg);
                    $('#row_'+id).remove();
                },
                error:function( XMLHttpRequest, textStatus, errorThrow) {
                    console.log(XMLHttpRequest, textStatus, errorThrow)
                }
            });
        }
    }

    $('#chkSelectAll').click(function(event) {
        if(this.checked) {
            $('.chk:checkbox').each(function() {
                this.checked = true;
            });
        }
        else {
            $('.chk:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    $('chk').on('click', function () {

    })
    function deleteSelectedItem() {
        var items=[];
        if(confirm('Are you sure?')){
            $(".chk:checked").each(function(k,v) {
              items.push(this.id);
            });
            console.log(items);
            return;
            $.ajax({
                url: "{{ url('api/v1/news/') }}" ,
                method: "DELETE",
                data: { 'items':items },
                dataType: "json",
                success:function( response ) {
                    $.each(response.data, function (item) {
                        $('#row_'+item).remove();
                    })
                },
                error:function( XMLHttpRequest, textStatus, errorThrow) {
                    console.log(XMLHttpRequest, textStatus, errorThrow)
                }
            });
        }
    }


    function loadData(){
        $.ajax({
            url: "{{ route('news.by.category', ['cid'=>$cid,'slug'=> $slug]) }}",
            method: "GET",
            data: { },
            dataType: "json",
            success:function( response ) {
                $.each(response.data,function(k,v){

                    let row =  '<tr id="row_'+v.id+'">';
                    row += '<td><input class="chk" id='+ v.id +' type="checkbox"  > </td>';
                    row += '<td>'+ v.title +'</td>';
                    row += '<td>'+ v.category_title +'</td>';
                    row += '<td>'+ v.external_url +'</td>';
                    row += '<td>'+ v.publish_date +'</td>';
                    row += '<td>'+ v.created_at +'</td>';
                    row += '<td>'+ v.updated_at +'</td>';
                    row += '<td>'+ v.status +'</td>';
                    row += '<td id="action_col"><a href="#" onclick="deleteItem(\''+ v.id +'\')">Delete</a> | ';
                    row += '<a href="news/'+ v.id +'/edit" ">Edit</a></td>';
                    row += '</tr>';
                    $('#news_table tbody').append(row);
                    console.log(row);


                });
            },
            error:function( XMLHttpRequest, textStatus, errorThrow) {
                console.log(XMLHttpRequest, textStatus, errorThrow)
            }
        });
    }
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadData();
});
</script>
@stop
