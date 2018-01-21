<?php
/**
 * Created by PhpStorm.
 * User: PhpStorm
 * Date: 13052016
 * Time: 08:48
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     PhpStorm <info@localhost>
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Basic Task Manager</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form action="update_task.php" method="post">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 5px;;">
                            <input id="InputTaskName" type="text" placeholder="Task Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <textarea id="InputTaskDescription" placeholder="Description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="deleteTask" type="button" class="btn btn-danger">Delete Task</button>
                <button id="saveTask" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h2 class="page-header">Task List</h2>
            <!-- Button trigger modal -->
            <button id="newTask" type="button" class="btn btn-primary btn-lg" style="width:100%;margin-bottom: 5px;" data-toggle="modal" data-target="#myModal">
                Add Task
            </button>
            <div id="TaskList" class="list-group">

            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
    var currentTaskId;
    var TaskName;
    var TaskDescription;
    $('#myModal').on('show.bs.modal', function (event) {
        var triggerElement = $(event.relatedTarget); // Element that triggered the modal
        var modal = $(this);
        if (triggerElement.attr("id") == 'newTask') {
            modal.find('.modal-title').text('New Task');
            $('#deleteTask').hide();
            currentTaskId = -1;
        } else {
            modal.find('.modal-title').text('Task details');
            $('#deleteTask').show();
            currentTaskId = triggerElement.attr("id");
            TaskName = triggerElement.find('h4').text();
            TaskDescription = triggerElement.find('p').text();

            $('input#InputTaskName').val(TaskName);
            $('textarea#InputTaskDescription').val(TaskDescription);
        }
    });

    $('#myModal').on('hide.bs.modal', function (event) {
        $('input#InputTaskName').val('');
        $('textarea#InputTaskDescription').val('');
    });

    $('#saveTask').click(function () {
        TaskName = $('input#InputTaskName').val();
        TaskDescription = $('textarea#InputTaskDescription').val();

        if(!TaskName){
            swal("Oops!", "Please provide a valid task name!", "error");
            $('input#InputTaskName').focus();
            return false;
        }

        doTaskAction((currentTaskId == '-1') ? 'add' : 'update');
    });

    $('#deleteTask').click(function () {

        swal({
                title: "Are you sure?",
                text: "Task \"" + TaskName + "\" will be deleted and this cannot be undone!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                closeOnConfirm: true
            },
            function () {
                doTaskAction('delete');
            });
    });

    function updateTaskList() {
        $.post("list_tasks.php", function (data) {
            $("#TaskList").html(data);
        });
    }

    function doTaskAction(action) {
        $.post("update_task.php", {'action': action, 'task_id': currentTaskId, 'task_name': TaskName, 'task_description': TaskDescription}, function (data) {
            swal("Good job!", data, "success");
            $('#myModal').modal('hide');
            updateTaskList();
        });
    }

    updateTaskList();
</script>
</html>