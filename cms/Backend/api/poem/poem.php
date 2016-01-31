<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/6/16
     * Time: 2:57 PM
     */

    use Backend\Database\Tables\Poems;
    use Backend\Helpers\Email;

    include "../../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Poems();
        // creates json then redirects to the JSON file
        $data = $table->readUnsynced();
        $table->createJson(Poems::JSON_NAME, $data);
        if ($data !== false) {
            $email = new Email("MyLove Data Synced", Poems::JSON_NAME);
            $email->send();
            header("Location: ../json/" . Poems::JSON_NAME);
        }
    }

