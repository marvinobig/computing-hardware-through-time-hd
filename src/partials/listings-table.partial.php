<?php

$hardwareListings = $database->query('SELECT * FROM hardware;');

?>

<table id="contributions_table">
    <thead>
        <tr>
            <th>Contribution Name</th>
            <th>Views</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
    </thead>


    <tbody>
        <?php if ($hardwareListings): ?>
            <?php foreach ($hardwareListings as $listing): ?>
                <tr>
                    <td>
                        <a href="/contribution.php?id=<?= $listing['id'] ?>">
                            <?= $listing['name'] ?>
                        </a>
                    </td>
                    <td><?= $listing['views'] ?></td>
                    <td>
                        <?= (new DateTime($listing['created_at']))->format('d/m/Y \a\t\ H:i:s') ?>
                    </td>
                    <td>
                        <button id="<?= $listing['id'] ?>" type="button">Edit</button>
                        <button id="<?= $listing['id'] ?>" type="button">Delete</button>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td class="empty_table_msg" colspan="4">Nothing to display</td>
            </tr>
        <?php endif ?>

    </tbody>
</table>