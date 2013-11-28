<?php
    if (isset($comment) && $comment instanceof Comment) {
        $content = $comment->getContent();
    }
?>
<h1><?= !empty($comment) ? "Update comment" : "Create comment" ; ?></h1>
<form action="" method="post" role="form" xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="Choose a content" rows="3" required><?= !empty($content) ? $content : null ; ?></textarea>
    </div>
    <?php if (empty($content)) { ?>
        <div class="form-group">
            <label for="article">Related article</label>
            <select id="article" name="article" class="form-control">
                <?php foreach($articles as $article) { ?>
                    <option value="<?= $article->getId(); ?>"><?= $article->getTitle(); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php } ?>
    <input type="submit" name="submit" class="btn btn-default" value="<?= !empty($article) ? "Update" : "Create" ; ?>">
</form>