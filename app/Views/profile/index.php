<section class="page-heading">
    <p class="eyebrow">Demo User</p>

    <h1>User Profile</h1>

    <p>
        Information for the single demo user stored in the database.
    </p>
</section>

<section class="profile-panel">
    <?php if ($user !== null): ?>
        <div class="profile-avatar" aria-hidden="true">
            <?= esc(strtoupper(substr($user['full_name'], 0, 1))) ?>
        </div>

        <div class="profile-details">
            <h2><?= esc($user['full_name']) ?></h2>

            <dl>
                <div>
                    <dt>Username</dt>
                    <dd><?= esc($user['username']) ?></dd>
                </div>

                <div>
                    <dt>Email Address</dt>
                    <dd>
                        <a href="mailto:<?= esc($user['email']) ?>">
                            <?= esc($user['email']) ?>
                        </a>
                    </dd>
                </div>

                <div>
                    <dt>Account Created</dt>
                    <dd>
                        <?= esc(
                            date(
                                'F j, Y g:i A',
                                strtotime($user['created_at'])
                            )
                        ) ?>
                    </dd>
                </div>
            </dl>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <h3>No user found</h3>
            <p>
                The database must contain exactly one demo user.
            </p>
        </div>
    <?php endif ?>
</section>