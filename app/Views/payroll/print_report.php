<h2>Printable Salary Report</h2>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Rate</th>
        <th>Worked</th>
        <th>Salary</th>
    </tr>
    <?php foreach ($payrolls as $p): ?>
        <tr>
            <td><?= $p['name'] ?></td>
            <td><?= $p['type'] ?></td>
            <td><?= $p['rate'] ?></td>
            <td><?= $p['worked'] ?></td>
            <td><?= $p['salary'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<button onclick="window.print()">Print</button>
