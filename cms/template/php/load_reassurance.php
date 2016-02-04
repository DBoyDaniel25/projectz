<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 5:02 PM
     */

    use Backend\Database\Tables\Reassurance;
    use Backend\Helpers\TableBuilder;

    include "vendor/autoload.php";

    $table   = new Reassurance();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->htmlDecode($decoded);
            $current = $data[$i];
            $builder->buildCell($current->getReassure())->buildCell($current->getSynced());
            $builder->addActionAttrs("reassure", $decoded->getReassure())->addActionAttrs("id", $decoded->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>