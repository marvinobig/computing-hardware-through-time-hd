<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    Utilities::redirect('admin/dashboard.php', 302);
}

$listing = $database->query("SELECT * FROM hardware WHERE id = ?", [$id])[0];

if (!$listing) {
    Utilities::redirect('admin/dashboard.php', 302);
}

$title = 'Update ' . $listing['name'] . ' listing';
?>
<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <main>
            <h1>Update <?= $listing['name'] ?> listing</h1>

            <form id="contributions_upload" method="post" action="/api/update-listing.php?<?= $listing['id'] ?>" enctype="multipart/form-data">
                <section>
                    <label for="image">Image</label>
                    <input required type="file" name="image" id="image" accept="image/*">
                </section>
                <section>
                    <label for="hardware_name">Name</label>
                    <input required type="text" name="hardware_name" id="hardware_name" value="<?= $listing['name'] ?>">
                </section>
                <section>
                    <label for="hardware_type">Type</label>
                    <select required name="hardware_type" id="hardware_type" value="<?= $listing['hardware_type'] ?>">
                        <option value="cpu" <?= $listing['status'] === 'cpu' ? 'selected' : '' ?>>CPU (Processor)</option>
                        <option value="gpu" <?= $listing['status'] === 'gpu' ? 'selected' : '' ?>>GPU (Graphics Processing Unit)</option>
                        <option value="ram" <?= $listing['status'] === 'ram' ? 'selected' : '' ?>>RAM (Memory)</option>
                        <option value="ssd" <?= $listing['status'] === 'ssd' ? 'selected' : '' ?>>SSD (Solid State Drive)</option>
                        <option value="hdd" <?= $listing['status'] === 'hdd' ? 'selected' : '' ?>>HDD (Hard Disk Drive)</option>
                        <option value="motherboard" <?= $listing['status'] === 'motherboard' ? 'selected' : '' ?>>Motherboard</option>
                        <option value="psu" <?= $listing['status'] === 'psu' ? 'selected' : '' ?>>PSU (Power Supply Unit)</option>
                        <option value="cooling" <?= $listing['status'] === 'cooling' ? 'selected' : '' ?>>Cooling System</option>
                        <option value="network_card" <?= $listing['status'] === 'network_card' ? 'selected' : '' ?>>Network Card</option>
                        <option value="sound_card" <?= $listing['status'] === 'sound_card' ? 'selected' : '' ?>>Sound Card</option>
                        <option value="case" <?= $listing['status'] === 'case' ? 'selected' : '' ?>>PC Case</option>
                        <option value="peripherals" <?= $listing['status'] === 'peripherals' ? 'selected' : '' ?>>Peripherals (Mouse, Keyboard, etc.)</option>
                    </select>
                </section>
                <section>
                    <label for="manufacturer">Manufacturer</label>
                    <input required type="text" name="manufacturer" id="manufacturer" value="<?= $listing['manufacturer'] ?>">
                </section>
                <section>
                    <label for="summary">Historical Significance Summary</label>
                    <textarea name="summary" id="summary" rows="4" cols="50"><?= $listing['summary'] ?></textarea>
                </section>
                <section>
                    <label for="details">Details</label>
                    <textarea name="details" id="details" rows="10" cols="50"><?= $listing['details'] ?></textarea>
                </section>
                <section>
                    <label for="price_at_release">Price at Release</label>
                    <input required type="number" step="0.01" min="0.00" name="price_at_release" id="price_at_release" value="<?= $listing['price_at_release'] ?>">
                </section>
                <section>
                    <label for="status">Status</label>
                    <select required name="status" id="status">
                        <option value="na" <?= $listing['status'] === 'na' ? 'selected' : '' ?>>N/A</option>
                        <option value="fully_supported" <?= $listing['status'] === 'fully_supported' ? 'selected' : '' ?>>Fully Supported</option>
                        <option value="limited_support" <?= $listing['status'] === 'limited_status' ? 'selected' : '' ?>>Limited Support</option>
                        <option value="obsolete" <?= $listing['status'] === 'obsolete' ? 'selected' : '' ?>>Obsolete</option>
                    </select>
                </section>
                <section>
                    <label for="release_date">Release Date</label>
                    <input required type="date" name="release_date" id="release_date" value="<?= $listing['release_date'] ?>">
                </section>

                <section>
                    <button type="submit">Update <?= $listing['name'] ?> contribution</button>
                </section>
            </form>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>