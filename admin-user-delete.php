<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (!$userSession->isConnected() || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

if ($userSession->hasRole('ROLE_ADMIN')) {
    $id = (int) $_GET['id'];
    $userManager = new UserManager($pdo);
    $messages = array();
    if($userManager->delete($id)){
        $messages[] = array(
            'type'  => 'success',
            'title' => 'Deletion!',
            'msg'   => 'User successfully deleted!',
        );
    }
    !empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
    $_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;
}

header('Location: index.php');