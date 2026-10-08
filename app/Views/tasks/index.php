<section class="page-heading page-heading-split">
    <div>
        <p class="eyebrow">Task Management</p>

        <h1>Complete Task List</h1>

        <p>
            Public visitors can review active tasks. Authenticated
            users can create, edit, and archive records.
        </p>
    </div>

    <?php if (session()->get('isLoggedIn')): ?>
        <a
            href="<?= base_url('tasks/new') ?>"
            class="button button-primary"
        >
            + Add New Task
        </a>
    <?php else: ?>
        <a
            href="<?= base_url('login') ?>"
            class="button button-secondary"
        >
            Sign In to Manage Tasks
        </a>
    <?php endif; ?>
</section>

<section class="content-panel">
    <div class="section-heading">
        <div>
            <p class="eyebrow">Active Records</p>
            <h2>All Tasks</h2>
        </div>

        <span class="record-count">
            <?= count($tasks) ?>
            <?= count($tasks) === 1 ? 'task' : 'tasks' ?>
        </span>
    </div>

    <?php if ($tasks !== []): ?>
        <div class="table-wrapper">
            <table>
                <caption>Complete list of active system tasks</caption>

                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Task Date</th>
                        <th scope="col">Created At</th>

                        <?php if (session()->get('isLoggedIn')): ?>
                            <th scope="col">Actions</th>
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

                            <td>
                                <?= esc(
                                    date(
                                        'M j, Y g:i A',
                                        strtotime($task['created_at'])
                                    )
                                ) ?>
                            </td>

                            <?php if (session()->get('isLoggedIn')): ?>
                                <td>
                                    <div class="table-actions">
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

                                        <form
                                            action="<?= base_url(
                                                'tasks/'
                                                . $task['id']
                                                . '/archive'
                                            ) ?>"
                                            method="post"
                                            class="archive-form"
                                            onsubmit="return confirm(
                                                'Archive this task? '
                                                + 'The record will remain '
                                                + 'in the database.'
                                            );"
                                        >
                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="table-action archive-action"
                                            >
                                                Archive
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <h3>No active tasks found</h3>

            <p>
                There are currently no active task records to display.
            </p>

            <?php if (session()->get('isLoggedIn')): ?>
                <a
                    href="<?= base_url('tasks/new') ?>"
                    class="button button-primary"
                >
                    Create the First Task
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>