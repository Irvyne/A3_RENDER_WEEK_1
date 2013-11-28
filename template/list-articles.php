<h1>List Articles</h1>
<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

foreach ($articles as $article) { ?>
    <article class="text-center">
        <h1>
            <a href="article.php?id=<?= $article->getId(); ?>"><?= $article->getTitle(); ?></a>
            <?php if ($userSession->isConnected() && $userSession->hasRole('ROLE_ADMIN')) { ?>
                <small>
                    <?php if (true === $article->getEnabled()) { ?>
                        <span class="label label-success">enabled</span>
                    <?php } else { ?>
                        <span class="label label-danger">disabled</span>
                    <?php } ?>
                </small>
            <?php } ?>
        </h1>
        <p><?= $article->getContent(); ?></p>
        <small><?= $article->getDate()->format(\DateTimeFormat::DATE_FRENCH); ?></small>
        <?php if ($userSession->isConnected() && $userSession->hasRole('ROLE_ADMIN')): ?>
            <a href="admin-article-edit.php?id=<?= $article->getId(); ?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a href="admin-article-delete.php?id=<?= $article->getId(); ?>"><span class="glyphicon glyphicon-remove"></span></a>
        <?php endif; ?>
    </article>
<?php } ?>