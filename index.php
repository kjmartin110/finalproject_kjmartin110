
<?php
// Kevin Martin
// November 17, 2026
// Final Project - Home Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Directory - Home</title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="scripts/main.js" defer></script>
</head>
<body data-page="home">

    <header>
        <h1>Student Directory</h1>
        <h2>Kevin Martin</h2>
        <p>Today's Date: <?php echo date("F j, Y"); ?></p>
    </header>

    <main>
        <section id="ImageGallery">
            <h2>Image Gallery</h2>

            <div class="gallery">
                <figure>
                    <img src="media/campus.jpg"
                         alt="College campus">
                    <figcaption>College Campus</figcaption>
                </figure>

                <figure>
                    <img src="media/technology.jpg"
                         alt="Computer technology">
                    <figcaption>Technology</figcaption>
                </figure>

                <figure>
                    <img src="media/study.jpg"
                         alt="Students studying">
                    <figcaption>Student Learning</figcaption>
                </figure>
            </div>
        </section>

        <section class="search-section">
            <h2>Search Student Directory</h2>

            <form action="search.php" method="POST">
                <label for="last_name">Enter Last Name:</label>
                <input type="text"
                       id="last_name"
                       name="last_name"
                       maxlength="50"
                       required>

                <button type="submit">Search</button>
            </form>
        </section>
    </main>

</body>
</html>
