<?php
namespace Anax\View;

?>

<br>

<div class="container">
    <div class="row justify-content-center">
        <button type="button" id="toggle_form" class="btn btn-success">Post a question</button>
    </div>
</div>

<div class="container add-question-form" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="POST" action="<?=url("questions/postQuestion")?>">
                <div class="form-group">
                    <label for="heading">Topic:</label>
                    <input class="form-control" id="heading" name="heading" required maxlength="45"/>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" class="form-control" placeholder="tag1, tag2, tag3..."/>
                    <!-- <select multiple class="form-control" id="tags" name="tags[]" data-role="tagsinput"></select> -->
                </div>
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
