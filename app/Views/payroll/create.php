<h2>Add Payroll</h2>
<form action="/payroll/store" method="post">
    <label>Employee:</label>
    <select name="employee_id">
        <?php foreach ($employees as $e): ?>
            <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Worked Days:</label>
    <input type="number" name="worked_days"><br><br>

    <label>Worked Hours:</label>
    <input type="number" name="worked_hours"><br><br>

    <label>Salary:</label>
    <input type="number" step="0.01" name="salary"><br><br>

    <button type="submit">Save</button>
</form>
