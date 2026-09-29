<section class="page-heading">
    <p class="eyebrow">Task Management</p>

    <h1>Complete Task List</h1>

    <p>
        This page displays every task in the database, ordered by
        task date.
    </p>
</section>

<section class="content-panel">
    <div class="section-heading">
        <div>
            <p class="eyebrow">All Records</p>
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
                <caption>Complete list of system tasks</caption>

                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Task Date</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td><?= esc($task['title']) ?></td>

                            <td>
                                <span class="status">
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
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <h3>No task records found</h3>
            <p>Add task records to the database and try again.</p>
        </div>
    <?php endif ?>
</section>