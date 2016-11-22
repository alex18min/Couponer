<?php

require_once('config/requirements.php');

$email = $_GET['email'];

$tmpModel = new Client();
$data = $tmpModel->findAll('cliente_email = :email', array(':email' => $email), null, 1);
$tmpModel->setProperties($data);
if($tmpModel->delete()){
    echo 'La cancellazione dell\'indirizzo è stata effettuata correttamente.';
}else {
    echo 'C\'è stato un problema nella procedura di cancellazione. Contatta l\'assistenza all\'indirizzo e-mail xy';
}


