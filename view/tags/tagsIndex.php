<?php
namespace Anax\View;

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Most popular tags:</h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Tag</th>
                <th scope="col">Uses</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tags as $tag) : ?>
                    <tr>
                    <td><a href="<?= url("tags/$tag->id") ?>"><?=$tag->tag?></a></td>
                    <td><?=$tag->count?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
