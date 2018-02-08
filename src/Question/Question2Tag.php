<?php

namespace Alvo\Question;

use \Anax\Database\ActiveRecordModel;

/**
 *
 */
class Question2Tag extends ActiveRecordModel
{
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
