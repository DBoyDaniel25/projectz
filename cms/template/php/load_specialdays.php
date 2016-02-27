<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 6:45 PM
     */
    use Backend\Database\Tables\SpecialDays;
    use Backend\Helpers\TableBuilder;

    $table   = new SpecialDays();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($data[$i]);

            $current = $data[$i];
            $builder->buildCell($decoded->getDate())->buildCell($decoded->getMessage())->buildCell($decoded->getSynced());
            $builder->addActionAttrs("date", $current->getDate())->
            addActionAttrs("id", $current->getId())->addActionAttrs("message", $current->getMessage());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>