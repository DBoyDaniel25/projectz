<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/16/16
     * Time: 2:41 PM
     */
    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\Promises;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Promises();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . Promises::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Promises::JSON_NAME);
        } else {
            echo "false";
        }
    }