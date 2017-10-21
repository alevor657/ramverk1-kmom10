<?php

namespace Alvo\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                "legend" => "Create user",
                "class" => "center form",
                "wrapper-element" => "div",
                "use_fieldset" => false,
                // "br-after-label" => false,
            ],
            [
                "email" => [
                    "type"        => "email",
                    "validation" => [
                        "custom_test" => [
                            "message" => "User with this email is already registered",
                            "test" => function ($email) {
                                $user = new User();
                                $user->setDb($this->di->get("db"));
                                $check = $user->find('email', $email);
                                return !$check;
                            }
                        ],
                        "not_empty"
                    ]
                ],

                "password" => [
                    "type"        => "password",
                    "validation" => [
                        "not_empty"
                    ],
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"],
                    "class" => "btn btn-success"
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
        // Get values from the submitted form
        $email         = $this->form->value("email");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        if (!$email || !$password || !$passwordAgain) {
            return false;
        }

        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->email = $email;
        $user->setPassword($password);
        $user->created = date("Y-m-d H:i:s");
        $user->save();

        $this->form->addOutput("User was created.");

        return true;
    }
}
