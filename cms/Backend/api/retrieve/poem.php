<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/6/16
     * Time: 2:57 PM
     */
    header("Cache-Control: no-cache, no-store");
    header("Pragma: no-cache");
    use Backend\Database\Tables\Poems;
    use Backend\Helpers\Email;

    include "../../../vendor/autoload.php";
    if (isset($_GET["fetch"])) {
        $table = new Poems();

        if($table->createJson()){
            $email = new Email("MyLove Synced", "Table " . Poems::TABLE_NAME);
            $email->send();
            header("Location: ../json/" . Poems::JSON_NAME);
        }else{
            echo "false";
        }
    }

