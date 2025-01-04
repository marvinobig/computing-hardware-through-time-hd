<?php

$history = $database->query('SELECT * FROM user_activity;');

?>

<div id="ht_container">
    <h2 class="title">Site History</h2>
    <table id="history_table">
        <thead>
            <tr>
                <th>User</th>
                <th>Operation</th>
                <th>Listing</th>
                <th>Happened</th>
            </tr>
        </thead>
    
    
        <tbody>
            <?php if ($history): ?>
                <?php foreach ($history as $activity): ?>
                    <tr>
                        <td>
                            <?= $activity['admin_username'] ?>
                        </td>
                        <td>
                            <?= $activity['action_type'] ?>
                        </td>
                        <td>
                            <?= $activity['hardware_name'] ?>
                        </td>
                        <td>
                            <?= (new DateTime($activity['happened_at']))->format('d/m/Y \a\t\ H:i:s') ?>
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
</div>