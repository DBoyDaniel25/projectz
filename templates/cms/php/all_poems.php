<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/9/16
     * Time: 10:00 PM
     */

    use Backend\Database\Tables\Poems;

    include "../vendor/autoload.php";

    $table = new Poems();
    $data = $table->readAll();

    if($data !== false){
        for($i = 0; $i < count($data); $i++){
            $currentEncoded = $data[$i];
            $shortenedPoem = substr($currentEncoded->getPoem(), 0, 200);
            $decoded = clone $currentEncoded;
            $table->htmlDecode($decoded);

            echo "<tr data-id=\"{$currentEncoded->getId()}\">";
            echo "<td>{$decoded->getName()}</td>";
            echo "<td>{$shortenedPoem}</td>";
            echo "<td>{$decoded->getDate()}</td>";
            echo "<td>{$decoded->getAuthor()}</td>";
            echo "<td>{$decoded->getFavourite()}</td>";
            echo "<td>";
            echo "<input class='edit' data-id=\"{$currentEncoded->getId()}\" data-name=\"{$currentEncoded->getName()}\" data-poem=\"{$currentEncoded->getPoem()}\" data-author=\"{$currentEncoded->getAuthor()}\" type=\"image\" src=\"images/icn_edit.png\" title=\"Edit\">";
            echo "<input class='delete' data-id=\"{$currentEncoded->getId()}\" type=\"image\" src=\"images/icn_trash.png\" title=\"Trash\">";
            echo "</td>";

            echo "</tr>";

        }
    }

?>