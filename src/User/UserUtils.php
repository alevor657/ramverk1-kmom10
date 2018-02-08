<?php

namespace Alvo\User;

/**
 *  Utils functions
 */
trait UserUtils
{
    /**
     * Checks if user is logged in
     * @return boolean false if not logged in
     */
    public function isLoggedIn()
    {
        return $this->di->get("session")->has('user');
    }



    /**
     * Login
     *
     * @param  string $email Email adress from form
     * @param  string $pass  Unhashed string
     *
     * @return bool        true if ok, else false
     */
    public function login($email, $pass)
    {
        if ($this->isLoggedIn()) {
            return;
        }

        $user = $this->db
            ->connect()
            ->select("email, id, password")
            ->from("User")
            ->where("email='$email'")
            ->execute()
            ->fetch();

        if (!$user) {
            return false;
        }

        $passCheck = password_verify($pass, $user->password);

        if ($passCheck) {
            $this->di->get("session")->set("user", $user->email);
            $this->di->get("session")->set("userId", $user->id);
            return true;
        }

        // var_dump($this->di->get("session")->get("user"));
        return false;
    }



    /**
     * Destroys the session
     * @return void
     */
    public function logout()
    {
        $this->di->get("session")->destroy();
    }
}
