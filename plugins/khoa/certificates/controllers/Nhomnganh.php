<?php namespace Khoa\Certificates\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Nhomnganh extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Khoa.Certificates', 'main-menu-item');
    }
}
