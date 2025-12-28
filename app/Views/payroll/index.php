<!DOCTYPE html>
<html>
<head>
    <title>Payroll List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <h2 class="mb-4">Payroll List</h2>

    <!-- Filter Form -->
    <form method="get" action="<?= site_url('payroll/filter') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="<?= site_url('payroll') ?>" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Export CSV Button -->
    <div class="mb-3">
        <a href="<?= site_url('payroll/exportCSV') ?>" class="btn btn-success">Export CSV</a>
    </div>

    <!-- Payroll Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Worked Days</th>
                    <th>Worked Hours</th>
                    <th>Salary</th>
                    <th>Overtime Pay</th>
                    <th>Total Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payrolls)): ?>
                    <?php 
                        $overtimeRate = 10000;
                        foreach ($payrolls as $p):
                            $overtime = $p['worked_hours'] * $overtimeRate;
                            $totalSalary = $p['salary'] + $overtime;
                    ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= esc($p['employee_name']) ?></td>
                            <td><?= esc(date('Y-m-d', strtotime($p['created_at']))) ?></td>
                            <td><?= esc($p['worked_days']) ?></td>
                            <td><?= esc($p['worked_hours']) ?></td>
                            <td><?= number_format($p['salary'], 2) ?></td>
                            <td><?= number_format($overtime, 2) ?></td>
                            <td><?= number_format($totalSalary, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No payroll data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
