<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= esc($title ?? 'Tasks for Today') ?>
        | Tasks for Today
    </title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css?v=2') ?>"
    >
</head>

<body>

<header class="site-header">
    <div class="navigation-container">
        <a class="brand" href="<?= base_url('/') ?>">
            <span class="brand-check">✓</span>

            <span class="brand-copy">
                <strong>Tasks for Today</strong>
                <small>Team Task Management</small>
            </span>
        </a>

        <nav class="main-navigation" aria-label="Main navigation">
            <a
                href="<?= base_url('/') ?>"
                class="<?= uri_string() === '' ? 'active' : '' ?>"
            >
                Welcome
            </a>

            <a
                href="<?= base_url('tasks') ?>"
                class="<?= str_starts_with(
                    uri_string(),
                    'tasks'
                ) ? 'active' : '' ?>"
            >
                Task List
            </a>

            <a
                href="<?= base_url('profile') ?>"
                class="<?= uri_string() === 'profile' ? 'active' : '' ?>"
            >
                Profile
            </a>

            <a
                href="<?= base_url('about') ?>"
                class="<?= uri_string() === 'about' ? 'active' : '' ?>"
            >
                About
            </a>
        </nav>

        <div class="account-navigation">
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="signed-in-user">
                    <span class="user-avatar">
                        <?= esc(
                            strtoupper(
                                substr(
                                    (string) session()->get('full_name'),
                                    0,
                                    1
                                )
                            )
                        ) ?>
                    </span>

                    <span class="user-details">
                        <strong>
                            <?= esc(session()->get('full_name')) ?>
                        </strong>

                        <small>Authenticated user</small>
                    </span>
                </div>

                <a
                    href="<?= base_url('tasks/new') ?>"
                    class="header-action"
                >
                    + New Task
                </a>

                <form
                    action="<?= base_url('logout') ?>"
                    method="post"
                    class="logout-form"
                >
                    <?= csrf_field() ?>

                    <button type="submit" class="logout-button">
                        Sign Out
                    </button>
                </form>
            <?php else: ?>
                <a
                    href="<?= base_url('login') ?>"
                    class="login-button"
                >
                    Sign In
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="container">
    <?php if ($message = session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="status">
            <span class="alert-symbol">✓</span>
            <span><?= esc($message) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($message = session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <span class="alert-symbol">!</span>
            <span><?= esc($message) ?></span>
        </div>
    <?php endif; ?>