<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= esc($title ?? 'Tasks for Today') ?> | Tasks for Today
    </title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css') ?>"
    >
</head>

<body>
    <header class="site-header">
        <div class="navigation-container">
            <a class="brand" href="<?= base_url('/') ?>">
                Tasks for Today
            </a>

            <nav aria-label="Main navigation">
                <a href="<?= base_url('/') ?>">Welcome</a>
                <a href="<?= base_url('tasks') ?>">Task List</a>
                <a href="<?= base_url('profile') ?>">Profile</a>
                <a href="<?= base_url('about') ?>">About</a>
            </nav>
        </div>
    </header>

    <main class="container">
        