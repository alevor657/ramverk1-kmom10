<?php
namespace Anax\View;

?>
<div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-lg-6">
            <form method="POST" action="<?=url("user/login")?>">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input required type="email" name="email" class="form-control <?= isset($err) ? 'is-invalid':''?>" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" class="form-control <?= isset($err) ? 'is-invalid':''?>" id="password" placeholder="Password">
                    <?php if (isset($err)) : ?>
                        <div class="invalid-feedback">
                            <?=$err?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </form>
        </div>
    </div>
</div>
