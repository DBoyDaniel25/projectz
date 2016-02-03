<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/9/16
     * Time: 6:09 PM
     */

    use Backend\Database\Schemas\Poem;
    use Backend\Database\Tables\Poems;

    include "../../vendor/autoload.php";
    if (isset($_POST["create"])) {
        $name   = $_POST[Poems::NAME];
        $poem   = $_POST[Poems::POEM];
        $author = $_POST[Poems::AUTHOR];

        $obj = new Poem();
        $obj->setName($name);
        $obj->setPoem($poem);
        $obj->setAuthor($author);

        $table = new Poems();
        if($table->create($obj)){
            echo "true";
        }else {
            echo "false";
        }
    }

    if(isset($_POST["update"])){
        $name   = $_POST[Poems::NAME];
        $poem   = $_POST[Poems::POEM];
        $author = $_POST[Poems::AUTHOR];
        $id     = $_POST[Poems::ROW_ID];
        $obj    = new Poem($id, $author, $name, $poem, null, null, "true", "true");
        $table  = new Poems();
        if($table->update($obj)){
            echo "true";
        }else {
            echo "false";
        }
    }

    if(isset($_POST["delete"])){
        $id     = $_POST[Poems::ROW_ID];
        $table = new Poems();
        if($table->delete($id)){
            echo "true";
        }else {
            echo "false";
        }
    }
