<?php
    if (isset($article) && $article instanceof Article) {
        $title = $article->getTitle();
        $content = $article->getContent();
        $enabled = $article->getEnabled();
    }
?>
<h1><?= !empty($article) ? "Update article" : "Create article" ; ?></h1>
<form action="" method="post" role="form" xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Choose a title" value="<?= !empty($title) ? $title : null ; ?>" required>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="Choose a content" rows="3" required><?= !empty($content) ? $content : null ; ?></textarea>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" id="enabled" name="enabled" value="" <?= empty($enabled) ?: "checked" ; ?>>
            Check to enabled the article
        </label>
    </div>
    <input type="submit" name="submit" class="btn btn-default" value="<?= !empty($article) ? "Update" : "Create" ; ?>">
</form>