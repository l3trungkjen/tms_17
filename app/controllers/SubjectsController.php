<?php

class SubjectsController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->subjects = Subjects::find();
    }

    public function newAction()
    {

    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $subject = new Subjects();
            if (!$subject->save($request)) {
                foreach ($subject->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('Subject was created successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'subjects',
                    'action' => 'new'
                ]
            );
        }
        return $this->response->redirect();
    }

    public function editAction($id = '')
    {
        if (empty($id)) {
            return $this->response->redirect('subjects');
        }
        $subject = Subjects::findFirst($id);
        if (empty($subject)) {
            return $this->response->redirect('subjects');
        }
        $this->view->subject = Subjects::findFirst($id);
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $subject = Subjects::findFirst($request['id']);
            if (!$subject->save($request)) {
                foreach ($subject->getMessages() as $message) {
                    $this->flash->error($message);
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'subjects',
                            'action' => 'edit',
                            'params' => [$subject->id]
                        ]
                    );
                }
            } else {
                $this->flash->success('Subject was edited successfully.');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'subjects',
                        'action' => 'index'
                    ]
                );
            }
        }
        return $this->response->redirect();
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $subject = Subjects::findFirst($id);
            if (!empty($subject)) {
                (!$subject->delete()) ? $this->flash->error('Subject delete failure.') : $this->flash->success('Subject was deleted successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'subjects',
                'action' => 'index'
            ]
        );
    }

    public function viewAction()
    {
        $this->view->subjects = Subjects::findList();
    }

}

