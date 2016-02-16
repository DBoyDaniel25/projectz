<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/16/16
     * Time: 2:43 PM
     */

    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\Quotes;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Quotes();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . Quotes::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Quotes::JSON_NAME);
        } else {
            echo "false";
        }
    }