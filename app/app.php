<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/todolist.php";

    $app = new Silex\Application();

    $app->get("/", function() {


        $test_task = new Task("Learn PHP.");
        $task_two = new Task("Learn Drupal");
        $task_three = new Task("Visit Istanbul");

        $list_of_tasks = array($test_task, $task_two, $task_three);
        $output = "";

        foreach($list_of_tasks as $task) {
            $output = $output . "<p>" . $task->getDescription() . "</p>";
        }

        return $output;

    });

    return $app;

?>
