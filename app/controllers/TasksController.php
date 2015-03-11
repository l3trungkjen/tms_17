<?php

class TasksController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if (!Users::checkPermission()) {
            $this->response->redirect();
        }
        $this->view->tasks = Tasks::find();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        if (!Users::checkPermission()) {
            $this->response->redirect();
        }
        $arr_subjects[''] = 'Please, Choose subject...';
        foreach (Subjects::find() as $subject) {
            $arr_subjects[$subject->id] = $subject->name;
        }
        $this->view->subjects = $arr_subjects;
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $task = new Tasks();
            if (!$task->save($request)) {
                foreach ($task->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('Created was task successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'tasks',
                    'action' => 'new'
                ]
            );
        }
        return $this->response->redirect();
    }

    public function editAction($id = '')
    {
        if (!Users::checkPermission()) {
            $this->redirect->response();
        }
        if (empty($id)) {
            $this->redirect->response('tasks');
        }
        $task = Tasks::findFirst($id);
        $arr_subjects[''] = 'Please, Choose subject...';
        foreach (Subjects::find() as $subject) {
            $arr_subjects[$subject->id] = $subject->name;
            if ($subject->id == $task->subject_id) {
                $this->tag->setDefault('subject_id', $subject->id);
            }
        }
        $this->view->subjects = $arr_subjects;
        $this->view->task = $task;
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $task = Tasks::findFirst($request['id']);
            if (!$task->save($request)) {
                foreach ($task->getMessages() as $message) {
                    $this->flash->error($message);
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'tasks',
                            'action' => 'edit',
                            'params' => [$task->id]
                        ]
                    );
                }
            } else {
                $this->flash->success('Task was edited successfully.');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'tasks',
                        'action' => 'index'
                    ]
                );
            }
        }
        return $this->response->redirect();
    }

    public function deleteAction($id = '')
    {
        if (!Users::checkPermission()) {
            return $this->response->redirect();
        }
        if (!empty($id)) {
            $task = Tasks::findFirst($id);
            if (!empty($task)) {
                (!$task->delete()) ? $this->flash->error('Task was delete failure.') : $this->flash->success('Task was delete successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'tasks',
                'action' => 'index'
            ]
        );
    }

}

