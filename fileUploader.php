<?php

$codice = null;
$nome = null;
$cognome = null;

if (!isset($_POST['type'])) {

    if (isset($_POST['codice'])) {
        $codice = $_POST['codice'];
    }
    if (isset($_POST['nome'])) {
        $nome = strtolower($_POST['nome']);
    }
    if (isset($_POST['cognome'])) {
        $cognome = strtolower($_POST['cognome']);
    }

    $filename = $codice . '_' . $nome . '_' . $cognome . '.pdf';
    $destination = 'uploads/' . $filename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        return $destination;
    } else {
        return false;
    }
} else {
    $type = $_POST['type'];

    switch ($type) {

        case 'excel':

            $filename = $_POST['nome'];
            $file = $_FILES['file']['tmp_name'];
            $destination = 'exports/'.$filename;

            if (move_uploaded_file($file, $destination)) {
                return $destination;
            } else {
                return false;
            }

            break;

    }

}
