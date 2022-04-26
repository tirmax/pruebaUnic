<?php

# valores iniciales en 0
$dic = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
];

$miArray = [1, 2, 1, 3, 3, 1, 2, 1, 5, 1];

#recorremos arreglo y aumentamos el valor del dic si se encuentra el numero
foreach ($miArray as $num) {
    $dic[$num]++;
}

#recorremos el dic para sacar la clave y el valor
foreach ($dic as $clave => $ast) {
    echo "$clave: ";

    for ($i = 0; $i < $ast; $i++) {
        echo "*";
    }
    //salto de linia
     echo "<br><br>";
}

?>