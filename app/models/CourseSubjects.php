<?php

class CourseSubjects extends \Phalcon\Mvc\Model
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
    public $course_id;

    /**
     *
     * @var integer
     */
    public $subject_id;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'course_id' => 'course_id',
            'subject_id' => 'subject_id',
            'status' => 'status'
        ];
    }

    public function initialize()
    {
        $this->belongsTo('subject_id', 'Subjects', 'id');
        $this->belongsTo('course_id', 'Courses', 'id');
    }

    public function beforeValidationOnCreate()
    {
        $this->status = self::STATUS_ACTIVE;
    }

}
