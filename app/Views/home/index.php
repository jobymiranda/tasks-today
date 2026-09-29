<section class="hero">
    <p class="eyebrow">Daily Task Dashboard</p>

    <h1>Tasks for Today</h1>

    <p>
        Here are the tasks scheduled for
        <strong>
            <?= esc(date('F j, Y', strtotime($today))) ?>
        </strong>.
    </p>

    <a class="button" href="<?= base_url('tasks') ?>">
        View All Tasks
    </a>
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
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <h3>No tasks scheduled for today</h3>

            <p>
                Open the full Task List to review tasks from other
                dates.
            </p>
        </div>
    <?php endif ?>
</section>