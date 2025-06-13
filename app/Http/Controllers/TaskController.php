<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{
    public function index (Request $get)
    {
        $selected_status = 'all';
        $user_id = Auth::id();
        // $tasks = Task::where('user_id', $user_id)->orderBy('due_date', 'asc')->get();
        $query = Task::query();
        $query->where('user_id', $user_id);
        if (isset($get->status) && $get->status != 'all') {
            $query->where('status', $get->status);
            $selected_status = $get->status;
        }
        $query->orderBy('due_date', 'asc');
        $tasks = $query->paginate(3);
        $status = Task::STATUS;

        return view('index', compact('tasks', 'status', 'selected_status'));
    }

    public function get_add ()
    {
        $status = Task::STATUS;

        return view('add', compact('status'));
    }

    public function post_add (Request $post)
    {
        $validator = Validator::make($post->all(), [
            'title' => 'required | max:255',
            'due_date' => 'required | date | after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect('/tasks/add')->withInput()->withErrors($validator);  
        }


        $status = Task::STATUS;
        $user_id = Auth::id();
        $task = new Task;
        $task->user_id = $user_id;
        $task->title = $post->title;
        $task->description = $post->description;
        $task->due_date = $post->due_date;
        $task->status = 0;    // 新規登録なので「未着手」で固定
        $task->save();

        return redirect('/tasks');
    }

    public function get_edit (Task $task)
    {
        $status = Task::STATUS;

        return view('edit', compact('task', 'status'));
    }

    public function post_edit (Task $task, Request $post)
    {
        $validator = Validator::make($post->all(), [
            'title' => 'required | max:255',
            'due_date' => 'required | date | after_or_equal:today',
            'status' => 'required | between:0,2',
        ]);

        if ($validator->fails()) {
            return redirect('/tasks/edit/'.$task->id)->withInput()->withErrors($validator);  
        }
        $task->title = $post->title;
        $task->description = $post->description;
        $task->due_date = $post->due_date;
        $task->status = $post->status;
        $task->update();

        return redirect('/tasks');
    }

    public function update (Task $task, Request $post)
    {
        $task->status = $post->status;
        $task->update();

        return response()->json($task);
    }

    public function delete (Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}
