<?php

// $timestart=microtime(true);
prog($argv, $argc);
// $timeend=microtime(true);
// $time=$timeend-$timestart;

// $page_load_time = number_format($time, 3);
// // echo "Debut du script: ".date("H:i:s", $timestart);
// // echo "Fin du script: ".date("H:i:s", $timeend);
// echo "Script execute en " . $page_load_time . " sec";

function prog ($argv, $argc) {

    $la = get_tab($argv, $argc);
    $lb = [];
    // echo $argc;
    $sort = false;
    $sort = check($la);
    $size_la = count($la);
    $tour = 1;

    $algo = "";
    if (count($la) < 2) {
        echo PHP_EOL;
        return;
    }
    elseif($sort == true){
        echo PHP_EOL;
        return;
    }
    else{
        // var_dump(check($la));
        while ($tour < $size_la){
            get_min($la, $lb, $algo);
            if ($la != []){
                pb($la, $lb, $algo);
            }
            // print_r($la);
            // print_r($lb);

            $tour++;
        }
        full_push_lb($la, $lb, $algo);
        $algo = rtrim($algo);
        echo($algo);
        echo PHP_EOL;
        // print_r($la);
        return $la;
    }
}

function full_push_lb(&$la, &$lb, &$algo){
    while ($lb != []){
        pa($lb, $la, $algo);
    }
}

function push_X_tour(&$la, &$lb, &$tour){
    $i = 0;
    while ($i < $tour){
        pb($la, $lb);
        $i++;
    }
}
// push la dans lb sauf le plus grand
function get_min(&$la, &$lb, &$algo){
    if ($la == []){
        return;
    }
    $min = min($la);
    if (isset($la[1])== true){
        if ($la[0] == $min && $la[1] == $min){
            pb($la, $lb, $algo);
        }
    }
    while ($la[0] != $min){
        ra($la, $algo);
    }
}

// check si trié
function check($array) {
    for ($i = 0; $i < count($array) - 1; $i++){
        for ($j = $i+1; $j <count($array); $j++){
            if ($array[$i] > $array[$j]) {
                return false;
            }
        }
    }
    return true;
}
// recupere les arguments et les passes dans le tableau $la
function get_tab ($argv, $argc) {

    $la = [];
    for ($i = 1; $i <$argc; $i++){
        array_push($la, $argv[$i]);
    }
    // print_r ($la);
    return $la;
}

// swap 2 valeurs du premier tableau
function sa(&$array , $index1 , $index2, &$algo){
    if (count($array) < 2)
    {
        return null;
    }
    $temp = 0;
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
    // print_r($array);
    $algo.="sa ";
}

// swap 2 valeurs du deuxieme tableau
function sb(&$array2 , $index1 , $index2, &$algo){
    if (count($array2) < 2)
    {
        return null;
    }
    $temp = 0;
    $temp = $array2[$index1];
    $array2[$index1] = $array2[$index2];
    $array2[$index2] = $temp;
    // print_r($array2);
    $algo.="sb ";
}

// sa et sb en même temps
function sc (&$array1, &$array2, &$algo) {
    sa($array1, 0, 1);
    sb($array2, 0, 1);
    $algo.="sc ";
}

//prend le premier élément de lb et le place à la première position de la (rien ne se produit si 1 la est vide).
function pa (&$array2, &$array1, &$algo) {
    $val1 = array_shift($array2);
    array_unshift($array1, $val1);
    $algo.="pa ";
}

//prend le premier élément de la et le place à la première position de lb (rien ne se produit si 1 la est vide).
function pb (&$array1, &$array2, &$algo) {
    $val1 = array_shift($array1);
    array_unshift($array2, $val1);
    $algo.= "pb ";
}

// fait une rotation de la vers le début. (le premier élément devient le dernier)
function ra (&$array1, &$algo) {
    $val1 = array_shift($array1);
    array_push($array1, $val1);
    $algo.="ra ";
}

// fait une rotation de lb vers le début (le premier élément devient le dernier).

function rb (&$array2, &$algo) {
    $val1 = array_shift($array2);
    array_push($array2, $val1);
    $algo.="rb ";
}

// ra et rb en même temps.
function rr (&$array1, &$array2, &$algo) {
    ra($array1);
    rb($array2);
    $algo.="rr ";
}

// fait une rotation de la vers la fin. (le dernier élément devient le premier).
function rra (&$array1, &$algo) {
    $val1 = array_pop($array1);
    array_unshift($array1, $val1);
    $algo.="rra ";
}

// fait une rotation de lb vers la fin. (le dernier élément devient le premier).
function rrb(&$array2, &$algo) {
    $val1 = array_pop($array2);
    array_unshift($array2, $val1);
    // print_r($array2).PHP_EOL;
    $algo.="rrb ";
}

// rra et rrb en même temps
function rrr (&$array1, &$array2, &$algo) {
    rra($array1, $algo);
    rrb($array2, $algo);
    $algo.="rrr ";
}