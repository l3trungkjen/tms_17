<?php

class SupervisorsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->supervisors = Supervisors::find();
    }

    public function newAction()
    {

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
        if (empty($id)) {
            return $this->response->redirect('supervisors');
        }
        $this->view->supervisor = Supervisors::findFirst($id);
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

