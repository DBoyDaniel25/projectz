<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/3/16
     * Time: 7:06 PM
     */

    use Backend\Database\Tables\Poems;
    use Backend\Helpers\TableBuilder;


    $table   = new Poems();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $current = $data[$i];
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($current);

            $builder->buildCell($decoded->getName())->
                      buildCell($decoded->getPoem())->
                      buildCell($decoded->getDate())->
                      buildCell($decoded->getAuthor())->
                      buildCell($decoded->getSynced());

            $builder->addActionAttrs("name", $current->getName())->
                      addActionAttrs("id", $current->getId())->
                      addActionAttrs("poem", $current->getPoem())->
                      addActionAttrs("author", $current->getAuthor());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>