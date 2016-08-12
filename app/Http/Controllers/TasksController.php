<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tasks;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Laracasts\Flash\Flash;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('task');
    }

    public function getBasicData()
    {
        $task = Tasks::select(['id', 'title', 'priority', 'complete', 'due_date']);

        return Datatables::of($task)
            //->editColumn('name', '{{ $name."-name" }}')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|max:200',
            'description'   => 'required|max:500',
            'priority'      => 'required',
            'due_date'      => 'required',
        ]);        

        $data['id_user'] = Auth::user()->id;       
        $data['title'] = $request->title;       
        $data['description'] = $request->description;       
        $data['priority'] = $request->priority;       
        $data['due_date'] = date('Y-m-d', strtotime($request->due_date));
        $data['complete'] = '0';
        
        if(Tasks::create($data)){
            Flash::success('Add Tasks Success');
        }else{
            Flash::info('Add Tasks Failed');
        }
                
        return redirect('task');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Tasks::where('id_user', Auth::user()->id)->select(['id', 'title', 'priority', 'complete', 'due_date'])->get();
       
        return Datatables::of($task)            
            ->editColumn('priority', function ($prio) {
                return $this->priority($prio->priority);
            })
            ->editColumn('complete', function ($comp) {
                return $this->complete($comp->id,$comp->complete);
            })
            ->addColumn('details_url', function ($user) {
                return $this->get_action($user->id);
            })
            ->make();
    }

    public function ubah($id,$val)
    {        
        $task = Tasks::findOrFail($id);        

        $val = ($val == '1')?'0':'1';
        $data['complete'] = $val;               

        if($task->update($data)){
            echo "ok";
        }else{
            echo "gagal";
        }
    }

    protected function complete($id,$val)
    {
        $cek = ($val == 1)?"checked='checked'":"";
        return '<input type="checkbox" name="complete" value="1" onClick="ubah('.$id.','.$val.')" '.$cek.'>';
    }

    protected function get_action($id)
    {
        $del = \Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']);
        return '<a href="'.route("task.edit",$id).'" class="btn btn-warning btn-xs">Update</a> '.$del;
    }

    protected function priority($val)
    {
        $val = ($val == 'N')?'Normal':'Urgent';
        return $val;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Tasks::find($id);
        return view('edit_task',compact('task'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);        

        $data['title'] = $request->title;       
        $data['description'] = $request->description;       
        $data['priority'] = $request->priority;       
        $data['due_date'] = date('Y-m-d', strtotime($request->due_date));           

        if($task->update($data)){
            \Flash::success('Tasks Failed Update');
        }else{
            \Flash::info('Tasks Failed Update');
        }

        return redirect('task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tasks::find($id)->delete();
        \Flash::success('Tasks Download Failed');
        return redirect('task');
    }
}
