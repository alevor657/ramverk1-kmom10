<?php

namespace Anax\View;

?>



<div class="container">
    <?php if (empty($posts)) : ?>
        <div class="row text-center">
            <p>No posts yet</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post): ?>
            <div class="row">
                <div class="col-lg-3 col-xs-12">
                    <img src="" alt="image" class="user-pic">
                </div>
                <div class="col-lg-9 col-xs-12">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <a href="<?=url("questions/$post->id}")?>">
                                <h3 class="centered d-inline-block align-middle"><?=$post->heading?></h3>
                            </a>
                        </div>
                        <div class="col-auto">
                            <span class="badge badge-pill badge-primary d-inline-block align-middle">Tag</span>
                        </div>
                    </div>
                    <p><?=$post->text?></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>


</div>
