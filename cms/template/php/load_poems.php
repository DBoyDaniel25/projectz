<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/3/16
     * Time: 7:06 PM
     */

    use Backend\Database\Tables\Poems;
    use Backend\Helpers\TableBuilder;

    include "vendor/autoload.php";

    $table   = new Poems();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);

            $current = $data[$i];
            $builder->buildCell($current->getName())->
                      buildCell($current->getPoem())->
                      buildCell($current->getDate())->
                      buildCell($current->getAuthor())->
                      buildCell($current->getSynced()
            );
            $builder->addActionAttrs("name", $decoded->getName())->
                      addActionAttrs("id", $decoded->getId())->
                      addActionAttrs("poem", $decoded->getPoem())->
                      addActionAttrs("author", $decoded->getAuthor());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>