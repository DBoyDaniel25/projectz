<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:53 PM
     */

    use Backend\Database\Tables\Memory;
    use Backend\Helpers\TableBuilder;

    include "vendor/autoload.php";

    $table   = new Memory();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($data[$i]);

            $current = $data[$i];
            $builder->buildCell($decoded->getMemory())->buildCell($decoded->getSynced());
            $builder->addActionAttrs("memory", $current->getMemory())->addActionAttrs("id", $current->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>