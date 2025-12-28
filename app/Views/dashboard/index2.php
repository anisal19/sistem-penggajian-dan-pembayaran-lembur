<h2>Dashboard</h2>
<div>
    <p>Total Employees: <?= $totalEmployees ?></p>
    <p>Total Salary Paid: <?= number_format($totalSalary, 2) ?></p>
</div>

<a href="<?= site_url('payroll') ?>">Go to Payroll</a>
