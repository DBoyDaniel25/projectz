<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 12:26 PM
     */


    use Backend\Database\Tables\ILove;
    use Backend\Helpers\Email;

    include "../../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new ILove();
        $data  = $table->readUnsynced();
        // creates json then redirects to the JSON file
        $table->createJson(ILove::JSON_NAME, $data);
        if ($data !== false) {
            $email = new Email("MyLove Data Synced", ILove::JSON_NAME);
            $email->send();
        }
        header("Location: ../json/" . ILove::JSON_NAME);
    }