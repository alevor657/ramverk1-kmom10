<?php
namespace Anax\View;

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="POST" action="<?=url("user/register")?>">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input required type="email" name="email" class="form-control <?= isset($err) ? 'is-invalid':''?>" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">Your email address will be used as gravatar</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" class="form-control <?= isset($err) ? 'is-invalid':''?>" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Repeat password</label>
                    <input required type="password" name="passwordAgain" class="form-control <?= isset($err) ? 'is-invalid':''?>" id="password" placeholder="Password">
                    <?php if (isset($err)) : ?>
                        <div class="invalid-feedback">
                            <?=$err?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-success btn-block">Register</button>
            </form>
        </div>
    </div>
</div>
