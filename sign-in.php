<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (!empty($_SESSION['connected']))
    header('Location: index.php');

if (isset($_POST['submit']))
{
    $messages = array();
    if (!empty($_POST['username']))
        $username = $_POST['username'];
    else
        $messages[] = array(
            'type'  => 'danger',
            'title' => 'Sign In Problem!',
            'msg'   => 'Username field cannot be empty!',
        );
    if (!empty($_POST['password']))
        $password = $_POST['password'];
    else
        $messages[] = array(
            'type'  => 'danger',
            'title' => 'Sign In Problem!',
            'msg'   => 'Password field cannot be empty!',
        );

    if (count($messages) == 0) {
        $repo = $entityManager->getRepository('User');
        if ($user = $userManager->signIn($username, $password)) {
            $userSession->register($user);
            $messages[] = array(
                'type'  => 'success',
                'title' => 'Sign In!',
                'msg'   => 'Successfully Sign In, welcome!!',
            );
            $headerRedirect = true;
        } else {
            $messages[] = array(
                'type'  => 'warning',
                'title' => 'Sign Up Problem!',
                'msg'   => 'Bad Credentials!',
            );
        }
    }
    !empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
    $_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;
}

if (!empty($headerRedirect)) {
    header('Location: index.php');
    exit;
}
$userManager = new UserManager($pdo);
$users = $userManager->findAll();

include 'template/_header.php';
include 'template/sign-in.php';
include 'template/_footer.php';