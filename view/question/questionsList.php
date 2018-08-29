<?php

namespace Anax\View;

?>



<div class="container">
    <?php if (empty($posts)) : ?>
        <div class="row text-center">
            <p>No posts found</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post): ?>
            <div class="row">
                <div class="col-lg-3 col-xs-12">
                    <!-- <img src="" alt="image" class="user-pic"> -->
                    <figure class="figure">
                        <img src="<?=$post->avatarUrl?>" class="figure-img img-fluid rounded" alt="Avatar">
                        <figcaption class="figure-caption"><?=$post->userEmail?></figcaption>
                    </figure>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="row">
                        <div class="col-auto mx-auto">
                            <a href="<?=url("questions/$post->id")?>">
                                <h3 class="centered d-inline-block align-middle"><?=$post->heading?></h3>
                            </a>
                        </div>
                    </div>
                    <?php if (strlen($post->text) < 140) : ?>
                        <p class="longtext"><?=$post->text?></p>
                    <?php else : ?>
                        <p class="longtext"><?=substr($post->text, 0, 140)?></p>
                        <br>
                        <a href="<?=url("questions/$post->id")?>">Read more...</a>
                    <?php endif ?>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="row">
                        <div class="mx-auto">
                            <?php if (isset($post->tags) && $post->tags) : ?>
                                <?php foreach ($post->tags as $tag): ?>
                                    <a href="<?=url("tags/{$tag->id}")?>">
                                        <span class="badge badge-pill badge-primary d-inline-block align-middle"><?=$tag->tag?></span>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
