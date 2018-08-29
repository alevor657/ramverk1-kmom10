<?php

namespace Anax\View;

function createComment($replies, $questionId, $indent = 0, $temp = '') {
    $margin = $indent * 10 . 'px';
    $url = url("reply");

    foreach ($replies as $reply) {
        $userProfileUrl = url("user/$reply->userId");

        $temp .= <<<EOT
    <div class="row reply">
        <div class="col-12">
            <div class="card mb-3" id="$reply->replyId" style="margin-left: $margin;">
                <div class="card-header text-left">
                    <img class="rounded" src="$reply->gravatar" alt="Avatar">
                    <a href="$userProfileUrl">
                        <h5 class="mb-0 ml-3 text-center align-middle">$reply->email</h5>
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text">$reply->content</p>
                    <a href="#" class="card-link reply-link m-0 p-0" style="display: none;">Reply...</a>

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
            $temp = createComment($reply->comments, $questionId, $indent + 1, $temp);
        }
    }

    return $temp;
}
?>

<div class="container">
    <?= createComment($replies, $questionId); ?>
</div>

<script src="<?=asset("js/reply")?>"></script>
