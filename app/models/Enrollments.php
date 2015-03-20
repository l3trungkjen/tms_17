<?php

use Phalcon\Mvc\Model\Relation;

class Enrollments extends \Phalcon\Mvc\Model
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
    public $course_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'user_id' => 'user_id',
            'course_id' => 'course_id',
            'created' => 'created'
        ];
    }

    public function beforeValidationOnCreate()
    {
        $this->created = date('Y-m-d H:i:s');
    }

    public function initialize()
    {
        $this->belongsTo('user_id', 'Users', 'id');
        $this->belongsTo('course_id', 'Courses', 'id');
        $this->hasMany(
            'id',
            'EnrollmentSubjects',
            'enrollment_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }

    public static function fetchByUserCourse($user_id, $course_id)
    {
        return self::findFirst(
            [
                'conditions' => 'user_id=:user_id: AND course_id=:course_id:',
                'bind' => [
                    'user_id' => $user_id,
                    'course_id' => $course_id
                ]
            ]
        );
    }

}
