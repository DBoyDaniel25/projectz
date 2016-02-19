<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 4:19 PM
     */
    use Backend\Database\Tables\Reassurance;

    include "../../vendor/autoload.php";
    // create new row in database
    if (isset($_POST["create"])) {
        $reassure = $_POST[\Backend\Database\Tables\Reassurance::REASSURE];

        $obj = new \Backend\Database\Schemas\Reassure(null, $reassure);

        $table = new \Backend\Database\Tables\Reassurance();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // update rows in database
    if (isset($_POST["update"])) {

        $reassure = $_POST[\Backend\Database\Tables\Reassurance::REASSURE];
        $id       = $_POST[\Backend\Database\Tables\Reassurance::ROW_ID];

        $obj = new \Backend\Database\Schemas\Reassure($id, $reassure);
        $obj->setSynced(null);
        $obj->setToUpdate("true");

        $table = new \Backend\Database\Tables\Reassurance();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // delete rows in database
    if (isset($_POST["delete"])) {
        $id    = $_POST[\Backend\Database\Tables\Reassurance::ROW_ID];
        $table = new \Backend\Database\Tables\Reassurance();
        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // fetch total rows
    if(isset($_GET["total"])){
        $table = new Reassurance();
        $total = $table->totalRows();
        echo $total . " reassure";
    }
