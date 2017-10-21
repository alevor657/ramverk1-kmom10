<?php
namespace Anax\View;

// debug($users);
?>
<div class="center all-users m-t-lg">

<?php foreach ($users as $user) : ?>
        <div class="card text-center">
            <img class="card-img-top" src="<?=$user->getGravatar()?>" alt="Avatar">
            <div class="card-body">
                <p><?=$user->email?></p>
                <a href="<?=url("admin/delete/$user->id")?>" class="btn btn-danger btn-sm">
                    Delete
                </a>
                <a href="<?=url("admin/edit/$user->id")?>" class="btn btn-warning btn-sm">
                    Edit
                </a>
            </div>
        </div>
<?php endforeach; ?>
</div>
