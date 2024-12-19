<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "bootstrap.php";

use App\Utilities;

$title = 'Homepage';
$database->createTables('chtt_db.sql');
$database->createAdmin('admin', 'admin');
?>

<!DOCTYPE html>
<html lang="en">
    <?php Utilities::loadPartial('head', ['title' => $title]) ?>

    <body>
        <?php Utilities::loadPartial('nav') ?>

        <header id="homepage-header">
            <div class="content">
                <h1>Welcome to the Computing Hardware Through Time Database</h1>
                <p>Discover key milestones and contributions to the computing industry over time.</p>
                <h2>About the Database</h2>
                <p>Our platform hosts a comprehensive database of hardware contributions to the computing industry.
                    The
                    listings include information on various hardware, such as its release year, manufacturer,
                    hardware type,
                    and status. You can explore these contributions by using tools such as search and filtering options.
                </p>
            </div>
        </header>

        <main id="homepage">
            <section class="section-title">
                <h2>Explore Features</h2>
            </section>

            <section>
                <div class="content">
                    <h3>Search for Hardware by Name</h3>
                    <p>Use the search bar to quickly find hardware products by name. Whether you’re looking for a
                        specific piece of hardware or just curious, searching makes it easy to locate the items
                        you’re
                        interested in.</p>
                </div>
            </section>

            <section>
                <div class="content">
                    <h3>Filter Hardware Listings</h3>
                    <p>Filter hardware listings based on important criteria such as year, hardware type and status
                        (e.g., obsolete, fully supported). This makes it easier to narrow down your search and find
                        exactly what you're looking for in the database.</p>
                </div>
            </section>

            <section>
                <div class="content">
                    <h3>View Detailed Hardware Information</h3>
                    <p>Each hardware listing includes detailed information such as the product name, manufacturer,
                        release date, and more. You can explore each entry to learn about the hardware
                        contribution to
                        the computing industry.</p>
                </div>
            </section>

            <section>
                <div class="content">
                    <h3>Track Changes to Hardware Listings as an Admin</h3>
                    <p>Our platform keeps a history of changes made to hardware listings. You can see the updates
                        and
                        revisions to each entry, providing full transparency on how the information evolves over
                        time within the admin dashboard.
                    </p>
                </div>
            </section>

            <section>
                <div class="content">
                    <h3>Update content Without Page Reloads on The Admin Dashboard</h3>
                    <p>When adding or deleting hardware contributions, the platform instantly shows changes without
                        needing to reload the page. This provides a faster and smoother admin experience.</p>
                </div>
            </section>
        </main>

        <?php Utilities::loadPartial('footer') ?>
    </body>

</html>