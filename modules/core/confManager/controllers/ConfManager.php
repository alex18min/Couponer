<?php

/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 28/02/15
 * Time: 12.15
 */


class ConfManager{
    private $classDirs = array();

    /**
     * @param array $classDirs
     */
    function __construct($classDirs,$siteRoot=null){
        $this->setClassDirs($classDirs);
    }

    /**
     * @param array $classDirs
     */
    public function setClassDirs($classDirs){
        $this->classDirs = $classDirs;
    }

    /**
     * @return array
     */
    public function getClassDirs(){
        return $this->classDirs;
    }

    /**
     * @param string $class
     * @throws Exception
     */
    public function autoLoader($class){
        $biExc = 'Class name Mandatory!';
        try {
            //$class=null;
            if (!$class) {
                throw new ExceptionManager($biExc, 101, 1);
            }
            $classFile = $class . '.php';
            foreach ($this->getClassDirs() as $dir) {
                $fileinfos = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($dir)
                );
                foreach ($fileinfos as $pathname => $fileinfo) {
                    if (!$fileinfo->isFile()){
                        continue;
                    }
                    elseif ($fileinfo->getFilename() == $classFile) {
                        include($fileinfo);
                    }
                }
            }
        } catch (ExceptionManager $e) {
            throw $e;
        }
    }

    public function exceptionHandler($e){
        $oException = new ExceptionManager('Uncaught exception occurred!', 001, 0, $e->getFile(), $e->getLine());
        echo $oException->getCustomMessage();
    }

    public function errorHandler($errno, $errstr, $errfile, $errline){
        $oException = new ExceptionManager('Script Error: ' . $errstr, 100, 1, $errfile, $errline);
        echo $oException->getCustomMessage();
    }
}