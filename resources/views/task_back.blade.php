<table class="table table-striped">
                                <thead>
                                    <th width="50px">ID</th>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Mark Complete</th>
                                    <th>Due Date</th>
                                    <th width="230px">Action</th>
                                </thead>
                                <tbody>
                                @foreach ($task as $dt_task)
                                    <tr>
                                        <td>{{ $dt_task->id }}</td>
                                        <td>{{ $dt_task->title }}</td>
                                        <td>
                                            @if ($dt_task->priority == 'N')
                                                Normal
                                            @else
                                                Urgent
                                            @endif
                                        </td>
                                        <td>{{ $dt_task->complete }}</td>
                                        <td>{{ $dt_task->due_date }}</td>
                                        <td>
                                            <a href="{{url('/task',$dt_task->id)}}" class="btn btn-primary" style="float:left; margin-right:3px">Read</a>
                                            {!! Form::open(['method' => 'DELETE', 'route'=>['task.destroy', $dt_task->id]]) !!}
                                            <a href="{{route('task.edit',$dt_task->id)}}" class="btn btn-warning">Update</a>
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>