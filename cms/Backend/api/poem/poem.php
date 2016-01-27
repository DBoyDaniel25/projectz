<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/6/16
     * Time: 2:57 PM
     */

    use Backend\Database\Tables\Poems;

    include "../../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Poems();
        // creates json then redirects to the JSON file
        $table->createJson(Poems::JSON_NAME, $table->readUnsynced());
        header("Location: ../json/" . Poems::JSON_NAME);
    }

