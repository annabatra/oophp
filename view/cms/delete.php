<?php require "../view/cms/header.php";
?>
<form method="post">
    <fieldset>
    <legend>Radera</legend>

    <input type="hidden" name="contentId" value="<?= htmlentities($content[0]->id) ?>"/>

    <p>
        <label>Titel:<br>
            <input type="text" name="contentTitle" value="<?= htmlentities($content[0]->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Radera</button>
    </p>
    </fieldset>
</form>
</main>
</body>
</html>
