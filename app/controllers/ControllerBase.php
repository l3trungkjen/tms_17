<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        if (strcmp($this->router->getControllerName(), Users::CTRL_USER) !== 0 || strcmp($this->router->getActionName(), Users::ACTION_NEW) !== 0) {
            if (!Users::checkPermission()) {
                return $this->response->redirect();
            }
            $this->view->user = Users::findFirst($this->session->get('user_id'));
        }
    }
}