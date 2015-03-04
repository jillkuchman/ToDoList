<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/todolist.php";

    session_start();
    if (empty($_SESSION['list_of_tasks']))
    {
        $_SESSION['list_of_tasks'] = array();
    }

    $app = new Silex\Application();

    $app->get("/", function() {


        $output = "";

        $list_tasks = Task::getAll();

        if (!empty($list_tasks)) {
            $output .= "
            <h1>To Do List</h1>
            <p>Here are your tasks</p>
            <ul>";

            foreach ($list_tasks as $task)
            {
                $output .= "<p>" . $task->getDescription() . "</p>";
            }

            $output .= "</ul>";

        }


        $output .= "</ul>
            <form action='/tasks' method='post'>
                <label for='description'>Task Description</label>
                <input id='description' name='description' type='text'>
                <button type='submit'>Add task</button>
            </form>
        ";

        $output .= "

        <form action='/delete_tasks' method='post'>
        <button type='submit'>Clear List</button>
        </form>

        ";

        return $output;

    });

    $app->post("/tasks", function()
    {
        $task = new Task($_POST['description']);
        $task->save();
        return "
            <h1>You created a task!</h1>
            <p>" . $task->getDescription() . "</p>
            <p><a href='/'>View your list of things to do.</a></p>
        ";

    });

    $app->post("/delete_tasks", function() {

        Task::deleteAll();

        return
        "
            <h1>List Cleared!</h1>
            <p><a href='/'>Home</a></p>
        ";
    });

    return $app;

?>
