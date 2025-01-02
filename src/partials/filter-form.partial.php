<?php
$yearsAsc = $database->query("SELECT DISTINCT YEAR(release_date) AS year FROM hardware ORDER BY year ASC;
");

$yearsDesc = $database->query("SELECT DISTINCT YEAR(release_date) AS year FROM hardware ORDER BY year DESC;
");

$types = $database->query("SELECT DISTINCT type as type FROM hardware");

$statuses = $database->query("SELECT DISTINCT status as status FROM hardware");

?>

<button id="filters_form_open_btn" type="button" class="btn">
    Filters
</button>
<dialog id="filters_form">
    <section class="form_heading">
        <h2>Filter Contributions</h2>
        <button id="filters_form_close_btn" type="button" class="btn">Close</button>
    </section>
    <form method="get">
        <label for="year-from">Year (From)
            <select name="year-from" id="year-from">
                <option selected value="none">N/A</option>
                <?php foreach ($yearsAsc as $year): ?>
                    <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label for="year-to">Year (To)
            <select name="year-to" id="year-to">
                <option selected value="none">N/A</option>
                <?php foreach ($yearsDesc as $year): ?>
                    <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label for="type">Type
            <select name="type" id="type">
                <option selected value="none">N/A</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['type'] ?>"><?= strtoupper($type['type']) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label for="status">Status
            <select required name="status" id="status">
                <option selected value="none">N/A</option>
                <?php foreach ($statuses as $status): ?>
                    <option value="<?= $status['status'] ?>"><?= ucwords(str_replace('_', ' ', $status['status'])) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit" class="btn">Filter Contributions</button>
    </form>
</dialog>