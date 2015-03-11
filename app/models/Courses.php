<?php

use Phalcon\Mvc\Model\Relation;

class Courses extends \Phalcon\Mvc\Model
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
    public $supervisor_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $created;

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
            'supervisor_id' => 'supervisor_id',
            'name' => 'name',
            'description' => 'description',
            'created' => 'created',
            'status' => 'status'
        ];
    }

    public function beforeValidationOnCreate()
    {
        $this->created = date('Y-m-d H:i:s');
        $this->status = self::STATUS_ACTIVE;
    }

    public function initialize()
    {
        $this->belongsTo('supervisor_id', 'Supervisors', 'id');
        $this->hasMany(
            'id',
            'CourseSubjects',
            'course_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }

}
