<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class UserManager extends BaseManager
{
    const ENTITY    = 'User';
    const TABLE     = 'user';

    /**
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * @param User $user
     * @return User|bool
     */
    public function add(\User $user)
    {
        $sql = 'INSERT INTO '.self::TABLE.' (id, name, password, role) VALUES (:id, :name, :password, :role)';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            ':id'       => null,
            ':name'     => $user->getName(),
            ':password' => $user->getPassword(),
            ':role'     => $user->getRole(),
        ));
        if($query) {
            $user->setId($this->pdo->lastInsertId());
            return $user;
        }
        else
            return false;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM '.self::TABLE;
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $users = array();
        foreach ($result as $user) {
            $users[] = new User($user);
        }
        return $users;
    }

    /**
     * @param $attribute
     * @param $value
     * @return array|bool
     */
    protected function findAllBy($attribute, $value)
    {
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE '.$attribute.' = :value';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            ':value'        => $value,
        ));
        if ($query) {
            $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            $users = array();
            foreach ($result as $user) {
                $users[] = new User($user);
            }
            return $users;
        } else
            return false;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool|User
     */
    protected function findOneBy($attribute, $value)
    {
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE '.$attribute.' = :value';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            ':value' => $value,
        ));
        if ($query) {
            $result = $prepare->fetch(\PDO::FETCH_ASSOC);
            return new User($result);
        } else
            return true;
    }

    /**
     * @param $id
     * @return User
     */
    public function find($id)
    {
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE id = '.$this->pdo->quote($id, \PDO::PARAM_INT);
        $query = $this->pdo->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return new User($result);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(\User $user)
    {
        $sql = 'UPDATE '.self::TABLE.' SET  name = :name, password = :password, role = :role WHERE id = :id';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            ':id'       => $user->getId(),
            ':name'     => $user->getName(),
            ':password' => $user->getPassword(),
            ':role'     => $user->getRole(),
        ));
        return $query;
    }

    /**
     * @param $argument
     * @return int
     * @throws Exception
     */
    public function delete($argument)
    {
        if (is_int($argument))
            $id = $argument;
        elseif ($argument instanceof User)
            $id = $argument->getId();
        else
            throw new Exception('$argument must be of type integer or object');

        $sql = 'DELETE FROM '.self::TABLE.' WHERE id = '.$this->pdo->quote($id, \PDO::PARAM_INT);
        return $this->pdo->exec($sql);
    }

    /**
     * @param $username
     * @param $password
     * @return bool|User
     */
    public function signIn($username, $password)
    {
        $entity = self::ENTITY;
        if (!$entity::isPasswordHashed($password))
            $password = $entity::hashPassword($password);
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE name = '.$this->pdo->quote($username, \PDO::PARAM_STR).' AND password = '.$this->pdo->quote($password, \PDO::PARAM_STR);
        $query = $this->pdo->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return new User($result);
        else
            return false;
    }
} 