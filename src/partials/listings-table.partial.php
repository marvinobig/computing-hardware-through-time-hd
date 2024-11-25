<?php

$hardwareListings = $database->query('SELECT * FROM hardware;');

?>

<table id="listings_table">
    <tr>
        <th>Contribution Name</th>
        <th>Views</th>
        <th>Created at</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($hardwareListings as $listing): ?>
        <tr>
            <td>
                <a href="/contribution.php?id=<?= $listing['id'] ?>">
                    <?= $listing['name'] ?>
                </a>
            </td>
            <td><?= $listing['views'] ?></td>
            <td>
                <?= (new DateTime($listing['created_at']))->format('d/m/Y \a\t\ h:i:s a') ?>
            </td>
            <td>
                <button id="<?= $listing['id'] ?>" type="button">Edit</button>
                <button id="<?= $listing['id'] ?>" type="button">Delete</button>
            </td>
        </tr>
    <?php endforeach ?>
</table>