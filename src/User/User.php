<?php

namespace Alvo\User;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A database driven model.
 */
 class User extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;
    use UserUtils;



    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "User";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $email;
    public $password;
    public $reputation;

    public function logUserIn($updatingLogin = null)
    {
        if (!$updatingLogin) {
            $data = $this->di->get("request")
                ->getPost();

            extract($data);
        } else {
            extract($updatingLogin);
        }

        $user = $this->db
            ->connect()
            ->select()
            ->from("User")
            ->where("email='$email'")
            ->execute()
            ->fetch();

        if (!$user) {
            return false;
        }

        $passCheck = password_verify($password, $user->password);

        if ($passCheck) {
            $this->di->get("session")->set("user", $user->email);
            $this->di->get("session")->set("userId", $user->id);
            return true;
        }

        return false;
    }



    public function register()
    {
        $data = $this->di->get("request")->getPost();

        extract($data);

        if ($password != $passwordAgain) {
            return "Passwords do not match";
        }

        $user = $this->getUser("email", $email);

        if ($user) {
            return "User with this email is already registered";
        }

        $this->email = $email;
        $this->reputation = 0;
        $this->setPassword($password);

        $t = $this->save();

        return true;
    }



    public function updateUser()
    {
        $data = $this->di->get("request")->getPost();

        $this->find("email", $this->di->get("session")->get("user"));

        extract($data);

        $this->di->get("user")
            ->logout(false);

        $this->email = $email;

        if ($password) {
            $this->setPassword($password);
        }

        $this->update();

        return $this->logUserIn([
            "email" => $email,
            "password" => $password
        ]);
    }



    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }



    /**
     * Verify the email and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $email  email to check.
     * @param string $password the password to use.
     *
     * @return boolean true if email and password matches, else false.
     */
    public function verifyPassword($email, $password)
    {
        $this->find("email", $email);
        return password_verify($password, $this->password);
    }



    public function getUser($column = null, $param = null)
    {
        if (!$column) {
            $column = "id";
        }

        if (!$param) {
            $param = $this->di->get("session")->get("userId");
        }

        return $this->find($column, $param);
    }



    public function getAllUsers()
    {
        return $this->db
            ->connect()
            ->select()
            ->from($this->tableName)
            ->execute()
            ->fetchAllClass(get_class($this));
    }



    public function delete($id = null)
    {
        $id = $id ?: $this->id;

        $comment = new User();
        $comment->setDb($this->db);
        $comment->find("id", $id);
        $comment->deleted = date("Y-m-d H:i:s");
        $comment->save();
    }



    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($email = null, $sss = 80, $ddd = 'mm', $rrr = 'g', $img = false, $atts = array())
    {
        $email = $email ?? $this->email;
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$sss&d=$ddd&r=$rrr";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
