<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

if (empty($_GET['id']))
    header('Location: index.php');

require '_header.php';

$id = (int) $_GET['id'];

$articleManager = new ArticleManager($pdo);
$article = $articleManager->find($id);

$commentManager = new CommentManager($pdo);
$comments = $commentManager->findAllByArticle($article->getId());
$userManager = new UserManager($pdo);

include 'template/_header.php';
include 'template/show-article.php';
include 'template/list-comments.php';
include 'template/_footer.php';