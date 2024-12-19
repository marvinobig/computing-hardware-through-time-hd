<?php
$years_asc = $database->query("SELECT DISTINCT YEAR(release_date) AS year FROM hardware ORDER BY year ASC;
");

$years_desc = $database->query("SELECT DISTINCT YEAR(release_date) AS year FROM hardware ORDER BY year DESC;
");

$types = $database->query("SELECT DISTINCT type as type FROM hardware");

$statuses = $database->query("SELECT DISTINCT status as status FROM hardware");

?>

<button id="filters_form_open_btn" type="button">
    Filters
</button>
<dialog id="filters_form">
    <section>
        <h2>Filter Contributions</h2>
        <button id="filters_form_close_btn" type="button">Close</button>
    </section>
    <form method="get">
        <section>
            <label for="year-from">Year (From)</label>
            <select name="year-from" id="year-from">
                <?php foreach ($years_asc as $year): ?>
                    <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section>
            <label for="year-to">Year (To)</label>
            <select name="year-to" id="year-to">
                <?php foreach ($years_desc as $year): ?>
                    <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section>
            <label for="hardware_type">Hardware Type</label>
            <select name="hardware_type" id="hardware_type">
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['type'] ?>"><?= $type['type'] ?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section>
            <label for="status">Status</label>
            <select required name="status" id="status">
                <?php foreach ($statuses as $status): ?>
                    <option value="<?= $status['status'] ?>"><?= $status['status'] ?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <button type="submit">Filter Contributions</button>
    </form>
</dialog>