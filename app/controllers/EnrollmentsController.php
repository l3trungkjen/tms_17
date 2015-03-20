<?php

class EnrollmentsController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function newAction($course_id = '')
    {
        $user_id = $this->session->get('user_id');
        if (empty($course_id)) {
            return $this->response->redirect();
        }
        $course = Courses::findFirst($course_id);
        if (empty($course)) {
            return $this->response->redirect();
        }
        $enrollment = Enrollments::fetchByUserCourse($user_id, $course_id);
        if (!$enrollment) {
            $enrollment = new Enrollments();
            $enrollment->user_id = $user_id;
            $enrollment->course_id = $course->id;
            if (!$enrollment->save()) {
                foreach ($enrollment->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                foreach ($course->coursesubjects as $course_subjects) {
                    $enrollment_subjects = new EnrollmentSubjects();
                    $enrollment_subjects->enrollment_id = $enrollment->id;
                    $enrollment_subjects->course_id = $course_subjects->course_id;
                    $enrollment_subjects->subject_id = $course_subjects->subject_id;
                    $enrollment_subjects->user_id = $user_id;
                    if (!$enrollment_subjects->save()) {
                        foreach ($enrollment_subjects->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    }
                }
            }
        }
        return $this->response->redirect('enrollments/view/' . $enrollment->id);
    }

    public function viewAction($id = '')
    {
        if (empty($id)) {
            return $this->response->redirect();
        }
        $this->view->enrollment = Enrollments::findFirst($id);
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        $user_id = $this->session->get('user_id');
        $flag = false;
        if (!empty($request)) {
            foreach ($request['enrollment_subject_id'] as $enrollment_subject_id) {
                if (!isset($request['task_id'][$enrollment_subject_id])) continue;
                foreach ($request['task_id'][$enrollment_subject_id] as $task_id) {
                    $enrollment_subject_task = new EnrollmentSubjectTasks();
                    $enrollment_subject_task->enrollment_subject_id = $enrollment_subject_id;
                    $enrollment_subject_task->user_id = $user_id;
                    $enrollment_subject_task->task_id = $task_id;
                    if (!$enrollment_subject_task->save()) {
                        foreach ($enrollment_subject_task->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    } else {
                        $this->activities($user_id, $task_id);
                        $flag = true;
                    }
                }
            }
            if ($flag) {
                $this->flash->success('Enrollments was updated successfully.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'enrollments',
                    'action' => 'view',
                    'params' => [$request['enrollment_id']]
                ]
            );
        }
        return $this->response->redirect();
    }

}

