<?php


class couponController extends Controller
{

    /**
     * clientsController constructor.
     * @param object|bool $object
     */

    function __construct($object = null)
    {
        parent::__construct('Coupon', $object);
    }


    /**
     * @param object|array $data
     * @param string|null $type
     * @return int|bool
     */

    function insert($data, $type = null)
    {

        $retVal = false;

        $couponData = new Coupon();
        unset($data->email_conferma);
        $couponData->setProperties($data);
        $tmpModel = new Coupon();
        $checkDouble = $tmpModel->findAll('email = :email', array(':email' => $couponData->properties->email), null, 1);

        $checkDoubleCode = $tmpModel->findAll('coupon_number = :coupon_number', array(':coupon_number' => $couponData->properties->coupon_number), null, 1);

        if($checkDoubleCode && !empty($checkDoubleCode)){
            $retVal = 'doubleCode';
        }
        else{
            if ($checkDouble && !empty($checkDouble)) {
                $retVal = 'doubleEmail';
            }
            else {

                $couponData->properties->id_cliente = $couponData->save();
                $retVal = $couponData->properties;
                // EMAIL AUTOMATICA
                $emailData = new stdClass;
                $email = new emailController();
                $email->sendMail($data, 'sendCode');

            }
        }

        return $retVal;

    }
    /*
    function remove($id)
    {
        $this->getModel()->findByPk($id);
        return $this->getModel()->delete();
    }

    function insertSingle($data, $type = null)
    {
        $retVal = false;
        $clientData = new Client();
        unset($data->email_conferma);
        $clientData->setProperties($data);
        $tmpModel = new Client();
        $checkDouble = $tmpModel->findAll('cliente_email = :email and fk_evento_id = :evento', array(':email' => $clientData->properties->cliente_email, ':evento' => $clientData->properties->fk_evento_id), null, 1);
        if ($checkDouble && !empty($checkDouble)) {
            $clientData->properties->id_cliente = $clientData->save();
            $retVal = $clientData->properties;
        }
        return $retVal;
    }


    function getAllClients()
    {
        $clientData = false;
        $clientRetVal = false;

        $rawData = $this->getModel()->findAll();

        if ($rawData && !empty($rawData)) {
            if (isset($rawData[0])) {
                $clientData = $rawData;
            } else {
                $clientData[0] = $rawData;
            }

            foreach ($clientData as $client) {
                $tmpClient = new Client();
                $tmpClient->setProperties($client);
                $tmpEvent = new Event();
                $tmpEvent->findByPk($client['fk_evento_id']);
                $tmpClient->properties->event = $tmpEvent->properties;
                $clientRetVal[] = $tmpClient->properties;
                unset($tmpClient);
                unset($tmpEvent);
            }
        }

        return $clientRetVal;
    }
    */
    /**
     * @param int $id
     * @return object|array|bool
     */
    /*
    function getSingleClient($id)
    {
        $retVal = false;

        $this->getModel()->findByPk($id);
        if ($this->getModel()->properties && !empty($this->getModel()->properties)) {
            $retVal = $this->getModel()->properties;
        }

        return $retVal;

    }

       */

}