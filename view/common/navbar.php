<?php

namespace Anax\View;

?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?=url('') ?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?=url('questions') ?>">Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=url('tags') ?>">Tags</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=url('about') ?>">About</a>
            </li>

            <?php if (!$user) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Users
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?=url('user/register') ?>">Register</a>
                            <a class="dropdown-item" href="<?=url('user/login') ?>">Login</a>
                        </div>
                </li>
            <?php endif; ?>

            <?php if ($user->admin ?? false) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('admin') ?>">Admin</a>
                </li>
            <?php endif; ?>

        </ul>

    <?php if ($user) : ?>
        <ul class="user-label navbar-nav ml-auto right">
            <li class="nav-item text-warning">
                <a class="nav-link font-weight-bold" href="<?=url("user/profile")?>">Logged in as: <?=$user->email?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning font-weight-bold" href="<?=url("user/logout")?>">Logout</a>
            </li>
        </ul>
    <?php endif; ?>

    </div>
</nav>
