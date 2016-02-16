<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/16/16
     * Time: 2:43 PM
     */
    use Backend\Database\Tables\Reassurance;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Reassurance();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . Reassurance::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Reassurance::JSON_NAME);
        } else {
            echo "false";
        }
    }