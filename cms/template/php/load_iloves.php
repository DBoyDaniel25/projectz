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
            $current = $data[$i];
            $builder->buildCell($current->getLove())->
                      buildCell($current->getSynced()
            );
            $builder->addActionAttrs("ilove", $decoded->getLove())->addActionAttrs("id", $decoded->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>