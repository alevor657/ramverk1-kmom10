<?php
namespace Anax\View;

?>

<div class="container">
    <div class="row">
        <!-- main -->
        <div class="col-md-12">

            <?php foreach ($posts as $post) : ?>
                <?php
                $enableOptions = $user && ($user->id == $post->userId || $user->admin);
                ?>
                <div class="card card-body blog-post">
                    <div class="card-header blog-post-header">
                        <a class="h2 card-title blog-post-title" href="#"><?=esc($post->heading)?></a>
                        <p class="blog-post-meta"><?=esc($post->created)?> by <?=esc($post->email)?></p>

                        <?php $tags = explode(" ", $post->tags); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <span class="badge badge-primary"><?=esc($tag)?></span>


                        <?php endforeach; ?>

                        <?php if ($enableOptions) : ?>
                            <div class="options">
                                <a href="<?=url("comments/edit/$post->id")?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="<?=url("comments/delete/$post->id")?>" class="btn btn-danger btn-sm">
                                    Delete
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="card-text blog-post-content">
                        <?=esc($post->text)?>
                    </p>
                </div>
            <?php endforeach; ?>


            <?php if ($user) : ?>
                <hr>

                <div class="container">
                    <?=$form?>
                </div>
            <?php else : ?>
                <p>Log in to leave a comment</p>
            <?php endif; ?>

        </div>
    </div>
</div>


    <!-- <form method="POST" action="<?=$app->url->create("comments")?>" class="mb-2">
        <div class="form-group">
            <label for="emailInput">Email address</label>
            <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" required="required" name="email" value="<?=$email?>">
        </div>
        <div class="form-group">
            <label for="headingInput">Heading</label>
            <input type="text" class="form-control" id="headingInput" required="required" name="heading" value="<?=$heading?>">
        </div>
        <div class="form-group">
            <label for="textInput">Message</label>
            <textarea class="form-control" id="textInput" rows="3" required="required" name="text"><?=$text?></textarea>
        </div>
        <?php if ($id) : ?>
            <a href="<?=$app->url->create("comments/edit/")?>">
                <button type="submit" class="btn btn-primary" name="submit" value="<?=$id ?? ''?>">Edit your comment</button>
            </a>
        <?php else : ?>
            <button type="submit" class="btn btn-primary" name="submit" value="<?=$id ?? ''?>">Add your comment</button>
        <?php endif; ?>
    </form> -->
