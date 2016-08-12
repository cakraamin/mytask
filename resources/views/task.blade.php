@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks Manager</div>

                <div class="panel-body">                    
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ URL('task/create') }}"><button class="btn btn-success">New Tasks</button></a><hr/>
                            <table id="users-table" class="table table-condensed">                                
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Mark Complete</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                    
@endsection

@section('js')
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("task/basic-data") }}'
        });
    });

    function ubah(id,val){
        $.get( "task/ubah/"+id+"/"+val, function( data ) {          
            if(data == 'ok'){
                alert('Mark Success');
            }else{
                alert('Mark Failed');
            }
        });
    }
@endsection
