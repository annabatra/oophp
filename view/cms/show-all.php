<?php
if (!$resultset) {
    return;
}
require "../view/cms/header.php";
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Publiserad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Raderad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
</main>
</body>
</html>
