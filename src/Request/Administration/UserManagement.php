<?php

namespace ZteF\Request\Administration;

use ZteF\Request;

class UserManagement extends Request
{
    /**
     * Set administrator password
     */
    public function setAdminPassword(string $oldPassword, string $newPassword): void
    {
    }

    /**
     * Set username and password of normal user
     */
    public function setUser(string $username = 'user', string $newPassword = 'user'): void
    {
    }
}
