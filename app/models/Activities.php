<?php

class Activities extends \Phalcon\Mvc\Model
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
    public $user_id;

    /**
     *
     * @var integer
     */
    public $task_id;

    /**
     *
     * @var integer
     */
    public $subject_id;

    /**
     *
     * @var integer
     */
    public $course_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var string
     */
    public $temp_type;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'user_id' => 'user_id',
            'task_id' => 'task_id',
            'subject_id' => 'subject_id',
            'course_id' => 'course_id',
            'created' => 'created',
            'temp_type' => 'temp_type'
        ];
    }

    public function initialize()
    {
        $this->belongsTo('user_id', 'Users', 'id');
        $this->belongsTo('course_id', 'Courses', 'id');
        $this->belongsTo('subject_id', 'Subjects', 'id');
        $this->belongsTo('task_id', 'Tasks', 'id');
    }

    public function beforeValidationOnCreate()
    {
        $this->created = date('Y-m-d H:i:s');
    }

}
