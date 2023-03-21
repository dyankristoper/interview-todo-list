import React from 'react';
import axios from 'axios';
import Layout from '@/layouts/Layout';
import { Todo } from '@/types';
import Modal from '@/components/common/Modal';
import TodoForm from '@/components/TodoForm';
import Button from '@/components/common/Button';
import Card from '@/components/common/Card';
interface Props {
    todos: Todo[];
}

export default function TodosIndex({ todos }: Props) {
    const [modalOpen, setModalOpen] = React.useState(false);
    const [todoList, setTodoList] = React.useState( todos );

    /* 
        Delete todo function
        Send DELETE HTTP request
    */
    const deleteTodoHandler = ( id : Number ) => {
        axios.delete(`/todos/${ id }`).then( response => {
            setTodoList([
                ...todoList.filter( todo => todo.id != id )
            ]);
        });
    }

    /* 
        Update todo function
        Change completed status to true
    */
   const markAsDoneTodoHandler = ( id: Number ) => {
       axios.put(`/todos/${id}`).then( response => {
            setTodoList([
                ...todos.map( todo => {
                    if( todo.id === id ){
                        todo.completed = true;
                    }
                    return todo;
                })
            ]);
       });
   }

    return (
        <Layout>
            <div className="container mt-12 mb-24">
                <div className="flex flex-col gap-12">
                    <Button
                        type="button"
                        onClick={() => setModalOpen(!modalOpen)}
                        className="mr-auto"
                    >
                        Add ToDo
                    </Button>

                    {/* BRIEF: Your code here */}
                    {
                        todoList.map( todo => { 
                            return  <Card key={ `item-${todo.id}`}>
                                        <h2>
                                            { todo.title }
                                        </h2> 
                                        {
                                            todo.completed !== true && 
                                            <Button 
                                                type='button' 
                                                theme='info'
                                                onClick={ () => markAsDoneTodoHandler(todo.id) }
                                            >
                                                    Mark as Complete
                                            </Button>
                                        }
                                        <Button 
                                            type='button' 
                                            theme='danger'
                                            onClick={ () => deleteTodoHandler(todo.id) }
                                        >
                                                Delete
                                        </Button>
                                    </Card>
                        })
                    }
                </div>
            </div>

            <Modal show={modalOpen} onClose={() => setModalOpen(false)}>
                <TodoForm closeModal={() => setModalOpen(false)} />
            </Modal>
        </Layout>
    );
}
