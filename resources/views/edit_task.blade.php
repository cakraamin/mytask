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
                            {!! Form::model($task,['class' => 'form-horizontal','method' => 'PATCH','route'=>['task.update',$task->id]]) !!}
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Title Task</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title" value="{{ $task->title }}">                                

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Deskription</label>

                                    <div class="col-md-6">                                    
                                        <textarea name="description" class="form-control">{{ $task->description }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Priority</label>

                                    <div class="col-md-6">
                                        {{ Form::select('priority', array('N' => 'Normal', 'U' => 'Urgent'),$task->priority,array('class' => 'form-control')) }}

                                        @if ($errors->has('priority'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('priority') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                         

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Due Date</label>

                                    <div class="col-md-6">
                                        <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="due_date" value="{{ $task->due_date }}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                        @if ($errors->has('due_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('due_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                                               

                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}                                
                                        <a href="{{ URL('task') }}" class="btn btn-warning">Cancel</a>
                                    </div>                            
                                </div>                    
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
