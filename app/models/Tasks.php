<?php

class Tasks extends \Phalcon\Mvc\Model
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
    public $subject_id;

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
            'subject_id' => 'subject_id',
            'name' => 'name'
        ];
    }

    public function initialize()
    {
        $this->belongsTo('subject_id', 'Subjects', 'id');
    }

}
