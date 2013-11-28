<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class User extends BaseHydrate
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @throws Exception
     */
    public function setName($name)
    {
        if (is_string($name))
            $this->name = $name;
        else
            throw new Exception('$name must be a string!');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        if (is_string($password))
            $this->password = self::isPasswordHashed($password) ? $password : self::hashPassword($password);
        else
            throw new Exception('$password must be a string!');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $role
     * @throws Exception
     */
    public function setRole($role)
    {
        if (is_string($role))
            $this->role = $role;
        else
            throw new Exception('$role must be a string!');
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword($password)
    {
        return sha1($password);
    }

    /**
     * @param string $password
     * @return bool
     */
    public static function isPasswordHashed($password)
    {
        if (strlen($password) == 40)
            return true;
        else
            return false;
    }
} 