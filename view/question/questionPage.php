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
                <small class="text-muted"><?=implode(', ', $post->tags)?></small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-left">
            <p><?=$post->text?></p>
        </div>
    </div>

    <hr>

</div>

