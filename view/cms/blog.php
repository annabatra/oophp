<?php

if (!$resultset) {
    return;
}

$textFilter = new Chbl\Textfilter\TextfilterMain();

require "../view/cms/header.php";
?>
<article>
<?php foreach ($resultset as $row) :
    $filter = $row->filter;
    $data = $row->data;
    $filter_array = explode(',', $filter);?>
<section>
    <header>
        <h2><a href="blogpost/<?= htmlentities($row->slug) ?>"><?= htmlentities($row->title) ?></a></h1>
        <p><i>Publiserad: <time datetime="<?= htmlentities($row->published_iso8601) ?>" pubdate><?= htmlentities($row->published) ?></time></i></p>
    </header>
    <?= $textFilter->parse($data, $filter_array) ?>
</section>
<?php endforeach; ?>

</article>
</main>
</body>
</html>
