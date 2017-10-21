<?php

namespace Alvo\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Alvo\User\User;

/**
 * Example of FormModel implementation.
 */
class UpdateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $user = null)
    {
        parent::__construct($di);

        $this->user = $user;
        if (!$this->user) {
            $this->user = $this->loadUserData($di->get('session')->get('userId'));
        }
        $this->di = $di;

        $this->form->create(
            [
                "id" => __CLASS__,
                "class" => "center form",
                "wrapper-element" => "div",
                "use_fieldset" => false,
                // "br-after-label" => false,
            ],
            [
                "email" => [
                    "type" => "email",
                    "value" => esc($this->user->email),
                    "validation" => [
                    //     "custom_test" => [
                    //         "message" => "User with this email is already registered",
                    //         "test" => function ($email)
                    //         {
                    //             $check = $this->user->getUser('email', $email);
                    //             return !$check;
                    //         }
                    //     ],
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
                    "value" => "Update User",
                    "callback" => [$this, "callbackSubmit"],
                    "class" => "btn btn-warning"
                ],
            ]
        );
    }



    public function loadUserData($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $id);
        return $user;
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

        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $this->user->id);
        $user->email = $email;
        $user->setPassword($password);
        $user->updated = date("Y-m-d H:i:s");
        $user->save();

        // $this->di->get("user")->logout();
        // $t = $this->di->get("user")->login($email, $password);
        // debug($t);

        $this->form->addOutput("Profile has been updated.");

        return true;
    }
}
