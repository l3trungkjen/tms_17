<?php

class UsersController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->users = Users::find();
    }

    public function newAction()
    {
        if (Users::checkPermission()) {
            return $this->response->redirect();
        }
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request) && !Users::checkPermission()) {
            $user = new Users();
            if (!$user->save($request)) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message);
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'users',
                            'action' => 'new'
                        ]
                    );
                }
            } else {
                $this->session->set('user_id', $user->id);
                $this->session->set('status', $user->status);
            }
        };
        return $this->response->redirect();
    }

    public function editAction($id = '')
    {
        $this->view->profile = Users::findFirst($id);
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $user = Users::findFirst($request['id']);
            if (!$user->save($request)) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('User was edited successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'users',
                    'action' => 'edit',
                    'params' => [$user->id]
                ]
            );
        }
        return $this->response->redirect();
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $user = Users::findFirst($id);
            if (!empty($user)) {
                (!$user->delete()) ? $this->flash->error('User delete failure.') : $this->flash->success('User was deleted successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'users',
                'action' => 'index'
            ]
        );
    }
}

