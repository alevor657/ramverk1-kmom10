<?php

namespace Alvo\Tags;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class TagsController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->tag = new Tag();
        $this->tag->setDI($this->di);
        $this->tag->setDb($this->di->get("db"));
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
        $this->di->get('user')->checkLogin();
        $tagsPopularityMap = $this->tag->getTagsPopularity();

        $title = "Tags";

        $this->di->get('view')->add("tags/tagsIndex", ["tags" => $tagsPopularityMap]);
        $this->di->get('pageRender')->renderPage(["title" => $title]);
    }


    public function getSpecificTag($tagId)
    {
        $this->di->get('user')->checkLogin();
        $data = $this->tag->getTagDetails($tagId);

        $title = "Tag | {$data["tagText"]}";

        // debug($data);

        $this->di->get('view')->add("tags/tagTitle", ["tagText" => $data["tagText"]]);
        $this->di->get('view')->add("question/questionsList", ["posts" => $data["questions"]]);
        $this->di->get('pageRender')->renderPage(["title" => $title]);

    }



}
