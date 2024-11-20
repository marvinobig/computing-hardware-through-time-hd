<?php
$title = 'Contributions';

var_dump($_POST);
var_dump($_FILES)
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.partial.php' ?>

    <body>
        <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'nav.partial.php' ?>

        <main>
            <h1>Contributions</h1>

            <form id="contributions_upload" method="post" enctype="multipart/form-data">
                <section>
                    <label for="main_image">Main Image</label>
                    <input required type="file" name="main_image" id="main_image" accept="image/*">
                </section>
                <section>
                    <label for="thumbnail">Thumbnail</label>
                    <input required type="file" name="thumbnail" id="thumbnail" accept="image/*">
                </section>
                <section>
                    <label for="hardware_name">Name</label>
                    <input required type="text" name="hardware_name" id="hardware_name">
                </section>
                <section>
                    <label for="hardware_type">Type</label>
                    <select required name="hardware_type" id="hardware_type">
                        <option value="cpu">CPU (Processor)</option>
                        <option value="gpu">GPU (Graphics Processing Unit)</option>
                        <option value="ram">RAM (Memory)</option>
                        <option value="ssd">SSD (Solid State Drive)</option>
                        <option value="hdd">HDD (Hard Disk Drive)</option>
                        <option value="motherboard">Motherboard</option>
                        <option value="psu">PSU (Power Supply Unit)</option>
                        <option value="cooling">Cooling System</option>
                        <option value="network_card">Network Card</option>
                        <option value="sound_card">Sound Card</option>
                        <option value="case">PC Case</option>
                        <option value="peripherals">Peripherals (Mouse, Keyboard, etc.)</option>
                    </select>
                </section>
                <section>
                    <label for="manufacturer">Manufacturer</label>
                    <input required type="text" name="manufacturer" id="manufacturer">
                </section>
                <section>
                    <label for="historical_significance">Historical Significance</label>
                    <textarea name="historical_significance" id="historical_significance" rows="4" cols="50"></textarea>
                </section>
                <section>
                    <label for="details">Details</label>
                    <textarea name="details" id="details" rows="10" cols="50"></textarea>
                </section>
                <section>
                    <label for="price_at_release">Price at Release</label>
                    <input required type="number" step="0.01" min="0.00" name="price_at_release" id="price_at_release">
                </section>
                <section>
                    <label for="status">Status</label>
                    <select required name="status" id="status">
                        <option value="na">N/A</option>
                        <option value="fully_supported">Fully Supported</option>
                        <option value="limited_support">Limited Support</option>
                        <option value="obsolete">Obsolete</option>
                    </select>
                </section>
                <section>
                    <label for="release_date">Release Date</label>
                    <input required type="date" name="release_date" id="release_date">
                </section>

                <section>
                    <button type="submit">Add to Contributions</button>
                </section>
            </form>
        </main>
    </body>

</html>