<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class UserSession
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Start the PHP Session
     */
    public function __construct()
    {
        session_start();
        $this->user = null;
        $this->reloadSession();
    }

    /**
     * Serialize and store session if user differs
     */
    public function __destruct()
    {
        if ($this->isConnected())
            if ($this->user !== unserialize($_SESSION['user']))
                $this->register($this->user);
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        if (!empty($_SESSION['connected']) && $_SESSION['connected'] == true)
            return true;
        else
            return false;
    }

    public function hasRole($role)
    {
        if ($this->isConnected()) {
            if ($this->user->getRole() === $role)
                return true;
            else
                return false;
        } else
            throw new Exception('user must be defined in session');
    }

    /**
     * @param User $user
     * @return User
     */
    public function register(User $user)
    {
        $this->user = $user;
        $_SESSION['connected'] = true;
        $_SESSION['user'] = serialize($user);
        return $user;
    }

    /**
     * @return User|null
     */
    public function reloadSession()
    {
        if (!empty($_SESSION['connected']) && $_SESSION['connected'] === true && !empty($_SESSION['user']) && unserialize($_SESSION['user']) instanceof User)
            return $this->user = unserialize($_SESSION['user']);
        else
            return null;
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        unset($_SESSION);
        session_destroy();
        return true;
    }

    /**
     * @return bool|null|User
     */
    public function getUser()
    {
        if ($this->isConnected())
            return $this->user;
        else
            return false;
    }
} 