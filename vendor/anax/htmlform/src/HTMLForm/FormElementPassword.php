<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementPassword extends FormElementInput
{
    /**
     * Constructor
     *
     * @param string $name       of the element.
     * @param array  $attributes to set to the element. Default is an empty
     *                           array.
     */
    public function __construct($name, $attributes = [])
    {
        parent::__construct($name, $attributes);
        $this['type'] = 'password';
        $this->UseNameAsDefaultLabel();
    }
}
