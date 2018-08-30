<?php
namespace Anax\View;

?>
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <?php if ($data["questions"] ?? false) : ?>
            <h1 class="text-center">Recent questions</h1>
            <?php foreach ($data["questions"] as $question) : ?>
                <div class="card">
                    <div class="card-body">
                        <a href="<?=url("questions/$question->id")?>">
                            <h5 class="card-title text-center"><?=$question->heading?></h5>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted text-center"><?=$question->created ?? ''?></h6>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="col-lg-4 col-sm-12">

        <?php if ($data["users"] ?? false) : ?>
            <h1 class="text-center">Top 5 users</h1>
            <?php foreach ($data["users"] as $user) : ?>
                <div class="card mt-3">
                    <div class="card-header text-center">
                        <img class="rounded" src="<?=$user->gravatar?>" alt="Avatar">
                    </div>
                    <div class="card-body">
                        <a href="<?=url("user/$user->id")?>">
                            <h5 class="mb-0 ml-3 text-center align-middle"><?=$user->email?></h5>
                        </a>
                        <h6 class="card-subtitle mt-3 text-muted text-center">Reputation: <?=$user->reputation ?? ''?></h6>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>

    </div>
    <div class="col-lg-4 col-sm-12">
        <?php if ($data["tags"] ?? false) : ?>
            <h1 class="text-center">Top 5 tags</h1>
            <?php foreach ($data["tags"] as $tag) : ?>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text text-center">
                            <a href="<?=url("tags/{$tag->id}")?>"><?=$tag->tag?></a>
                            <h6 class="card-subtitle mb-2 text-muted text-center">Used <?=$tag->count?> times</h6>
                        </p>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
<br>
