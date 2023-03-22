<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::query()->get();

        return inertia('Todos/Index', [
            'todos' => $todos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // BRIEF: Validate the request and save a new TODO, then redirect back to the index

        // TODO: Add validation of input

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // BRIEF: Validate the request and update the TODO's "completed" status, then redirect back to the index
        $currentTodo = Todo::findOrFail( intval( $request->route('id')) );
        $currentTodo->completed = true;
        $currentTodo->save();

        return response()->json([
            'message' => 'Successfully updated todo item.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id )
    {
        // BRIEF: Delete the TODO, then redirect back to the index
        try{
            Todo::find( intval($id) )->delete();
            return response()->json([
                'message' => 'Successfully deleted todo item.'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => $e
            ]);
        }
    }
}
