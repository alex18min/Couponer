<?php

/**
 * Class emailController
 */
class emailController extends Controller
{

    /**
     * emailController constructor.
     * @param object|bool $object
     */

    function __construct($object = null)
    {
        parent::__construct('Email', $object);
    }

    /**
     * @param object|array $data
     * @param string $type
     * @return bool
     * @throws phpmailerException
     */


    function sendMail($data, $type)
    {

        if (!$type) {
            $type = 'sendCode';
        }

        require_once('modules/app/email/libs/phpMailer/class.phpmailer.php');
        require_once('modules/app/email/libs/phpMailer/class.smtp.php');

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = "box692.bluehost.com";
        $mail->SMTPAuth = true;
        $mail->Username = "couponer@alexcarletto.com";
        $mail->Password = "Master0fPuppet$";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->From = "info@alexcarletto.com";
        $mail->FromName = "Couponer";
        $mail->addAddress($data->email);

        //$mail->addBCC('gelatofestival@zenaispromo.it', 'Gelato Festival by Zenais');

        $mail->isHTML(true);

        switch ($type) {
            case 'sendCode':
                $mail->Subject = 'Il tuo codice Coupon';
                break;
        }

        $mail->Body = $this->getEmailBody($type, $data);

        $mail->AltBody = "";



        $retVal = $mail->send();

        return $retVal;

    }

    /**
     * @param string $type
     * @param object|array|null $data
     * @return null|string
     */

    function getEmailBody($type, $data = null)

    {

        $body = null;

        switch ($type) {
            case 'sendCode':



                $code = $data->coupon_number;

                $body = <<<EOT
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        td {
            font-size:14px;
        }
    </style>
</head>
<body bgcolor="#fff">
<table width="600" align="center" style="font-family: 'Open Sans', sans-serif;">
<tr><td>
<img style="margin-bottom: 20px;" src="http://www.alexcarletto.com/wp-content/uploads/2016/09/back4.jpg" />
</td></tr>

 <tr><td>
 <p style="text-align:justify;">Gentile cliente,<br />
 Ecco il tuo codice coupon: $code
</p>
 </td></tr>

</table>
</body>
</html>
EOT;
                break;

        }

        return $body;

    }

    function processDate($date)
    {
        $chunks = explode(' ', $date);
        $dateChunk = $chunks[0];
        $dateElements = explode('-', $dateChunk);
        return $dateElements[2] . '/' . $dateElements[1] . '/' . $dateElements[0];
    }


}

