<?php

class SupervisorsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if (!Users::checkPermission()) {
            return $this->response->redirect();
        }
        $this->view->supervisors = Supervisors::find();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        if (!Users::checkPermission()) {
            return $this->response->redirect();
        }
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $supervisor = new Supervisors();
            if (!$supervisor->save($request)) {
                foreach ($supervisor->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('Supervisor was created successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'supervisors',
                    'action' => 'new'
                ]
            );
        }
        return $this->request->redirect();
    }

    public function editAction($id = '')
    {
        if (!Users::checkPermission()) {
            return $this->response->redirect();
        }
        if (empty($id)) {
            return $this->response->redirect('supervisors');
        }
        $this->view->supervisor = Supervisors::findFirst($id);
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $supervisor = Supervisors::findFirst($request['id']);
            if (!$supervisor->save($request)) {
                foreach ($supervisor->getMessages() as $message) {
                    $this->flash->error($message);
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'supervisors',
                            'action' => 'edit',
                            'params' => [$request['id']]
                        ]
                    );
                }
            } else {
                $this->flash->success('Supervisor was edited successfully.');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'supervisors',
                        'action' => 'index'
                    ]
                );
            }
        }
        return $this->response->redirect('supervisors');
    }

    public function deleteAction($id = '')
    {
        if (!Users::checkPermission()) {
            return $this->response->redirect();
        }
        if (!empty($id)) {
            $supervisor = Supervisors::findFirst($id);
            if (!empty($supervisor)) {
                (!$supervisor->delete()) ? $this->flash->error('Supervisor delete failure.') : $this->flash->success('Supervisor was deleted successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'supervisors',
                'action' => 'index'
            ]
        );
    }
}

