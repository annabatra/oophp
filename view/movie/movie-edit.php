<?php

namespace Anax\View;

require "../view/movie/header.php";
?>
<form method="post">
    <fieldset>
    <legend>Editera</legend>
    <input type="hidden" name="movieId" value="<?= $movie[0]->id ?>"/>

    <p>
        <label>Titel:<br>
        <input type="text" name="movieTitle" value="<?= $movie[0]->title ?>"/>
        </label>
    </p>

    <p>
        <label>År:<br>
        <input type="number" name="movieYear" value="<?= $movie[0]->year ?>"/>
    </p>

    <p>
        <label>Bild:<br>
        <input type="text" name="movieImage" value="<?= $movie[0]->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara" formaction="saveChanges">
        <input type="reset" value="Återställ">
    </p>
    <p>
        <a href="movie-select">Välj film</a> |
        <a href="show-all">Visa alla</a>
    </p>
    </fieldset>
</form>
</main>
