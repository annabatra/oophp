<?php require "../view/movie/header.php";?>

<form method="get">
    <fieldset>
    <legend>Sök år</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Skapad mellan:
        <input type="number" name="yearStart" value="<?= htmlentities($yearStart) ?: 1900 ?>" min="1900" max="2100" placeholder="1900"/>

        <input type="number" name="yearEnd" value="<?= htmlentities($yearEnd) ?: 2100 ?>" min="1900" max="2100" placeholder="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>



<?php if ($resultset) : ?>
    <table>
        <tr>
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++;?>
        <tr>
            <td><?= htmlentities($id) ?></td>
            <td><?= htmlentities($row->id) ?></td>
            <td><img class="thumb" src="../<?= htmlentities($row->image) ?>"></td>
            <td><?= htmlentities($row->title) ?></td>
            <td><?= htmlentities($row->year) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif;

?> <p><a class="linkOne" href="show-all">Visa alla</a></p>
</fieldset>
</form>
</main>
