<?php

namespace Anax\HTMLForm;

use \Anax\DI\DIFactoryConfig;

/**
 * HTML Form elements.
 */
class FormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig(__DIR__ . "/../../htdocs/incl/di.php");
    }



    /**
     * Test
     */
    public function testCreate1()
    {
        $form = new Form($this->di);
        $form->create();

        $res = $form->getHTML();
        $exp = <<<EOD
\n<form id='anax/htmlform' class='htmlform' method='post'>
<input type="hidden" name="anax/htmlform-id" value="anax/htmlform" />
<fieldset>



</fieldset>
</form>\n
EOD;

        $this->assertEquals($res, $exp, "Empty form missmatch.");
    }



    /**
     * Test
     */
    public function testCreate2()
    {
        $form = new Form($this->di);
        $form->create([
            "enctype" => "multipart/form-data"
        ]);

        $res = $form->getHTML();
        $exp = <<<EOD
\n<form id='anax/htmlform' class='htmlform' method='post' enctype='multipart/form-data'>
<input type="hidden" name="anax/htmlform-id" value="anax/htmlform" />
<fieldset>



</fieldset>
</form>\n
EOD;

        $this->assertEquals($res, $exp, "Form with enctype missmatch.");
    }
}
