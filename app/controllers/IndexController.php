<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->courses = Courses::find();
    }

}

