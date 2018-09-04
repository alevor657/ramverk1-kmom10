<?php

namespace Anax\View;

function createComment($replies, $questionId, $loggedIn, $isUserQuestionOwner, $indent = 0, $temp = '')
{
    $margin = $indent * 10 . 'px';
    $url = url("reply");
    $replyLink = $loggedIn ? '<a href="#" class="card-link reply-link m-0 p-0" style="display: none;">Reply...</a>' : '';

    foreach ($replies as $reply) {
        $userProfileUrl = url("user/$reply->userId");
        $acceptLink = url("reply/accept/$reply->replyId" . "?questionId=$questionId");
        $unacceptLink = url("reply/unaccept/$reply->replyId" . "?questionId=$questionId");

        $acceptedIcon = <<<EOT
                    <div class="icon-container mx-3">
                        <a href="$unacceptLink">
                            <span class="fas fa-check text-success"></span>
                        </a>
                    </div>
EOT;
        $acceptIcon =  <<<EOT
                    <div class="icon-container mx-3">
                        <a href="$acceptLink">
                            <span class="far fa-check-circle text-primary"></span>
                        </a>
                    </div>
EOT;

        if ($indent == 0) {
            $accepted = $reply->accepted ? $acceptedIcon : $acceptIcon;
        } else {
            $accepted = "";
        }

        $temp .= <<<EOT
    <div class="row reply">
        <div class="col-12">
            <div class="card mb-3" id="$reply->replyId" style="margin-left: $margin;">
                <div class="card-header text-left">
                    <div class="reactions-container mx-3">
                        <span class="fas fa-angle-up text-success vote"></span>
                        <div class="rating-count">150</div>
                        <span class="fas fa-angle-down text-danger vote"></span>
                    </div>
                    $accepted
                    <img class="rounded mx-3" src="$reply->gravatar" alt="Avatar">
                    <a href="$userProfileUrl">
                        <h5 class="mb-0 ml-3 text-center align-middle">$reply->email</h5>
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text">$reply->content</p>

                    $replyLink

                    <form method="POST" action="$url" enctype="application/x-www-form-urlencoded" class="reply-form" style="display: none;">
                        <input type="text" hidden name="replyId" value="$reply->replyId">
                        <input type="text" hidden name="questionId" value="$questionId">
                        <div class="form-group">
                            <textarea required class="form-control" id="textarea" rows="8" placeholder="Markdown enabled" name="text"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>

                </div>
                <div class="card-footer text-muted">
                    <h6 class="card-subtitle m-0 text-muted text-center">$reply->created</h6>
                </div>
            </div>
        </div>
    </div>
EOT;

        if ($reply->comments ?? false) {
            $temp = createComment($reply->comments, $questionId, $loggedIn, $isUserQuestionOwner, $indent + 1, $temp);
        }
    }

    return $temp;
}
?>

<div class="container">
    <?= createComment($replies, $questionId, $loggedIn, $isUserQuestionOwner); ?>
</div>

<script src="<?=asset("js/reply.js")?>"></script>
