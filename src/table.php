<?php
    global $table; 
    $table = '';
            for($i = 0; $i < 15; $i++) {
                $rowLine = '<tr>';
                for($j = 0; $j < 20; $j++) {
                    $rowLine .= "<td class='note'><button value='$i" . "x" . "$j' id='$i" . "x" . "$j' class='btnFree'></button></td>";
                }
                $table .= "$rowLine</tr>";
            }
?>