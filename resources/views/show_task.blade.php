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
                            <form class="form-horizontal" role="form">                                        
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Title Task</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nama" value="{{ $task->title }}" disabled="disabled">                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">
                                        <textarea name="description" class="form-control" disabled="disabled">{{ $task->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Priority</label>

                                    <div class="col-md-6">
                                        {{ Form::select('priority', array('N' => 'Normal', 'U' => 'Urgent'),$task->priority,array('class' => 'form-control','disabled' => 'disabled')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Title Task</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nama" value="{{ $task->due_date }}" disabled="disabled">                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ url('/task') }}" class="fa fa-btn fa-sign-in btn btn-primary" >  Back</a>                                
                                    </div>
                                </div>                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
