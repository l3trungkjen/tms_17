<?php

class ModelBase extends \Phalcon\Mvc\Model
{

    public static function findList()
    {
        $arr_objects[''] = 'Please, Choose object...';
        foreach (self::find() as $object) {
            $arr_objects[$object->id] = $object->name;
        }
        return $arr_objects;
    }

}
