<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 11:58 AM
     */
    use Backend\Database\Tables\ILove;

    include "../../vendor/autoload.php";
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

    if (isset($_POST["update"])) {

        $name = $_POST[\Backend\Database\Tables\ILove::LOVE];
        $id   = $_POST[\Backend\Database\Tables\ILove::ROW_ID];

        $obj = new \Backend\Database\Schemas\ILove($id, $name);
        $obj->setSynced(null);

        $table = new \Backend\Database\Tables\ILove();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["delete"])) {
        $id    = $_POST[\Backend\Database\Tables\ILove::ROW_ID];
        $table = new \Backend\Database\Tables\ILove();

        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // fetch total rows
    if(isset($_POST["total"])){
        $table = new ILove();
        $total = $table->totalRows();
        echo $total;
    }