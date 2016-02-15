<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 12:26 PM
     */

    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\ILove;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new ILove();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . ILove::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . ILove::JSON_NAME);
        } else {
            echo "false";
        }
    }