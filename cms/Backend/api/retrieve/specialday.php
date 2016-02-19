<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 7:10 PM
     */

    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\SpecialDays;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new SpecialDays();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . SpecialDays::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . SpecialDays::JSON_NAME);
        } else {
            echo "false";
        }
    }