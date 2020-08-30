@extends('adminlte::page')

@section('title', 'News Category')

@section('content_header')
    <h1>News Category List</h1>
@stop

@section('content')

<div>
<a  class="btn btn-primary" href="{{route('categories.create')}}"><i class="fa-plus fa"></i> Create New</a>

<a  class="btn btn-default" href="#" onclick="deleteSelectedItem()"><i class="fa-remove fa"></i> Delete Selected Item</a>
</div>
<br>
<ul id="news_list">

</ul>
<table class="table table-rounded" id="news_cat_table" class="display">
    <thead>
        <tr>
            <th><input type="checkbox" id="chkSelectAll"></th>
            <th>Title</th>
            <th>Parent</th>
            <th>Slug</th>
            <th>News</th>
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
<script>

    /**
     * Delete an item
     * @param id
     */
    function deleteItem(id) {
        if(confirm('Are you sure?')){
            $.ajax({
                url: "{{ url('api/v1/news/categories/') }}"+ "/"+id ,
                method: "DELETE",
                data: { },
                dataType: "json",
                success:function( response ) {
                    alert(response.msg);
                    $('#row_'+id).remove();
                },
                error:function( XMLHttpRequest, textStatus, errorThrow) {
                    alert(XMLHttpRequest.responseJSON.msg);
                    console.log(XMLHttpRequest, textStatus, errorThrow)
                }
            });
        }
    }

    /**
     * Check all checkboxes
     */
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

    /**
     *  Delete Selected items
     */
    function deleteSelectedItem() {
        var items=[];
        if(confirm('Are you sure?')){
            $(".chk:checked").each(function(k,v) {
                items.push(this.id);
            });
            $.ajax({
                url: "{{ url('api/v1/news/categories') }}" ,
                method: "DELETE",
                data: { 'ids':items },
                dataType: "json",
                success:function( response ) {
                    alert(response.msg);
                    $.each(response.data, function (k,v) {
                        $('#row_'+v).remove();
                    })
                },
                error:function( XMLHttpRequest, textStatus, errorThrow) {
                    alert(XMLHttpRequest.responseJSON.msg);
                    console.log(XMLHttpRequest, textStatus, errorThrow)
                }
            });
        }
    }

    /**
     * Load Data into list
     */
    function loadData(){
        $.ajax({
            url: "{{ url('api/v1/news/categories') }}",
            method: "GET",
            data: { },
            dataType: "json",
            success:function( response ) {
                $.each(response.data,function(k,v){
                    console.log(v.news);
                    let row =  '<tr id="row_'+v.id+'">';
                    row += '<td><input class="chk" id='+ v.id +' type="checkbox"  > </td>';
                    row += '<td><a href="/panel/news/category/'+ v.id +'/'+ v.slug +'">'+ v.title +'</a></td>';
                    row += '<td>'+ v.category_title +'</td>';
                    row += '<td>'+ v.slug +'</td>';
                    row += '<td>'+ v.news.length +'</td>';
                    row += '<td id="action_col"><a href="#" onclick="deleteItem(\''+ v.id +'\')">Delete</a> | ';
                    row += '<a href="categories/'+ v.id +'/edit" >Edit</a></td>';
                    row += '</tr>';
                    $('#news_cat_table tbody').append(row);
                });
            },
            error:function( XMLHttpRequest, textStatus, errorThrow) {
                console.log(XMLHttpRequest, textStatus, errorThrow)
            }
        });

    }



    $(document).ready( function () {

        /**
         * Load News when select an category
         */
        $(document).on('click', "input[class='chk']", function (event) {
            alert("Category with id:"+ event.target.id + " selected");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        loadData();

    });
</script>
@stop
