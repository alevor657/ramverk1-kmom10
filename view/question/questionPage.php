<?php

namespace Anax\View;

// debug($post);
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>
                <?=$post->heading?>
                <br>
                <!-- TODO: --->
                <?php if(isset($post->tags) && $post->tags) : ?>
                    <?php foreach($post->tags as $tag) :?>
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
            <p class="longtext"><?=$post->text?></p>
        </div>
    </div>

    <hr>

</div>

