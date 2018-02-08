<?php

namespace Alvo\Question;

use \Anax\Database\ActiveRecordModel;

/**
 *
 */
class Tag extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tag";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $tag;



    public function getAllTags()
    {
        return $this->findAll();
    }



    public function getTag($id)
    {
        return $this->find("id", $id);
    }
}
