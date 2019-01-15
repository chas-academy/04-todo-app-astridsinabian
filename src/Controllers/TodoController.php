<?php

use Todo\Controller;
use Todo\Database;
use Todo\TodoItem;

class TodoController extends Controller {

    
    public function get()
    {
        $todos = TodoItem::findAll();
        return $this->view('index', ['todos' => $todos]);
    }

    public function add()
    {
        $body = filter_body();
        $result = TodoItem::createTodo($body['title']);

        if ($result) {
          $this->redirect('/');
        }
    }

    public function update($urlParams)
    {
        $body = filter_body();
        $todoId = $urlParams['id'];
        $completed = isset($body['status']) ? 1 : 0;
        $title = $body['title'];

        if($completed == 0) {
          $completed = "false";
        } else {
          $completed = "true";
        }

        $result = TodoItem::updateTodo($todoId, $title, $completed);

        if($result) {
          $this->redirect('/');
        }

    }

    public function delete($urlParams)
    {

      $todoId = $urlParams['id'];

      $result = TodoItem::deleteTodo($todoId);

      if($result) {
        $this->redirect('/');
      }

    }
     
    // public function toggle()
    // {
    //   // (OPTIONAL) TODO: This action should toggle all todos to completed, or not completed.
    // }

    public function clear($urlParams)
    {

      $result = TodoItem::clearCompletedTodos($todoId);

      if($result) {
        $this->redirect('/');
      }

    }

    

  
}
