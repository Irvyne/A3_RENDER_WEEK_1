<article class="text-center">
    <h1><a href="article.php?id=<?= $article->getId(); ?>"><?= $article->getTitle(); ?></a></h1>
    <p><?= $article->getContent(); ?></p>
    <small><?= $article->getDate()->format(\DateTimeFormat::DATE_FRENCH); ?></small>
</article>