<?php

class Controller
{
    public $view = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        //$this->view = new View();
    	$this->view = TemplatesFactory::templates();
        Session::init();
    }

}
