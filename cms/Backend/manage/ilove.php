<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 11:58 AM
     */
    include "../../../vendor/autoload.php";
    if (isset($_POST["create"])) {
        $name = $_POST[\Backend\Database\Tables\ILove::LOVE];

        $obj = new \Backend\Database\Schemas\ILove(null, $name);

        $table = new \Backend\Database\Tables\ILove();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }