<?php

namespace Alvo\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class UserController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->user = new User();
        $this->user->setDI($this->di);
        $this->user->setDb($this->di->get("db"));
    }


    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $this->checkLogin();

        $title = "Profile";

        $user = $this->di->get("session")->get('user');
        $data = $this->di->get('user')->getUser('email', $user);

        $this->di->get('view')->add("user/profile", ["user" => $data]);
        $this->di->get('pageRender')->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getLogin()
    {
        if ($this->isLoggedIn()) {
            $this->di->get("response")->redirect("user/profile");
        }

        $title      = "A login page";

        $this->di->get("view")
            ->add("user/login");

        $this->di->get("pageRender")
            ->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getRegister()
    {
        if ($this->isLoggedIn()) {
            $this->di->get("response")->redirect("user/profile");
        }

        $title      = "Create new user";

        $this->di->get("view")
            ->add("user/register");

        $this->di->get("pageRender")
            ->renderPage(["title" => $title]);
    }



    public function register()
    {
        $res = $this->user->register();

        if (is_bool($res)) {
            $this->di->get('response')
                ->redirect('user/profile');
        } else {
            $this->di->get('view')
                ->add('user/register', ["err" => $res]);

            $this->di->get('pageRender')
                ->renderPage();
        }
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostCreateUser()
    {
        $title      = "A create user page";

        $this->di->get("view")
            ->add("default2/article", $data);

        $this->di->get("pageRender")
            ->renderPage(["title" => $title]);
    }



    public function getUser()
    {
        return $this->user->getUser();
    }



    public function logout($redirect = true)
    {
        $this->di->get('session')->delete('user');
        $this->di->get('session')->delete('userId');

        if ($redirect) {
            $this->di->get("response")->redirect("user/login");
        }
    }



    public function isLoggedIn()
    {
        return $this->di->get("session")
            ->has("userId");
    }



    public function checkLogin()
    {
        $user = $this->di->get('session')
            ->has('userId');

        if (!$user) {
            $this->di->get('response')
                ->redirect('user/login');
        }
    }



    public function logUserIn()
    {
        $res = $this->user->logUserIn();

        if ($res) {
            $this->di->get('response')
                ->redirect('user/profile');
        } else {
            $this->di->get('view')
                ->add('user/login', ["err" => "User does not exist"]);

            $this->di->get('pageRender')
                ->renderPage();
        }
    }



    public function updateUser()
    {
        $t = $this->user->updateUser();
        $this->di->get("response")
            ->redirect("user/profile");
    }
}
