<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 6:16 PM
     */

    use Backend\Database\Schemas\SpecialDay;
    use Backend\Database\Tables\SpecialDays;

    include "../../vendor/autoload.php";
    // create new row in database
    if (isset($_POST["create"])) {
        $date    = $_POST[SpecialDays::DATE];
        $message = $_POST[SpecialDays::MESSAGE];

        $obj   = new SpecialDay(null, $date, $message);
        $table = new SpecialDays();
        if ($table->create($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // update rows in database
    if (isset($_POST["update"])) {

        $date    = $_POST[SpecialDays::DATE];
        $message = $_POST[SpecialDays::MESSAGE];
        $id      = $_POST[SpecialDays::ROW_ID];

        $obj = new SpecialDay($id, $date, $message);
        $obj->setSynced(null);
        $obj->setToUpdate("true");

        $table = new SpecialDays();
        if ($table->update($obj)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // delete rows in database
    if (isset($_POST["delete"])) {
        $id    = $_POST[SpecialDays::ROW_ID];
        $table = new SpecialDays();
        if ($table->delete($id)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    // fetch total rows
    if (isset($_GET["total"])) {
        $table = new SpecialDays();
        $total = $table->totalRows();
        echo $total . " reassure";
    }
