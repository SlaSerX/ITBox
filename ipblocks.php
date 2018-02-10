<?php
/**
 * Created by ITBox 2018
 */
include('config.php');
logincheck();
$message = [];

if (isset($_GET['delete'])) {
    $ipblock = BlockedIp::find($_GET['delete']);
    $ipblock->delete();

    $message['type'] = "Success";
    $message['message'] = "Administrador deletado";
}

$ipblocks = BlockedIp::all();

echo $template->view()->make('ipblocks')->with('ipblocks', $ipblocks)->with('message', $message)->render();
