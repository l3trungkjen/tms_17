<?php

use Phalcon\Mvc\Model\Relation;

class EnrollmentSubjects extends \Phalcon\Mvc\Model
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
    public $enrollment_id;

    /**
     *
     * @var integer
     */
    public $course_id;

    /**
     *
     * @var integer
     */
    public $subject_id;

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
            'enrollment_id' => 'enrollment_id',
            'course_id' => 'course_id',
            'subject_id' => 'subject_id',
            'user_id' => 'user_id',
            'status' => 'status'
        ];
    }

    public function beforeValidationOnCreate()
    {
        $this->status = self::STATUS_INACTIVE;
    }

    public function initialize()
    {
        $this->belongsTo('course_id', 'Courses', 'id');
        $this->belongsTo('subject_id', 'Subjects', 'id');
        $this->belongsTo('user_id', 'Users', 'id');
        $this->hasMany(
            'id',
            'EnrollmentSubjectTasks',
            'enrollment_subject_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }

}
