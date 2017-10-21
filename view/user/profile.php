<?php
namespace Anax\View;

?><div class="container center profile m-t-lg">
    <div class="card text-center">
        <img class="card-img-top" src="<?=$user->getGravatar()?>" alt="Avatar">
        <div class="card-body">
            <?=$form?>
        </div>
    </div>
</div>
