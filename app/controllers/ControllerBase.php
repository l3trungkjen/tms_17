<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        if (strcmp($this->router->getControllerName(), Users::CTRL_USER) !== 0 || strcmp($this->router->getActionName(), Users::ACTION_NEW) !== 0) {
            $user_id = $this->session->get('user_id');
            if (empty($user_id)) {
                return $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action' => 'index'
                    ]
                );
            }
            $this->view->user = Users::findFirst($user_id);
        }
    }

    public function activities($user_id = '', $task_id  = '')
    {
        if (!empty($user_id)) {
            $activitie = new Activities();
            $activitie->user_id = $user_id;
            $activitie->task_id = !empty($task_id) ? $task_id : '';
            $activitie->temp_type = (!empty($user_id) && !empty($task_id)) ? 'Completed' : 'Change Profile';
            if (!$activitie->save()) {
                foreach ($activitie->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }
        }
    }
}