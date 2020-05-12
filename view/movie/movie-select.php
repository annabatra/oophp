<?php

namespace Anax\View;

require "../view/movie/header.php";?>

<form method="post">
    <fieldset>
    <legend>Skapa, editera eller ta bort</legend>

    <input type="submit" name="doAdd" value="Skapa ny film" formaction="addMovie">


    <p>
        <label>Editera eller ta bort film:<br>
        <select name="movieId">
            <option value="">Välj film</option>
            <?php foreach ($movies as $result) : ?>
            <option value="<?= $result->id ?>"><?= $result->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doEdit" value="Editera" formaction="editMovie">
        <input type="submit" name="doDelete" value="Radera" formaction="deleteMovie">
    </p>
    <p><a class="linkOne" href="show-all">Visa alla</a></p>
    </fieldset>
</form>
</main>
