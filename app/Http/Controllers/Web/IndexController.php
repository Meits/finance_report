<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends SiteController
{
    //
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        //template
        $this->template = 'public::pages';
    }

    /**
     *
     */
    public function index()
    {
        return $this->renderOutput();
    }
}
