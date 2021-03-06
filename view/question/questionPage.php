<?php
namespace Anax\View;

?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>
                <?=$post->heading?>
                <br>
                <!-- TODO: --->
                <?php if (isset($post->tags) && $post->tags) : ?>
                    <?php foreach ($post->tags as $tag) :?>
                        <a href="<?= url("tags/{$tag["id"]}")?>">
                            <small class="text-muted"><?=$tag["tag"]?></small>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-left">
            <p class="longtext"><?=$this->di->get("textfilter")->doFIlter($post->text, 'markdown')?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-left">
            <a href="<?=url("user/$post->userId")?>">
                <p>By <?=$post->email?></p>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form class="form-inline text-right" method="GET">
                <label class="my-1 mr-2" for="sort">Sort by: </label>
                <select class="custom-select my-1 mr-sm-2" id="sort" onchange="this.form.submit()" name="sort">
                    <option value="accepted" <?=$sortingMethod == "accepted" ? "selected" : ""?>>Аccepted</option>
                    <option value="rating" <?=$sortingMethod == "rating" ? "selected" : ""?>>Rating</option>
                    <option value="date" <?=$sortingMethod == "date" ? "selected" : ""?>>Date</option>
                </select>
            </form>
        </div>
    </div>

    <hr>

</div>

