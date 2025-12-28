<!-- app/Views/employee/create.php -->
<h2><?= esc($title ?? 'Add Employee') ?></h2>

<?php if (isset($validation)): ?>
    <div style="color:red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= site_url('employee/store') ?>" method="post">
    <label>Name:</label>
    <input type="text" name="name"><br><br>

    <label>Status:</label>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select><br><br>

    <label>Salary Per Day:</label>
    <input type="text" name="salary_per_day"><br><br>

    <label>Salary Per Hour:</label>
    <input type="text" name="salary_per_hour"><br><br>

    <button type="submit">Save</button>
</form>


