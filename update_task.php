<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');

$action = isset($_POST['action']) ? $_POST['action'] : null;
$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
$task_name = isset($_POST['task_name']) ? $_POST['task_name'] : null;
$task_description = isset($_POST['task_description']) ? $_POST['task_description'] : null;

$task = new Task($task_id);

//Override task object here
$task->TaskName = $task_name;
$task->TaskDescription = $task_description;

if($action == 'add' || $action == 'update'){
    $task->Save();

    switch ($action)
    {
        case "add":
            $message = "Task successfully added!";
            break;
        case "update":
            $message = "Task successfully updated!";
            break;
    }
}
elseif ($action == 'delete') {
    $task->Delete();
    $message = "Task successfully deleted!";
}
else{
    $message = "Internal server error!";
}

echo $message;
?>