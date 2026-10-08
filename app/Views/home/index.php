<section class="hero">
    <div class="hero-layout">
        <div>
            <p class="eyebrow">Daily Task Dashboard</p>

            <h1>
                Focus on what matters today.
            </h1>

            <p>
                Here are the active tasks scheduled for
                <strong>
                    <?= esc(
                        date('F j, Y', strtotime($today))
                    ) ?>
                </strong>.
            </p>

            <div class="hero-actions">
                <a class="button hero-button" href="<?= base_url('tasks') ?>">
                    View All Tasks
                </a>

                <?php if (session()->get('isLoggedIn')): ?>
                    <a
                        class="button hero-secondary"
                        href="<?= base_url('tasks/new') ?>"
                    >
                        Add New Task
                    </a>
                <?php else: ?>
                    <a
                        class="button hero-secondary"
                        href="<?= base_url('login') ?>"
                    >
                        Sign In to Manage
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="hero-stat">
            <small>TODAY’S ACTIVE TASKS</small>

            <strong><?= count($tasks) ?></strong>

            <span>
                <?= count($tasks) === 1
                    ? 'task scheduled'
                    : 'tasks scheduled' ?>
            </span>

            <div class="session-state">
                <span></span>

                <?= session()->get('isLoggedIn')
                    ? 'Management access enabled'
                    : 'Public read-only access' ?>
            </div>
        </div>
    </div>
</section>

<section class="content-panel">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Today</p>
            <h2>Today’s Task List</h2>
        </div>

        <span class="record-count">
            <?= count($tasks) ?>
            <?= count($tasks) === 1 ? 'task' : 'tasks' ?>
        </span>
    </div>

    <?php if ($tasks !== []): ?>
        <div class="table-wrapper">
            <table>
                <caption>Tasks scheduled for today</caption>

                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Task Date</th>

                        <?php if (session()->get('isLoggedIn')): ?>
                            <th scope="col">Manage</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td><?= esc($task['title']) ?></td>

                            <td>
                                <?php
                                    $statusClass = str_replace(
                                        ' ',
                                        '-',
                                        $task['status']
                                    );
                                ?>

                                <span
                                    class="status status-<?= esc(
                                        $statusClass
                                    ) ?>"
                                >
                                    <?= esc(ucwords($task['status'])) ?>
                                </span>
                            </td>

                            <td>
                                <?= esc(
                                    date(
                                        'F j, Y',
                                        strtotime($task['task_date'])
                                    )
                                ) ?>
                            </td>

                            <?php if (session()->get('isLoggedIn')): ?>
                                <td>
                                    <a
                                        href="<?= base_url(
                                            'tasks/'
                                            . $task['id']
                                            . '/edit'
                                        ) ?>"
                                        class="table-action edit-action"
                                    >
                                        Edit
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <h3>No active tasks scheduled for today</h3>

            <p>
                Open the complete Task List to review tasks from
                other dates.
            </p>

            <a class="button button-secondary" href="<?= base_url('tasks') ?>">
                Open Task List
            </a>
        </div>
    <?php endif; ?>
</section>