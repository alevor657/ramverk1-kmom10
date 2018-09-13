<?php
namespace Anax\View;

?>
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <?php if ($userQuestions ?? false) : ?>
                <h1 class="text-center">Recent questions</h1>
                <?php foreach ($userQuestions as $question) : ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?=$question->heading?></h5>
                            <p class="card-text"><?=$question->text?>
                                <a href="<?= url("questions/$question->id") ?>"> ...</a>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted"><?=$question->created ?? ''?></h6>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card text-center">
                <img class="card-img-top" src="<?=$user->getGravatar()?>" alt="Avatar">
                <div class="card-body">
                    <form method="POST" action="<?=url("user/update")?>">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$user->email?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" name="password" class="form-control" id="password" placeholder="Enter new password">
                        </div>
                        <small>You earn reputation by being active at this website</small>
                        <p>Reputation: <?=$user->reputation?></p>
                        <small>Total number of upvotes and downvotes</small>
                        <p>Impressions: <?=$impressions?></p>
                        <button type="submit" class="btn btn-warning btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <?php if ($userAnswers ?? false) : ?>
                <h1 class="text-center">Recent replies</h1>
                <?php foreach ($userAnswers as $answer) : ?>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?=$answer->content?>
                                <a href="<?=url("questions/$answer->question_id#$answer->id")?>"> ...</a>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted"><?=$answer->created ?? ''?></h6>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
<br>
