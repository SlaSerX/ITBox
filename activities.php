<?php
include('config.php');
logincheck();

$message = [];
if (isset($_GET['delete_all'])) {
    $del_activities = Activity::all();
    foreach ($del_activities as $del_activity) {
        $del_activity->delete();
    }

    $message['type'] = "Success";
    $message['message'] = "All logs deleted";
}

if (isset($_GET['delete'])) {
    $de_activity = Activity::find($_GET['delete']);
    $de_activity->delete();

    $mssage['type'] = "Success";
    $message['message'] = "Log Deleted";
}

$activity = Activity::where('date_end', '<>', '0000-00-00 00:00:00')->get();


echo $template->view()->make('activities')
    ->with('activities', $activity)
    ->with('message', $message)
    ->render();
?>
