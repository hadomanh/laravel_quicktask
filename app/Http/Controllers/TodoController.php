<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Repositories\Todo\TodoRepository;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todoRepository->findAllBy('user_id', Auth::user()->id);

        return view('todo.index', compact('todos'));
    }

    public function add(Request $request)
    {
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->content = $request->content;
        if (isset($request->deadline) && trim($request->deadline) === '') {
            $request->deadline = now()->toDateTimeString();
        }
        $todo->deadline = $request->deadline;
        $todo->status = 0;
        $todo->user_id = Auth::user()->id;
        $todo->save();

        $todos = $this->todoRepository->findAllBy('user_id', Auth::user()->id);

        return view('todo.todoList', compact('todos'));
    }

    public function edit(Request $request)
    {
        if (isset($request->deadline) && trim($request->deadline) === '') {
            $request->deadline = now()->toDateTimeString();
        }

        $todo = [
            'title' => $request->title,
            'content' => $request->content,
            'deadline' => $request->deadline,
            'status' => (int)$request->status,
        ];

        $this->todoRepository->update($todo, $request->id);

        $todos = $this->todoRepository->findAllBy('user_id', Auth::user()->id);

        return view('todo.todoList', compact('todos'));
    }

    public function delete($id)
    {
        $this->todoRepository->destroy($id);
        $todos = $this->todoRepository->findAllBy('user_id', Auth::user()->id);

        return view('todo.todoList', compact('todos'));
    }
}
