<h2>Related Comments</h2>
<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

if (count($comments) > 0) {
    foreach ($comments as $comment) { ?>
        <div class="media text-center">
            <?php
                $author_id = $comment->getAuthor();
                $author = $userManager->find($author_id);
            ?>
            <div class="media-body">
                <h4 class="media-heading"><?= $author->getName(); ?></small></h4>
                <p><?= $comment->getContent(); ?></p>
            </div>
        </div>
    <?php }
} else {
    echo "<p class='text-center'>No comment</p>";
}
?>
