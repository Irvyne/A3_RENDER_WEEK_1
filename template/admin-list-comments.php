<h2>List Comments</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Content</th>
            <th>Author</th>
            <th>Article</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) { ?>
            <?php
            $author_id = $comment->getAuthor();
            $author = $userManager->find($author_id);
            $article_id = $comment->getArticle();
            $article = $articleManager->find($article_id);
            ?>
            <tr>
                <td><?= $comment->getId(); ?></td>
                <td><?= $comment->getContent(); ?></td>
                <td><?= $author->getName(); ?></td>
                <td><a href="article.php?id=<?= $article_id; ?>"><?= $article->getTitle(); ?></a></td>
                <td>
                    <a href="admin-comment-edit.php?id=<?= $comment->getId(); ?>">Edit <span class="glyphicon glyphicon-edit"></span></a> |
                    <a href="admin-comment-delete.php?id=<?= $comment->getId(); ?>">Delete <span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>