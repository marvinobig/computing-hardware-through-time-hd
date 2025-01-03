<dialog id="create_modal">
    <div class="header">
        <h2 class="remove-mg">Contribution</h2>
        <button id="create_modal_close_btn" type="button" class="btn">Close</button>
    </div>
    <form id="contributions_upload" method="post" enctype="multipart/form-data">
        <label for="image">Image
            <input required type="file" name="image" id="image" accept="image/*">
        </label>

        <label for="hardware_name">Name
            <input required type="text" name="hardware_name" id="hardware_name">
        </label>

        <label for="hardware_type">Type
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
        </label>

        <label for="manufacturer">Manufacturer
            <input required type="text" name="manufacturer" id="manufacturer">
        </label>

        <label for="summary">Historical Significance Summary</label>
        <textarea name="summary" id="summary" rows="4" cols="50"></textarea>
        <label for="details">Details</label>
        <textarea name="details" id="details" rows="10" cols="50"></textarea>
        <label for="price_at_release">Price at Release
            <input required type="number" step="0.01" min="0.00" name="price_at_release" id="price_at_release">
        </label>

        <label for="status">Status
            <select required name="status" id="status">
                <option value="na">N/A</option>
                <option value="fully_supported">Fully Supported</option>
                <option value="limited_support">Limited Support</option>
                <option value="obsolete">Obsolete</option>
            </select>
        </label>

        <label for="release_date">Release Date
            <input required type="date" name="release_date" id="release_date">
        </label>

        <button type="submit" class="btn">Add to Contributions</button>
    </form>
</dialog>
<button id="create_modal_open_btn" type="button" class="btn">
    Add a contribution
</button>