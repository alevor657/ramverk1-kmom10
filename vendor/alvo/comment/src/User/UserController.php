<?php

namespace Alvo\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Alvo\User\HTMLForm\UserLoginForm;
use \Alvo\User\HTMLForm\CreateUserForm;
use \Alvo\User\HTMLForm\UpdateUserForm;

/**
 * A controller class.
 */
class UserController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * Init module
     */
    public function init()
    {
        $this->session = $this->di->get("session");
        $this->response = $this->di->get("response");
        $this->user = $this->di->get("user");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
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
        if (!$this->user->isLoggedIn()) {
            $this->response->redirect('user/login');
        }

        $title = "Profile";

        $form = new UpdateUserForm($this->di);
        $form->check();

        $user = $this->user->find("id", $this->session->get("userId"));
        // debug($user);

        $data = $this->user->getUser('email', $user->email);

        $this->view->add("user/profile", ["user" => $data, "form" => $form->getHTML()]);

        $this->pageRender->renderPage(["title" => $title]);
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
    public function getPostLogin()
    {
        if ($this->user->isLoggedIn()) {
            $this->response->redirect("user");
        }

        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        // var_dump($form);
        // exit;
        // $this->utils->login()

        // $response->redirect('user');

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
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
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function logout()
    {
        $this->user->logout();
        $this->response->redirect("user/login");
    }
}
