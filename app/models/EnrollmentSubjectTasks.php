<?php

class EnrollmentSubjectTasks extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $enrollment_subject_id;

    /**
     *
     * @var integer
     */
    public $task_id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var integer
     */
    public $status;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'enrollment_subject_id' => 'enrollment_subject_id',
            'task_id' => 'task_id',
            'user_id' => 'user_id',
            'status' => 'status'
        ];
    }

    public function beforeValidationOnCreate()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    public function initialize()
    {
        $this->belongsTo('task_id', 'Tasks', 'id');
        $this->belongsTo('enrollment_subject_id', 'EnrollmentSubjects', 'id');
        $this->belongsTo('user_id', 'Users', 'id');
    }

    public static function fetchUserTaskEnrollment($enrollment_subject)
    {
        return self::findFirst(
            [
                'conditions' => 'enrollment_subject_id=:enrollment_subject_id: AND task_id=:task_id: AND user_id=:user_id:',
                'bind' => [
                    'enrollment_subject_id' => $enrollment_subject['id'],
                    'task_id' => $enrollment_subject['task_id'],
                    'user_id' => $enrollment_subject['user_id']
                ]
            ]
        );
    }

}
