<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    //var for template
    protected $vars = array();
    //var for title page
    protected $title = FALSE;

    protected $description = FALSE;
    //var for template
    protected $template = FALSE;

    /**
     * SiteController constructor.
     */
    public function __construct()
    {
        return true;
    }


    /**
     * @return $this
     */
    protected function renderOutput()
    {

        //add title
        $this->vars = array_add($this->vars, 'title', $this->title);
        //add description
        $this->vars = array_add($this->vars, 'description', $this->description);

        //render view
        return view($this->template)->with($this->vars);
    }
}
