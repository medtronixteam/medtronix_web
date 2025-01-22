<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('employeeui.todos.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'user_id' => 'required|integer'
    ]);

    $todo = new Todo([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'user_id' => $request->input('user_id')
    ]);

    $todo->save();

    return response()->json(['message' => 'Todo created successfully']);
}


   public function list()
{
    $userId = auth()->id();
    $todos = Todo::where('user_id', $userId)->latest()->get();
    return response()->json($todos);
}
}

