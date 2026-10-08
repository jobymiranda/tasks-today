<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sign In | Tasks for Today</title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css?v=2') ?>"
    >
</head>

<body class="auth-page">

<div class="auth-layout">
    <section class="auth-showcase">
        <div class="auth-showcase-content">
            <a href="<?= base_url('/') ?>" class="auth-brand">
                <span>✓</span>
                Tasks for Today
            </a>

            <p class="auth-eyebrow">
                SECURE TASK MANAGEMENT
            </p>

            <h1>
                Organize today.<br>
                Accomplish more.
            </h1>

            <p class="auth-description">
                Sign in to create, update, and archive task records
                while keeping the public task pages available to
                everyone.
            </p>

            <div class="auth-features">
                <div>
                    <span>✓</span>
                    <p>
                        <strong>Protected management</strong>
                        Only authenticated users can change records.
                    </p>
                </div>

                <div>
                    <span>✓</span>
                    <p>
                        <strong>Secure passwords</strong>
                        Passwords are hashed and safely verified.
                    </p>
                </div>

                <div>
                    <span>✓</span>
                    <p>
                        <strong>Recoverable deletion</strong>
                        Archived tasks remain safely stored in MySQL.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <main class="auth-form-area">
        <div class="login-card">
            <p class="eyebrow">WELCOME BACK</p>

            <h2>Sign in to continue</h2>

            <p class="login-introduction">
                Enter your demo-user credentials to manage tasks.
            </p>

            <?php if ($message = session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc($message) ?>
                </div>
            <?php endif; ?>

            <?php if ($message = session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= esc($message) ?>
                </div>
            <?php endif; ?>

            <?php
                $errors = session()->getFlashdata('errors') ?? [];
            ?>

            <form
                action="<?= base_url('login') ?>"
                method="post"
                class="professional-form"
            >
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= esc(old('username')) ?>"
                        placeholder="Enter your username"
                        autocomplete="username"
                        autofocus
                    >

                    <?php if (isset($errors['username'])): ?>
                        <small class="field-error">
                            <?= esc($errors['username']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >

                        <button
                            type="button"
                            id="passwordToggle"
                            class="password-toggle"
                        >
                            Show
                        </button>
                    </div>

                    <?php if (isset($errors['password'])): ?>
                        <small class="field-error">
                            <?= esc($errors['password']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <button
                    type="submit"
                    class="button button-primary button-full"
                >
                    Sign In Securely
                </button>
            </form>

            <a href="<?= base_url('/') ?>" class="public-return">
                ← Return to the public Welcome page
            </a>
        </div>
    </main>
</div>

<script>
    const toggle = document.getElementById('passwordToggle');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        const hidden = password.type === 'password';

        password.type = hidden ? 'text' : 'password';
        toggle.textContent = hidden ? 'Hide' : 'Show';
    });
</script>

</body>
</html>