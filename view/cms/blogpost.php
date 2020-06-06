<?php
$textFilter = new Chbl\TextFilter\TextfilterMain();

$filter = $content->filter;
$data = $content->data;
$filter_array = explode(',', $filter);

?>

<article>
    <header>
        <p><a href="/~chbl19/dbwebb-kurser/oophp/me/redovisa/htdocs/cms/blog" class="goback-link">< Tillbaka</a></p>

        <h2><?= esc($content->title) ?></h2>
        <p><i>Publiserad: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $textFilter->parse($data, $filter_array) ?>
</article>
</main>
</body>
</html>
