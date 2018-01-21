# Basic Task Manager
This demo evaluates a basic understanding of PHP, jQuery, HTML &amp; CSS. It makes use of the bootstrap UI framework along with the jquery javascript library. All server actions are done in PHP.

### What it does
A basic PHP web app that allows a user to create and modify tasks in a task list type of app. Tasks will be stored in a file as a json encoded string (for the purposes of this demo).
The final result is a 1 page app that displays a list of tasks and allows the user to click on a task to edit it in a modal (reference bootstrap modals). The user is also be able to create a new task from scratch as well as delete existing tasks.
* Implement the jquery and html code on the frontend to display the task information
* Implement the jquery code on the frontend that sends the task information to the server
* Implement a PHP class that will be able to handle the modification of the task object
* Implement a PHP script that receives a POST with the object information and then either updates, creates or deletes the task object

Key functions included are:

In PHP:
* json_encode();
* json_decode();

In jQuery:
* $.post();
* Functions to update html elements on the page

