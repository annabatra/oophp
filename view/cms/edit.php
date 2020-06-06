<?php require "../view/cms/header.php";
?>


<form method="post">
    <fieldset>
    <legend>Ändra</legend>
    <input type="hidden" name="contentId" value="<?= esc($content[0]->id) ?>"/>

    <p>
        <label>Titel:<br>
        <input type="text" name="contentTitle" value="<?= esc($content[0]->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= esc($content[0]->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= esc($content[0]->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"><?= esc($content[0]->data) ?></textarea>
     </p>

     <p>
         <label>Typ:<br>
         <input type="text" name="contentType" value="<?= esc($content[0]->type) ?>"/>
     </p>

     <p>
         <label>Filter (bbcode,link,markdown,nl2br):<br>
         <input type="text" name="contentFilter" value="<?= esc($content[0]->filter) ?>"/>
     </p>

     <p>
         <label>Publisera:<br>
         <input type="datetime" name="contentPublish" value="<?= esc($content[0]->published) ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Spara</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Radera</button>
    </p>
    </fieldset>
</form>
</main>
</body>
</html>
