<?php

/**
 * Class Controller
 */
class Controller
{

    private $modelName;
    private $model;

    /**
     * Controller constructor.
     * @param string $inputModel
     * @param object|bool $object
     */

    function __construct($inputModel, $object = null)
    {
        $this->setModelName($inputModel);

        if ($object) {
            $modelName = $this->getModelName();
            $this->setModel(new $modelName($object));
        } else {
            $this->setModel();
        }

    }

    /**
     * @param object $object
     * @return array
     */

    function getSubModels($object)
    {

        $subModels = array();

        foreach ($object as $key => $value) {
            if (is_object($value)) {
                $modelName = ucfirst($key);
                $subModels[] = new $modelName($value);
                unset($object->$key);
            }
        }

        return $subModels;

    }

    /**
     * @param object|array $object
     * @param bool $fatherKey
     * @return int|bool
     */

    function saveFullObj($object, $fatherKey = false)
    {

        $retVal = false;

        $subModels = $this->getSubModels($object);
        $this->getModel()->setProperties($object);
        $savedId = $this->getModel()->save();

        $retVal = $savedId;

        foreach ($subModels as $subModel) {
            if($fatherKey) {
                $subModel->properties->father_key = $savedId;
            }
            $subModel->save();
            unset($subModel);
        }

        return $retVal;

    }


    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model = null)
    {
        $modelName = $this->getModelName();
        if ($model) {
            $this->model = $model;
            /*$this->model->setProperties($model);*/
        } else {
            $this->model = new $modelName();
        }
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * @param string $modelName
     */
    public function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

}