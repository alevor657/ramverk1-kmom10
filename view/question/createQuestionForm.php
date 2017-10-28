<?php

namespace Anax\View;

// debug($tags);
?>
<div class="container add-question-form">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="POST" action="<?=url("questions/postQuestion")?>">
                <div class="form-group">
                    <label for="heading">Topic:</label>
                    <input class="form-control" id="heading" name="heading" required/>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select multiple class="form-control" id="tags" name="tags[]" data-role="tagsinput"></select>
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

    });
</script>
