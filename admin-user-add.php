<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (!$userSession->isConnected())
    header('index.php');

if ($userSession->hasRole('ROLE_ADMIN')) {
    if (isset($_POST['submit']))
    {
        $messages = array();
        if (!empty($_POST['username']))
            $username = $_POST['username'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Sign Up Problem!',
                'msg'   => 'Username field cannot be empty!',
            );
        if (!empty($_POST['password']))
            $password = $_POST['password'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Sign Up Problem!',
                'msg'   => 'Password field cannot be empty!',
            );
        if (!empty($_POST['role']))
            $role = $_POST['role'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Sign Up Problem!',
                'msg'   => 'Role cannot be empty!',
            );

        if (count($messages) == 0) {
            $userManager = new UserManager($pdo);
            $user = new User(array(
                'name'      => $username,
                'password'  => $password,
                'role'      => $role,
            ));
            $user = $userManager->add($user);
            $messages[] = array(
                'type'  => 'success',
                'title' => 'Sign In!',
                'msg'   => 'Successfully add an user, welcome!!',
            );
            $headerRedirect = true;
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
include 'template/sign-up.php';
include 'template/_footer.php';