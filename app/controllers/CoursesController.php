<?php

class CoursesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->courses = Courses::find();
    }

    public function newAction()
    {
        $this->view->subjects = Subjects::findList();
        $this->view->supervisors = Supervisors::findList();
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $course = new Courses();
            if (!$course->save($request)) {
                foreach ($course->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                foreach ($request['subject_id'] as $subject) {
                    if (empty($subject)) continue;
                    $courseSubject = new CourseSubjects();
                    $courseSubject->course_id = $course->id;
                    $courseSubject->subject_id = $subject;
                    if (!$courseSubject->save()) {
                        foreach ($courseSubject->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    }
                }
                $this->flash->success('Course was created successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'courses',
                    'action' => 'new'
                ]
            );
        }
        return $this->response->redirect('courses');
    }

    public function editAction($id = '')
    {
        if (empty($id)) {
            return $this->redirect->response('courses');
        }
        $course = Courses::findFirst($id);
        if (empty($course)) {
            return $this->response->redirect('courses');
        }
        $this->view->course = $course;
        $this->view->supervisors = Supervisors::findList();
        $this->view->subjects = Subjects::findList();
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $course = Courses::findFirst($request['id']);
            if (!$course->save($request)) {
                foreach ($course->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                foreach ($request['subject_id'] as $key => $subject) {
                    if (empty($subject)) continue;
                    $courseSubject = new CourseSubjects();
                    $courseSubject->id = $key;
                    $courseSubject->course_id = $course->id;
                    $courseSubject->subject_id = $subject;
                    if (!$courseSubject->save()) {
                        foreach ($courseSubject->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    }
                }
                $this->flash->success('Course was edited successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'courses',
                    'action' => 'edit',
                    'params' => [$course->id]
                ]
            );
        }
        return $this->response->redirect('courses');
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $course = Courses::findFirst($id);
            if (!empty($course)) {
                (!$course->delete()) ? $this->flash->error('Course delete failure.') : $this->flash->success('Course was deleted successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'courses',
                'action' => 'index'
            ]
        );
    }

}

