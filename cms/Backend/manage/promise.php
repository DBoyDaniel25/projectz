<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 6:55 PM
     */
    use Backend\Database\Tables\Promises;

    include "../../vendor/autoload.php";
    if (isset($_POST["create"])) {
        $promise = $_POST[\Backend\Database\Tables\Promises::PROMISE];

        $obj = new \Backend\Database\Schemas\Promise(null, $promise);

        $table = new \Backend\Database\Tables\Promises();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["update"])) {

        $promise = $_POST[\Backend\Database\Tables\Promises::PROMISE];
        $id       = $_POST[\Backend\Database\Tables\Promises::ROW_ID];

        $obj = new \Backend\Database\Schemas\Promise($id, $promise);
        $obj->setSynced(null);

        $table = new \Backend\Database\Tables\Promises();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["delete"])) {
        $id    = $_POST[\Backend\Database\Tables\Promises::ROW_ID];
        $table = new \Backend\Database\Tables\Promises();
        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // fetch total rows
    if(isset($_GET["total"])){
        $table = new Promises();
        $total = $table->totalRows();
        echo $total . " promise";
    }