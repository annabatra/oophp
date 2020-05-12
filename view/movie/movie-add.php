<?php
namespace Anax\View;

require "../view/movie/header.php";?>

<h3>Lägg till</h3>

<form action="post">
    <label for="title" value>Titel:</label><br>
    <input type="text" name="title" placeholder="Title">
    <br><br>

    <label for="img">Bild:</label><br>
    <input type="text" name="img" value="img/noimage.png">
    <br><br>

    <label for="year">År:</label><br>
    <input type="text" name="year" placeholder="Year">
    <br><br>

    <input type="submit" name="doAdd" value="Addera" formaction="saveNewMovie">
</form>
</main>
