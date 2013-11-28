<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (!$userSession->isConnected() || !$userSession->hasRole('ROLE_ADMIN')) {
    header('Location: index.php');
    exit;
}

$userManager = new UserManager($pdo);
$users = $userManager->findAll();

include 'template/_header.php';
include 'template/list-users.php';
include 'template/_footer.php';