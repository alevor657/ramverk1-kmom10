<?php

namespace Alvo\Tags;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A database driven model.
 */
 class Question2Tag extends ActiveRecordModel implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Question2Tag";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $question_id;
    public $tag_id;

}
