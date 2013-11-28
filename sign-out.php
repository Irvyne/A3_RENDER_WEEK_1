<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require 'autoload.php';

$userSession = new UserSession();
$userSession->destroy();

session_start();
$messages = array();
$messages[] = array(
    'type'  => 'success',
    'title' => 'Sign Out!',
    'msg'   => 'You have been successfully disconnected!',
);
!empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
$_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;

if (!empty($_GET['redirect']))
    header('Location: '.$_GET['redirect']);
else
    header('Location: index.php');