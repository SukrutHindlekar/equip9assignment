<?php

namespace App\Controllers;

use App\Core\MyController;
use App\Models\Sitefunction;

class Index extends MyController
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->utc_time = date('Y-m-d H:i:s');
        $this->utc_date = date('Y-m-d');
        $this->dataModule = array();
        $this->dataModule['controller'] = $this;
    }

    public function index()
    {
        echo view('index/index', $this->dataModule);
    }
}
