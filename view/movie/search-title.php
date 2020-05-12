<?php require "../view/movie/header.php";?>

<form method="get">
    <fieldset>
    <legend>Sök titel</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Titel:
            <input type="text" name="doSearch" placeholder="Sök">
        </label>
    </p>
    <p>
        <input type="submit" name="Search" value="Sök">
    </p>
    <p><a href="show-all">Visa alla</a></p>


<?php if ($resultset) : ?>
    <table>
        <tr>
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $finding) :
        $id++;?>
        <tr>
            <td><?= htmlentities($id) ?></td>
            <td><?= htmlentities($finding->id) ?></td>
            <td><img class="thumb" src="../<?= htmlentities($finding->image) ?>"></td>
            <td><?= htmlentities($finding->title) ?></td>
            <td><?= htmlentities($finding->year) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif;?>

</fieldset>
</form>
</main>
