<?php
$errors = session()->getFlashdata('errors') ?? [];

$currentStatus = old(
    'status',
    $task['status'] ?? 'pending'
);
?>

<section class="page-heading page-heading-split">
    <div>
        <p class="eyebrow">Task Management</p>

        <h1><?= esc($formHeading) ?></h1>

        <p>
            Complete the task information below. Required fields must
            be valid before the record can be saved.
        </p>
    </div>

    <a href="<?= base_url('tasks') ?>" class="button button-secondary">
        Back to Task List
    </a>
</section>

<section class="form-card">
    <?php if ($errors !== []): ?>
        <div class="alert alert-danger" role="alert">
            <div>
                <strong>Please correct the following:</strong>

                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <form
        action="<?= esc($formAction, 'attr') ?>"
        method="post"
        class="professional-form"
    >
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="title">
                Task Title
                <span class="required">*</span>
            </label>

            <input
                type="text"
                id="title"
                name="title"
                maxlength="150"
                value="<?= esc(
                    old('title', $task['title'] ?? '')
                ) ?>"
                placeholder="Enter a clear task title"
            >

            <?php if (isset($errors['title'])): ?>
                <small class="field-error">
                    <?= esc($errors['title']) ?>
                </small>
            <?php endif; ?>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="status">
                    Status
                    <span class="required">*</span>
                </label>

                <select id="status" name="status">
                    <option
                        value="pending"
                        <?= $currentStatus === 'pending'
                            ? 'selected'
                            : '' ?>
                    >
                        Pending
                    </option>

                    <option
                        value="in progress"
                        <?= $currentStatus === 'in progress'
                            ? 'selected'
                            : '' ?>
                    >
                        In Progress
                    </option>

                    <option
                        value="completed"
                        <?= $currentStatus === 'completed'
                            ? 'selected'
                            : '' ?>
                    >
                        Completed
                    </option>
                </select>

                <?php if (isset($errors['status'])): ?>
                    <small class="field-error">
                        <?= esc($errors['status']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="task_date">
                    Task Date
                    <span class="required">*</span>
                </label>

                <input
                    type="date"
                    id="task_date"
                    name="task_date"
                    value="<?= esc(
                        old(
                            'task_date',
                            $task['task_date'] ?? date('Y-m-d')
                        )
                    ) ?>"
                >

                <?php if (isset($errors['task_date'])): ?>
                    <small class="field-error">
                        <?= esc($errors['task_date']) ?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <a
                href="<?= base_url('tasks') ?>"
                class="button button-secondary"
            >
                Cancel
            </a>

            <button type="submit" class="button button-primary">
                <?= esc($submitLabel) ?>
            </button>
        </div>
    </form>
</section>