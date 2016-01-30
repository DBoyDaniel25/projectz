<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 12:05 PM
     */


    include "../vendor/autoload.php";

    $table = new \Backend\Database\Tables\ILove();
    $data  = $table->readAll();

    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $currentEncoded = $data[$i];
            $decoded        = clone $currentEncoded;

            echo "<tr data-id=\"{$currentEncoded->getId()}\">";
            echo "<td>{$decoded->getLove()}</td>";
            echo "<td>{$decoded->getSynced()}</td>";
            echo "<td>";
            echo "<input class='edit' data-id=\"{$currentEncoded->getId()}\" data-ilove=\"{$currentEncoded->getLove()}\" type=\"image\" src=\"images/icn_edit.png\" title=\"Edit\">";
            echo "<input class='delete' data-id=\"{$currentEncoded->getId()}\" type=\"image\" src=\"images/icn_trash.png\" title=\"Trash\">";
            echo "</td>";

            echo "</tr>";

        }
    }
?>