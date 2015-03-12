<?php

class CoursesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->courses = Courses::find();
    }

    public function newAction()
    {
        $arr_supervisors[''] = 'Please, Choose supervisor...';
        foreach (Supervisors::find() as $supervisor) {
            $arr_supervisors[$supervisor->id] = $supervisor->name;
        }
        $arr_subjects[''] = 'Please, Choose subject...';
        foreach (Subjects::find() as $subject) {
            $arr_subjects[$subject->id] = $subject->name;
        }
        $this->view->subjects = $arr_subjects;
        $this->view->supervisors = $arr_supervisors;
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
            return $this->redirect->response('course');
        }
        $course = Courses::findFirst($id);
        $arr_supervisors[''] = 'Please, Choose supervisor...';
        foreach (Supervisors::find() as $supervisor) {
            $arr_supervisors[$supervisor->id] = $supervisor->name;
            if ($supervisor->id == $course->supervisor_id) {
                $this->tag->setDefault('supervisor_id', $supervisor->id);
            }
        }
        $arr_subjects[''] = 'Please, choose subject...';
        foreach (Subjects::find() as $subject) {
            $arr_subjects[$subject->id] = $subject->name;
            foreach ($course->coursesubjects as $course_subject) {
                if ($subject->id !== $course_subject->subject_id) continue;
                $this->tag->setDefault('subject_id[' . $course_subject->id . ']', $subject->id);
            }
        }
        $this->view->course = $course;
        $this->view->supervisors = $arr_supervisors;
        $this->view->subjects = $arr_subjects;
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

