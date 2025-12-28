<!DOCTYPE html>
<html>
<head>
    <title>Payroll List</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>


        <!-- Optionally add a message for user feedback -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Generate Payroll Button -->
        <a href="/payroll/generate">
            <button>Generate Payroll from Attendance</button>
        </a>

        <?= $this->extend('layout/main') ?>
        <?= $this->section('content') ?>

        <h2>Payroll List</h2>

        <!-- 🔍 Filter form: put this before the table -->
        <form method="get" action="<?= site_url('payroll/filter') ?>" class="mb-4">
                <input type="date" name="start_date" required>
                <input type="date" name="end_date" required>
                <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- ✅ Export CSV Button -->
        <a href="<?= site_url('payroll/exportCSV') ?>" class="btn btn-success mb-3">Export CSV</a>
            
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Worked Days</th>
                    <th>Worked Hours</th>
                    <th>Salary</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payrolls)): ?> 
                    <?php foreach ($payrolls as $p): ?>
                        <tr>
                            <td><?= esc($p['id']) ?></td>
                            <td><?= $p['employee_name'] ?></td>
                            <td><?= esc($p['worked_days']) ?></td>
                            <td><?= esc($p['worked_hours']) ?></td>
                            <td><?= esc($p['salary']) ?></td>
                            <td><?= esc($p['created_at']) ?></td>

                            <!-- ✅ Add these lines here -->
                            <td><?= number_format($p['overtime_pay'], 2) ?></td>
                            <td><?= number_format($p['total_salary'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No payroll data found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?= $this->endSection() ?>

</body>
</html>

