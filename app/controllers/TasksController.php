<?php

class TasksController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->tasks = Tasks::find();
    }

    public function newAction()
    {
        $this->view->subjects = Subjects::findList();
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
        if (empty($id)) {
            return $this->response->redirect('tasks');
        }
        $task = Tasks::findFirst($id);
        if (empty($task)) {
            return $this->response->redirect('tasks');
        }
        $this->view->subjects = Subjects::findList();
        $this->view->task = $task;
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

