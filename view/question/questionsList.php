<?php
namespace Anax\View;

?>



<div class="container question-list">
    <?php if (empty($posts)) : ?>
        <div class="row text-center">
            <p>No posts found</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
        <?php
            $lines = explode("\n", $post->text);

            if (count($lines) > 2) {
                $post->text = implode("\n", array_slice($lines, 0, 2));
                // debug($post->text);
            }
        ?>
            <div class="row question-row">
                <div class="col-lg-3 col-xs-12">
                    <figure class="figure">
                        <img src="<?=$post->avatarUrl?>" class="figure-img img-fluid rounded" alt="Avatar">
                        <a href="<?=url("user/$post->user_id")?>">
                            <figcaption class="figure-caption"><?=$post->userEmail?></figcaption>
                        </a>
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
                    <div class="row">
                        <div class="col-12">
                            <?php if (strlen($post->text) < 140): ?>
                                <?=$post->text?>
                            <?php else: ?>
                                <?=substr($post->text, 0, 140)?>
                                <br>
                                <a href="<?=url("questions/$post->id")?>">Read more...</a>
                            <?php endif?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="row">
                        <div class="mx-auto">
                            <?php if (isset($post->tags) && $post->tags) : ?>
                                <?php foreach ($post->tags as $tag) : ?>
                                    <a href="<?=url("tags/{$tag->id}")?>">
                                        <span class="badge badge-pill badge-primary d-inline-block align-middle"><?=$tag->tag?></span>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <small class="text-muted mr-2">Replies: <?=$post->replyCount?></small>
                    <small class="text-muted">Rating: <?=$post->rating?></small>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

<!-- ?? -->
</div>
