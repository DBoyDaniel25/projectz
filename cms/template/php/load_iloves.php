<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 1:01 PM
     */

    use Backend\Database\Tables\ILove;
    use Backend\Helpers\TableBuilder;

    include "vendor/autoload.php";

    $table   = new ILove();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($data[$i]);

            $current = $data[$i];
            $builder->buildCell($decoded->getLove())->
                      buildCell($decoded->getSynced()
            );
            $builder->addActionAttrs("ilove", $current->getLove())->addActionAttrs("id", $current->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>