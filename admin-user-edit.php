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
    $user = $userManager->find($id);

    if (isset($_POST['submit']))
    {
        $messages = array();
        if (!empty($_POST['username']))
            $username = $_POST['username'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Edit User Problem!',
                'msg'   => 'Username field cannot be empty!',
            );
        if (!empty($_POST['password']))
            $password = $_POST['password'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Edit User Problem!',
                'msg'   => 'Password field cannot be empty!',
            );
        if (!empty($_POST['role']))
            $role = $_POST['role'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Edit User Problem!',
                'msg'   => 'Role cannot be empty!',
            );

        if (count($messages) == 0) {
            $user->setName($username);
            $user->setPassword($password);
            $user->setRole($role);
            if ($userManager->update($user)) {
                $messages[] = array(
                    'type'  => 'success',
                    'title' => 'Edit!',
                    'msg'   => 'User successfully updated!',
                );
                $headerRedirect = true;
            } else
                $messages[] = array(
                    'type'  => 'warning',
                    'title' => 'Edit!',
                    'msg'   => 'User not successfully added, please retry!',
                );
        }
        !empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
        $_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;
    }
} else
    $headerRedirect = true;

if (!empty($headerRedirect)) {
    header('Location: index.php');
    exit;
}

include 'template/_header.php';
include 'template/edit-user.php';
include 'template/_footer.php';