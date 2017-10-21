<?php

namespace Alvo\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "class" => "center form",
                "wrapper-element" => "div",
                "use_fieldset" => false,
            ],
            [
                "email" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Username",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Password",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "class" => "btn btn-primary",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // $this->form->rememberValues();

        // Get values from the submitted form
        $email         = $this->form->value("email");
        $password      = $this->form->value("password");

        $result = $this->di->get("user")->login($email, $password);

        if (!$result) {
            $this->form->addOutput("Wrong email or password");
        }

        return $result;
    }
}
