
<?php
// Name: Kevin Martin
// Date: November 17, 2026
// Final Project - Student Search

$result = null;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $lastName = trim($_POST["last_name"] ?? "");

    if ($lastName === "") {
        $errorMessage = "Please enter a last name.";
    } else {
        try {
            // Connect to DDEV MySQL database
            $conn = new mysqli(
                "db",
                "db",
                "db",
                "student_directory"
            );

            $conn->set_charset("utf8mb4");

            // Prepare stored procedure
            $stmt = $conn->prepare(
                "CALL search_students(?)"
            );

            // Bind parameter securely
            $stmt->bind_param("s", $lastName);

            // Execute search
            $stmt->execute();

            // Get results
            $result = $stmt->get_result();

        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());

            // Log errors without exposing database details
            $errorMessage = "Database connection or search failed.";
        }
    }
} else {
    $errorMessage = "Please search from the home page.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Search Results</title>

    <link rel="stylesheet" href="styles/main.css">
    <script src="scripts/main.js" defer></script>
</head>

<body data-page="search">

    <header>
        <h1>Student Directory</h1>
        <h2>Kevin Martin</h2>
    </header>

    <main>
        <h3>Search Results</h3>

        <?php if ($errorMessage !== ""): ?>

            <p>
                <?php echo htmlspecialchars(
                    $errorMessage,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?>
            </p>

        <?php elseif ($result && $result->num_rows > 0): ?>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars(
                                        (string)$row["id"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    ); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars(
                                        $row["first_name"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    ); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars(
                                        $row["last_name"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    ); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars(
                                        $row["email"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    ); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <p>No students found.</p>

        <?php endif; ?>

        <p>
            <a href="index.php">Return to Home Page</a>
        </p>
    </main>

</body>
</html>
