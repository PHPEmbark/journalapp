<?php
namespace Journal\Model;
use Journal\Db;

class Users {

    protected $db = null;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function update(User $user)
    {
        $sql =
            'UPDATE user
                SET
                    name = :name,
                    display = :display ';

        if($user->password) {
            $sql .= ', password = :password ';
        }

        $sql .=
            'WHERE user_id = :user_id';

        $bind = [
            ':name' => $user->name,
            ':display' => $user->display,
            ':user_id' => $user->user_id,
        ];

        if($user->password) {
            $bind[':password'] = password_hash($user->password, PASSWORD_DEFAULT);
        }

        $query = $this->db->prepare($sql);
        return $query->execute($bind);
    }

    public function getUser($id)
    {
        $sql =
            'SELECT user_id,
                    name,
                    display
                FROM user
                WHERE user_id = :user_id LIMIT 1';

        $bind = [
            ':user_id' => $id,
        ];

        $query = $this->db->prepare($sql);
        $status = $query->execute($bind);

        if(! $status) {
            return false;
        }

        return $query->fetchObject('Journal\Model\User');
    }

    public function verifyPassword($name, $password)
    {
        $this->db->sqliteCreateFunction('password_verify', 'password_verify', 2);
        $sql =
            'SELECT user_id
                FROM user
                WHERE
                    name = :name
                    AND password_verify(:password, password)
                LIMIT 1';

        $bind = [
            ':name' => $name,
            ':password' => $password,
        ];

        $query = $this->db->prepare($sql);
        $status = $query->execute($bind);

        if(! $status) {
            return false;
        }

        return $query->fetchColumn();
    }
}