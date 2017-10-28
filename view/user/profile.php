<?php
namespace Anax\View;

?><div class="container center profile m-t-lg">
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
                <p>Reputation: <?=$user->reputation?></p>
                <small>You earn reputation by being active at this website</small>
                <button type="submit" class="btn btn-warning btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
<br>
