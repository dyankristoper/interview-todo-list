<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
// BRIEF: Write your routes here

// POST Route - Create a new todo
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

// PUT Route - Update the current todo
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');

// DELETE Route - Delete an existing todo
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');