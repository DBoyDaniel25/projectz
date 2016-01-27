<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 12:26 PM
     */


    use Backend\Database\Tables\ILove;

    include "../../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new ILove();
        // creates json then redirects to the JSON file
        $table->createJson(ILove::JSON_NAME, $table->readUnsynced());
        header("Location: ../json/" . ILove::JSON_NAME);
    }