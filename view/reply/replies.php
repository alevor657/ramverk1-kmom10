<?php

namespace Anax\View;

// debug($replies);
function createComment($replies, $questionId, $indent = 0, $temp = '') {
    $margin = $indent * 10 . 'px';
    $url = url("reply");

    foreach ($replies as $reply) {
    // debug_noexit($reply);

    $temp .= <<<EOT
<div class="row">
    <div class="col-12">
        <div class="card" style="margin-left: $margin;">
            <div class="card-body">
                <h5 class="card-title">$reply->email</h5>
                <h6 class="card-subtitle mb-2 text-muted">$reply->created</h6>
                <p class="card-text">$reply->content</p>
                <a href="#" class="card-link reply-link">Reply...</a>

                <form method="POST" action="$url" enctype="application/x-www-form-urlencoded" class="reply-form" style="display: none;">
                    <input type="text" hidden name="replyId" value="$reply->replyId">
                    <input type="text" hidden name="questionId" value="$questionId">
                    <div class="form-group">
                        <textarea required class="form-control" id="textarea" rows="8" placeholder="Markdown enabled" name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>

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
