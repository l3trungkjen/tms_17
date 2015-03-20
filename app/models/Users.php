<?php

use Phalcon\DI;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Relation;

class Users extends \Phalcon\Mvc\Model
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
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $fullname;

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

    const STATUS_ADMIN = 0;
    const STATUS_USER = 1;
    const ACTION_NEW = 'new';
    const CTRL_USER = 'users';

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'username' => 'username',
            'password' => 'password',
            'fullname' => 'fullname',
            'created' => 'created',
            'status' => 'status',
            'confirmation' => 'confirmation'
        ];
    }

    public function validation()
    {
        if (!empty($this->confirmation)) {
            if (strcmp($this->password, $this->confirmation) !== 0) {
                $this->_errorMessages[] = new Message('Confirmation must be the same Password', 'password', 'Hash');
            }
        }
        return $this->validationHasFailed() != true;
    }

    public function beforeValidationOnCreate()
    {
        $this->created = date('Y-m-d H:i:s');
        $this->status = self::STATUS_USER;
    }

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Activities',
            'user_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }

    public static function checkPermission()
    {
        $session = Di::getDefault()->getSession();
        if ($session->has('user_id')) {
            $user = self::findFirst($session->get('user_id'));
            return ((int)$user->status === self::STATUS_ADMIN) ? true : false;
        }
        return false;
    }

    public static function fetchByUsernamePassword($request)
    {
        return self::findFirst(
            [
                'conditions' => 'username=:username: AND password=:password:',
                'bind' => [
                    'username' => $request['username'],
                    'password' => $request['password']
                ]
            ]
        );
    }

}
