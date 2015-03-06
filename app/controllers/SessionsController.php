<?php

class SessionsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if (Users::checkPermission()) {
            return $this->response->redirect();
        }
        $this->view->user = !empty($this->session->get('user_id')) ? Users::findFirst($this->session->get('user_id')) : null;
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $user = Users::fetchByUsernamePassword($request);
            if ($user) {
                $this->session->set('user_id', $user->id);
                $this->session->set('status', $user->status);
                return $this->response->redirect();
            } else {
                $this->flash->error('Email or Password incorrect.');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'sessions',
                        'action' => 'index'
                    ]
                );
            }
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect();
    }
}

