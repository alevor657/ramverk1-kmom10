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
                            <p class="card-text"><?=substr($question->text, 0, 35)?>
                                <a href="<?=url("questions/$question->id")?>"> ...</a>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted"><?=$question->created ?? ''?></h6>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card text-center">
                <img class="card-img-top" src="<?=$user->getGravatar($user->email)?>" alt="Avatar">
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <p><?=$user->email?><p>
                        </div>
                        <p>Reputation: <?=$user->reputation?></p>
                        <small>You earn reputation by being active at this website</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <?php if ($userAnswers ?? false) : ?>
                <h1 class="text-center">Recent replies</h1>
                <?php foreach ($userAnswers as $answer) : ?>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?=substr($answer->content, 0, 35)?>
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
