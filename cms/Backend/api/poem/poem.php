<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/6/16
     * Time: 2:57 PM
     */

    use Backend\Database\Schemas\Poem;
    use Backend\Database\Tables\Poems;

    include "../../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Poems();
        $table->createJson(Poems::JSON_NAME, $table->readUnsynced(true));
        $table->updateUnSyncedToSynced();
        header("Location: ../json/poems.json");
    }

    if (isset($_GET["update"])) {
        $fav   = $_GET["fav"];
        $id    = $_GET["id"];
        $poem  = new Poem($id, null, null, null, null, $fav);
        $table = new Poems();
        if ($table->update($poem)) {
            echo "true";
        } else {
            echo "false";
        }
    }

