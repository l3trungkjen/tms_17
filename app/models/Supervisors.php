<?php

use Phalcon\Mvc\Model\Relation;
use Phalcon\Tag;

class Supervisors extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'name' => 'name'
        ];
    }

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Courses',
            'supervisor_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }

}
