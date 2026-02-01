<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

// Supposedly, I will create the CRUD functions here.
class TaskController extends Controller
{

    public function index(){
        $tasks = Task::where('user_id', Session::get('user_id'))->get(0);
        return view('tasks.index', compact('tasks'));
    }
    //
}
