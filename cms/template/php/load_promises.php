<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:01 PM
     */

    use Backend\Database\Tables\Promises;
    use Backend\Helpers\TableBuilder;

    include "vendor/autoload.php";

    $table   = new Promises();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($data[$i]);

            $current = $data[$i];
            $builder->buildCell($decoded->getPromise())->buildCell($decoded->getSynced());
            $builder->addActionAttrs("promise", $current->getPromise())->addActionAttrs("id", $current->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>