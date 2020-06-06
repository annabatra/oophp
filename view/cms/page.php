<?php
$textFilter = new Chbl\TextFilter\TextfilterMain();

$filter = $content->filter;
$data = $content->data;
$filter_array = explode(',', $filter);
?>
<article>
    <header>
        <p><a href="/~chbl19/dbwebb-kurser/oophp/me/redovisa/htdocs/cms/pages" class="goback-link">< Tillbaka</a></p>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Senaste uppdateringen: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
    </header>
    <?= $textFilter->parse($data, $filter_array) ?>
</article>
</main>
</body>
</html>
