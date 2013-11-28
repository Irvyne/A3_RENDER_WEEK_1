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
    $commentManager = new CommentManager($pdo);
    $comment = $commentManager->find($id);

    if (isset($_POST['submit'])) {
        $messages = array();
        if (!empty($_POST['content']))
            $content = $_POST['content'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Add Comment Problem!',
                'msg'   => 'Content field cannot be empty!',
            );

        if (count($messages) == 0) {
            $comment->setContent($content);
            if ($commentManager->update($comment)) {
                $messages[] = array(
                    'type'  => 'success',
                    'title' => 'Update!',
                    'msg'   => 'Comment successfully updated!',
                );
                $headerRedirect = true;
            } else
                $messages[] = array(
                    'type'  => 'warning',
                    'title' => 'Update!',
                    'msg'   => 'Comment not successfully updated, please retry!',
                );
        }
        !empty($_SESSION['flash_messages']) ?: $_SESSION['flash_messages'] = array();
        $_SESSION['flash_messages'] = is_array($_SESSION['flash_messages']) ? array_merge($_SESSION['flash_messages'], $messages) : $messages;

    }
}

if (!empty($headerRedirect)) {
    header('Location: index.php');
    exit;
}

include 'template/_header.php';
include 'template/add-edit-comment.php';
include 'template/_footer.php';