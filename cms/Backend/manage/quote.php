<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 1:48 PM
     */
    use Backend\Database\Tables\Quotes;

    include "../../vendor/autoload.php";
    if (isset($_POST["create"])) {
        $quote = $_POST[\Backend\Database\Tables\Quotes::QUOTE];

        $obj = new \Backend\Database\Schemas\Quote(null, $quote);

        $table = new \Backend\Database\Tables\Quotes();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["update"])) {

        $quote = $_POST[\Backend\Database\Tables\Quotes::QUOTE];
        $id       = $_POST[\Backend\Database\Tables\Quotes::ROW_ID];

        $obj = new \Backend\Database\Schemas\Quote($id, $quote);

        $table = new \Backend\Database\Tables\Quotes();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    if (isset($_POST["delete"])) {
        $id    = $_POST[\Backend\Database\Tables\Quotes::ROW_ID];
        $table = new \Backend\Database\Tables\Quotes();
        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // fetch total rows
    if(isset($_GET["total"])){
        $table = new Quotes();
        $total = $table->totalRows();
        echo $total . " quotes";
    }