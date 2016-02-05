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
            $table->htmlDecode($decoded);
            $current = $data[$i];
            $builder->buildCell($current->getMemory())->buildCell($current->getSynced());
            $builder->addActionAttrs("memory", $decoded->getMemory())->addActionAttrs("id", $decoded->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>