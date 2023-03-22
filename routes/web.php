<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
// BRIEF: Write your routes here

// POST Route - Create a new todo
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

/** 
    @method PUT
    @description Update the todo item and change completed field to true
    @params id - Number
*/
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');

/** 
    @method DELETE
    @description Remote an existing todo item
    @params id - Number
*/
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');