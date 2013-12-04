<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

$repo = $entityManager->getRepository('Article');

if ($userSession->isConnected() && $userSession->hasRole('ROLE_ADMIN'))
    $articles = $repo->findAll();
else
    $articles = $repo->findByEnabled(true);

include 'template/_header.php';
include 'template/list-articles.php';
include 'template/_footer.php';