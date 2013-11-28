<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['content'];

    $error_msg = array();
    if (empty($title))
        $error_msg[] = 'Champ title vide !';
    if (empty($content))
        $error_msg[] = 'Champ content vide !';
    if (empty($author))
        $error_msg[] = 'Champ auteur vide !';

    if (count($error_msg) == 0) {
        $arguments = array(
            'title'     => $title,
            'content'   => $content,
            'author'    => $author,
            'enabled'   => $enabled,
            'date'      => new DateTime(),
        );
        $article = new Article($arguments);
        $articleManager = new ArticleManager($pdo);
        $articleManager->add($article);
    }
}