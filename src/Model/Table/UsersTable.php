<?php

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * @method getRandomString($int)
 */
class UsersTable extends Table
{

    public $model = 'Users';

    public $contain = [];

    public function initialize(array $config)
    {

    }

    public function getAll($conditions = [], $obj = false)
    {
        $options = [
            'contain' => $this->contain,
            'conditions' => $conditions
        ];

        $results = $this->find('all', $options);
        if (!is_null($results) && !empty($results) && !$obj) {
            $results = $results->toArray();
        }
        return $results;
    }

    public function getById($user_id = null)
    {
        $results = [];
        if (!is_null($user_id)) {
            $options = [
                'contain' => $this->contain,
                'conditions' => [$this->model . '.id' => $user_id]
            ];
            $results = $this->find('all', $options);
            if (!empty($results)) {
                $results = $results->first();
            }
        }
        return $results;
    }

    public function getByEmail($email = null)
    {
        $results = [];
        if (!is_null($email)) {
            $options = [
                'contain' => $this->contain,
                'conditions' => [$this->model . '.email' => $email]
            ];
            $results = $this->find('all', $options);
            if (!empty($results)) {
                $results = $results->first();
            }
        }
        return $results;
    }

    public function confirmUserByConfirmationToken($confirmation_token = null)
    {
        $result = false;
        if (isset($confirmation_token) && !is_null($confirmation_token)) {
            $conditions = [$this->model . '.confirmation_token' => $confirmation_token];
            $record = $this->find('all', ['conditions' => $conditions])->first();
            if (!is_null($record) && !empty($record)) {
                if (isset($record['confirmation_token_expiration']) && !is_null($record['confirmation_token_expiration']) && time() <= $record['confirmation_token_expiration']) {
                    $entity = $this->get($record->id);
                    $entity->status_id = 1;
                    $entity->confirmation_token = null;
                    $entity->confirmation_token_expiration = null;
                    if ($this->save($entity)) {
                        $result = true;
                    }
                }
            }
        }
        return $result;
    }

    public function userExistByEmail($email = null)
    {
        $result = false;
        if (!is_null($email)) {
            $conditions = [$this->model . '.email' => $email];
            $record = $this->find('all', ['conditions' => $conditions])->first();
            if (!is_null($record) && !empty($record)) {
                $result = true;
            }
        }
        return $result;
    }

    public function setRecoveryTokenByEmail($email = null, $token = null, $time = null)
    {
        $result = false;
        if (!is_null($email)) {
            $user = $this->getByEmail($email);
            if (!empty($user)) {
                $entity = $this->get($user['id']);
                $entity->reset_password_token = $token;
                $entity->reset_password_token_expiration = time() + $time;
                if ($this->save($entity)) {
                    $result = true;
                }
            }
        }
        return $result;
    }

}
