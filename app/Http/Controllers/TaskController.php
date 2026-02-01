<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{

    public function index(){
        $tasks = Task::where('user_id', Session::get('user_id'))->get(0);
        return view('tasks.index', compact('tasks'));
    }
    //
}
