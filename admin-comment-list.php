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

$articleManager = new ArticleManager($pdo);
$commentManager = new CommentManager($pdo);
$userManager = new UserManager($pdo);
$comments = $commentManager->findAll();

include 'template/_header.php';
include 'template/admin-list-comments.php';
include 'template/_footer.php';