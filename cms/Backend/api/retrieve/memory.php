<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/16/16
     * Time: 2:42 PM
     */

    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\Memory;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Memory();

        if ($table->createJson()) {
            $email = new Email("MyLove Synced", "Table " . Memory::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Memory::JSON_NAME);
        } else {
            echo "false";
        }
    }