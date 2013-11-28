<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (!$userSession->isConnected() || (!$userSession->hasRole('ROLE_ADMIN') && !$userSession->hasRole('ROLE_USER'))) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['submit']))
{
    $messages = array();
    if (!empty($_POST['content']))
        $content = $_POST['content'];
    else
        $messages[] = array(
            'type'  => 'danger',
            'title' => 'Add Comment Problem!',
            'msg'   => 'Content field cannot be empty!',
        );
    if (!empty($_POST['article']))
        $article_id = $_POST['article'];
    else
        $messages[] = array(
            'type'  => 'danger',
            'title' => 'Add Comment Problem!',
            'msg'   => 'Article field cannot be empty!',
        );

    if (count($messages) == 0) {
        $commentManager = new CommentManager($pdo);
        $comment = new Comment(array(
            'content'   => $content,
            'author'    => $userSession->getUser()->getId(),
            'article'   => $article_id,
        ));
        if ($commentManager->add($comment)) {
            $messages[] = array(
                'type'  => 'success',
                'title' => 'Add!',
                'msg'   => 'Comment successfully added!',
            );
            $headerRedirect = true;
        } else
            $messages[] = array(
                'type'  => 'warning',
                'title' => 'Add!',
                'msg'   => 'Comment not successfully added, please retry!',
            );
    }
    !empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
    $_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;
}

if (!empty($headerRedirect)) {
    header('Location: index.php');
    exit;
}

$articleManager = new ArticleManager($pdo);
if ($userSession->hasRole('ROLE_ADMIN'))
    $articles = $articleManager->findAll();
else
    $articles = $articleManager->findAllByEnabled(true);
$commentManager = new CommentManager($pdo);

include 'template/_header.php';
include 'template/add-edit-comment.php';
include 'template/_footer.php';