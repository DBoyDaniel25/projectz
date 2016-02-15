<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:48 PM
     */

    include "../../vendor/autoload.php";
    if (isset($_POST["create"])) {
        $memory = $_POST[\Backend\Database\Tables\Memory::MEMORY];

        $obj = new \Backend\Database\Schemas\Memory(null, $memory);

        $table = new \Backend\Database\Tables\Memory();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["update"])) {

        $memory = $_POST[\Backend\Database\Tables\Memory::MEMORY];
        $id       = $_POST[\Backend\Database\Tables\Memory::ROW_ID];

        $obj = new \Backend\Database\Schemas\Memory($id, $memory);
        $obj->setSynced(null);
        $obj->setToUpdate("true");
        $table = new \Backend\Database\Tables\Memory();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["delete"])) {
        $id    = $_POST[\Backend\Database\Tables\Memory::ROW_ID];
        $table = new \Backend\Database\Tables\Memory();
        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }
