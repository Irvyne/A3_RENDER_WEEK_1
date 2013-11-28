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
    $articleManager = new ArticleManager($pdo);
    $article = $articleManager->find($id);

    if (isset($_POST['submit']))
    {
        $messages = array();
        if (!empty($_POST['title']))
            $title = $_POST['title'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Sign In Problem!',
                'msg'   => 'Title field cannot be empty!',
            );
        if (!empty($_POST['content']))
            $content = $_POST['content'];
        else
            $messages[] = array(
                'type'  => 'danger',
                'title' => 'Sign In Problem!',
                'msg'   => 'Content field cannot be empty!',
            );
        if (isset($_POST['enabled']))
            $enabled = $_POST['enabled'] === null ? false : true;
        else
            $enabled = false;


        if (count($messages) == 0) {
            $article->setTitle($title);
            $article->setContent($content);
            $article->setEnabled($enabled);
            if ($articleManager->update($article)) {
                $messages[] = array(
                    'type'  => 'success',
                    'title' => 'Add!',
                    'msg'   => 'Article successfully updated!',
                );
                $headerRedirect = true;
            } else
                $messages[] = array(
                    'type'  => 'warning',
                    'title' => 'Add!',
                    'msg'   => 'Article not successfully added, please retry!',
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
include 'template/add-edit-article.php';
include 'template/_footer.php';