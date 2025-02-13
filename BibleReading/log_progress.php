<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// $conn = db_connect();
$user_id = $_SESSION['user_id'];
$simulating = false;
$current_year = $simulating ? 2025 : date('Y');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'log_chapters') {
    $book = $_POST['book'];
    $selected_chapters = isset($_POST['chapters']) ? $_POST['chapters'] : [];

    // Fetch existing chapters for this user, book, and year
    $sql_existing = "SELECT chapter FROM BibleReadingProgress WHERE user_id = ? AND book = ? AND YEAR(timestamp) = ? AND is_usable = TRUE";
    $stmt_existing = $conn->prepare($sql_existing);
    $stmt_existing->bind_param('isi', $user_id, $book, $current_year);
    $stmt_existing->execute();
    $result_existing = $stmt_existing->get_result();

    $existing_chapters = [];
    while ($row = $result_existing->fetch_assoc()) {
        $existing_chapters[] = $row['chapter'];
    }
    $stmt_existing->close();

    // Identify chapters to add and remove
    $chapters_to_add = array_diff($selected_chapters, $existing_chapters);
    $chapters_to_remove = array_diff($existing_chapters, $selected_chapters);

    // Add chapters that are newly selected
    foreach ($chapters_to_add as $chapter) {
        $sql_insert = "INSERT INTO BibleReadingProgress (user_id, book, chapter, timestamp, is_usable) VALUES (?, ?, ?, ?, TRUE)";
        $stmt_insert = $conn->prepare($sql_insert);
        $timestamp = $simulating ? "$current_year-" . date('m-d H:i:s') : date('Y-m-d H:i:s');
        $stmt_insert->bind_param('isis', $user_id, $book, $chapter, $timestamp);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    // Remove chapters that were unchecked
    foreach ($chapters_to_remove as $chapter) {
        $sql_delete = "DELETE FROM BibleReadingProgress WHERE user_id = ? AND book = ? AND chapter = ? AND YEAR(timestamp) = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param('isii', $user_id, $book, $chapter, $current_year);
        $stmt_delete->execute();
        $stmt_delete->close();
    }

    header('Location: dashboard.php');
    exit;
}

// Fetch all books
$sql_books = "SELECT book_name, total_chapters FROM BibleBooks";
$result_books = $conn->query($sql_books);

$total_chapters = 0;
$chapters_read = [];
$book = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'select_book') {
    $book = $_POST['book'];

    // Get the total chapters for the selected book
    $sql_total_chapters = "SELECT total_chapters FROM BibleBooks WHERE book_name = ?";
    $stmt_total_chapters = $conn->prepare($sql_total_chapters);
    $stmt_total_chapters->bind_param('s', $book);
    $stmt_total_chapters->execute();
    $stmt_total_chapters->bind_result($total_chapters);
    $stmt_total_chapters->fetch();
    $stmt_total_chapters->close();

    // Fetch chapters already read and marked as usable for the selected year
    $sql_read = "SELECT chapter FROM BibleReadingProgress WHERE user_id = ? AND book = ? AND YEAR(timestamp) = ? AND is_usable = TRUE";
    $stmt_read = $conn->prepare($sql_read);
    $stmt_read->bind_param('isi', $user_id, $book, $current_year);
    $stmt_read->execute();
    $result_read = $stmt_read->get_result();
    while ($row = $result_read->fetch_assoc()) {
        $chapters_read[] = $row['chapter'];
    }
    $stmt_read->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Progress</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Log Your Bible Reading Progress</h1>

        <!-- Book selection form -->
        <form method="POST" action="" id="bookForm">
            <input type="hidden" name="action" value="select_book">
            <label for="book">Select a Book:</label>
            <select name="book" id="book" onchange="submitBookForm()" required>
                <option value="">Select a Book</option>
                <?php while ($row = $result_books->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['book_name']); ?>" <?php if (isset($book) && $book == $row['book_name']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($row['book_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>

        <!-- Display chapters for selected book -->
        <?php if (isset($book) && $total_chapters > 0): ?>
            <form method="POST" action="">
                <input type="hidden" name="action" value="log_chapters">
                <input type="hidden" name="book" value="<?php echo htmlspecialchars($book); ?>">

                <h2><?php echo htmlspecialchars($book); ?> - Chapters</h2>

                <!-- Scrollable chapter checkboxes container -->
                <div class="checkbox-grid">
                    <?php for ($i = 1; $i <= $total_chapters; $i++): ?>
                        <label>
                            Chapter <?php echo $i; ?>
                            <input type="checkbox" name="chapters[]" value="<?php echo $i; ?>" <?php if (in_array($i, $chapters_read)) echo 'checked'; ?>>
                        </label>
                    <?php endfor; ?>
                </div>

                <!-- Compact sticky buttons at the bottom of the screen -->
                <div class="sticky-buttons">
                    <input type="submit" value="Save Progress" class="log-button">
                    <a href="dashboard.php" class="back-button">Back to Dashboard</a>
                </div>
            </form>
        <?php elseif (isset($book)): ?>
            <p>No chapters available for this book.</p>
        <?php endif; ?>
    </div>

    <script>
        function submitBookForm() {
            document.getElementById('bookForm').submit();
        }
    </script>
</body>
</html>
