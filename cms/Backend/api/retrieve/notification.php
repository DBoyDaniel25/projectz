<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/17/16
     * Time: 12:41 PM
     *
     */
    use Backend\Database\Tables\Notifications;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Notifications();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . Notifications::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Notifications::JSON_NAME);
        } else {
            echo "false";
        }
    }