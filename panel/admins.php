<?php
/**
 * Created by ITBox 2018
 */
include('config.php');
logincheck();
$message = [];

if (isset($_GET['delete'])) {
    if ($_GET['delete'] == 1) {
        $message['type'] = "error";
        $message['message'] = "Master admin profile cant be deleted";
    } else {
        $admin = Admin::find($_GET['delete']);
        $admin->delete();

        $message['type'] = "Success";
        $message['message'] = "Administrator deleted";
    }
}

$admins = Admin::all();

echo $template->view()->make('admins')
    ->with('admins', $admins)
    ->with('message', $message)
    ->render();
