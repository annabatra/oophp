<?php
require "../view/cms/header.php";
?>

<form method="post">
    <fieldset>
    <legend>Skapa</legend>

    <p>
        <label>Titel:<br>
        <input type="text" name="contentTitle" default="A Title"/>
        </label>
    </p>

    <p>
        <button type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Skapa</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Återställ</button>
    </p>
    </fieldset>
</form>
</main>
</body>
</html>
