<?php

namespace Anax\View;

// debug($post);
?>

<div class="container">
    <div class="row justify-content-center">
        <button type="button" id="toggle_form" class="btn btn-success">Reply</button>
    </div>
</div>

<div class="container add-question-form" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="POST" action="<?=url("reply")?>" enctype="application/x-www-form-urlencoded">
                <input type="text" hidden name="questionId" value="<?=$questionId?>">
                <div class="form-group">
                    <textarea required class="form-control" id="textarea" rows="8" placeholder="Markdown enabled" name="text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        $('#toggle_form').on('click', function() {
            $('.add-question-form').toggle(400);

            // $(this).toggle(400);
        });
    });
</script>
