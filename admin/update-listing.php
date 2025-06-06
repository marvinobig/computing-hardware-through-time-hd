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

        <main id="update_page">
            <header>
                <h1>Update "<?= $listing['name'] ?>" listing</h1>
            </header>

            <form id="contributions_update" method="post" action="/api/update-listing.php?id=<?= $listing['id'] ?>"
                enctype="multipart/form-data">

                <label for="image">Image
                    <input type="file" name="image" id="image" accept="image/*">
                </label>

                <label for="hardware_name">Name
                    <input required type="text" name="hardware_name" id="hardware_name"
                        value="<?= htmlspecialchars($listing['name']) ?>">
                </label>

                <label for="hardware_type">Type
                    <select required name="hardware_type" id="hardware_type">
                        <option value="cpu" <?= $listing['type'] === 'cpu' ? 'selected' : '' ?>>CPU (Processor)
                        </option>
                        <option value="gpu" <?= $listing['type'] === 'gpu' ? 'selected' : '' ?>>GPU (Graphics
                            Processing Unit)</option>
                        <option value="ram" <?= $listing['type'] === 'ram' ? 'selected' : '' ?>>RAM (Memory)
                        </option>
                        <option value="ssd" <?= $listing['type'] === 'ssd' ? 'selected' : '' ?>>SSD (Solid State
                            Drive)</option>
                        <option value="hdd" <?= $listing['type'] === 'hdd' ? 'selected' : '' ?>>HDD (Hard Disk
                            Drive)</option>
                        <option value="motherboard" <?= $listing['type'] === 'motherboard' ? 'selected' : '' ?>>
                            Motherboard</option>
                        <option value="psu" <?= $listing['type'] === 'psu' ? 'selected' : '' ?>>PSU (Power Supply
                            Unit)</option>
                        <option value="cooling" <?= $listing['type'] === 'cooling' ? 'selected' : '' ?>>Cooling
                            System</option>
                        <option value="network_card" <?= $listing['type'] === 'network_card' ? 'selected' : '' ?>>
                            Network Card</option>
                        <option value="sound_card" <?= $listing['type'] === 'sound_card' ? 'selected' : '' ?>>
                            Sound Card</option>
                        <option value="case" <?= $listing['type'] === 'case' ? 'selected' : '' ?>>PC Case</option>
                        <option value="peripherals" <?= $listing['type'] === 'peripherals' ? 'selected' : '' ?>>
                            Peripherals (Mouse, Keyboard, etc.)</option>
                    </select>
                </label>

                <label for="manufacturer">Manufacturer
                    <input required type="text" name="manufacturer" id="manufacturer"
                        value="<?= htmlspecialchars($listing['manufacturer']) ?>">
                </label>

                <label for="summary">Historical Significance Summary</label>
                <textarea name="summary" id="summary" rows="4"
                    cols="50"><?= htmlspecialchars($listing['summary']) ?></textarea>

                <label for="details">Details</label>
                <textarea name="details" id="details" rows="10"
                    cols="50"><?= htmlspecialchars($listing['details']) ?></textarea>

                <label for="price_at_release">Price at Release
                    <input required type="number" step="0.01" min="0.00" name="price_at_release" id="price_at_release"
                        value="<?= htmlspecialchars($listing['price_at_release']) ?>">
                </label>

                <label for="status">Status
                    <select required name="status" id="status">
                        <option value="na" <?= $listing['status'] === 'na' ? 'selected' : '' ?>>N/A</option>
                        <option value="fully_supported" <?= $listing['status'] === 'fully_supported' ? 'selected' : '' ?>>
                            Fully Supported</option>
                        <option value="limited_support" <?= $listing['status'] === 'limited_support' ? 'selected' : '' ?>>
                            Limited Support</option>
                        <option value="obsolete" <?= $listing['status'] === 'obsolete' ? 'selected' : '' ?>>Obsolete
                        </option>
                    </select>
                </label>

                <label for="release_date">Release Date
                    <input required type="date" name="release_date" id="release_date"
                        value="<?= htmlspecialchars($listing['release_date']) ?>">
                </label>

                <button type="submit" class="btn">Update <?= htmlspecialchars($listing['name']) ?> contribution</button>

            </form>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>