<?php 
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

//$conn = db_connect();
$user_id = $_SESSION['user_id'];

// Toggle this to enable or disable simulation
$simulating = false;  // Set to true to simulate, false for real-time

// Use test year 2025 if simulating; otherwise, use the current year
$current_year = $simulating ? 2025 : date('Y');

// Fetch the last year progress was logged
$sql_last_year = "SELECT MAX(year) as last_year FROM YearlyProgress WHERE user_id = ?";
$stmt_last_year = $conn->prepare($sql_last_year);
$stmt_last_year->bind_param('i', $user_id);
$stmt_last_year->execute();
$stmt_last_year->bind_result($last_year);
$stmt_last_year->fetch();
$stmt_last_year->close();

// Initialize last logged year if no data exists
if ($last_year === null) {
    $last_year = $current_year - 1;
}

// Log last year's progress if in a new year
if ($current_year > $last_year) {
    $sql_chapters_read = "SELECT COUNT(*) as chapters_read FROM BibleReadingProgress WHERE user_id = ? AND YEAR(timestamp) = ?";
    $stmt_chapters_read = $conn->prepare($sql_chapters_read);
    $stmt_chapters_read->bind_param('ii', $user_id, $last_year);
    $stmt_chapters_read->execute();
    $stmt_chapters_read->bind_result($chapters_read);
    $stmt_chapters_read->fetch();
    $stmt_chapters_read->close();

    $total_chapters_in_bible = 1189;
    $percentage_read = ($total_chapters_in_bible > 0) ? round(($chapters_read / $total_chapters_in_bible) * 100, 2) : 0;

    $sql_log_year = "INSERT INTO YearlyProgress (user_id, year, percentage_read, total_chapters_read, total_chapters_in_bible) VALUES (?, ?, ?, ?, ?)";
    $stmt_log_year = $conn->prepare($sql_log_year);
    $stmt_log_year->bind_param('iidii', $user_id, $last_year, $percentage_read, $chapters_read, $total_chapters_in_bible);
    $stmt_log_year->execute();
    $stmt_log_year->close();
}

// Fetch books and chapters data
$sql_books = "SELECT book_name, total_chapters FROM BibleBooks";
$result_books = $conn->query($sql_books);

$sql_progress = "SELECT book, COUNT(chapter) AS chapters_read FROM BibleReadingProgress WHERE user_id = ? AND YEAR(timestamp) = ? GROUP BY book";
$stmt_progress = $conn->prepare($sql_progress);
$stmt_progress->bind_param('ii', $user_id, $current_year);
$stmt_progress->execute();
$result_progress = $stmt_progress->get_result();

// Prepare data for chart
$book_data = [];
$overall_chapters_read = 0;
$total_chapters_in_bible = 0;
$progress_map = [];

// Store progress data in a map for easy access
while ($row_progress = $result_progress->fetch_assoc()) {
    $progress_map[$row_progress['book']] = $row_progress['chapters_read'];
}

// Build the data for each book
while ($row_book = $result_books->fetch_assoc()) {
    $book_name = $row_book['book_name'];
    $total_chapters = $row_book['total_chapters'];
    $chapters_read = $progress_map[$book_name] ?? 0;

    $book_data[] = [
        'book_name' => $book_name,
        'total_chapters' => $total_chapters,
        'chapters_read' => $chapters_read
    ];

    $overall_chapters_read += $chapters_read;
    $total_chapters_in_bible += $total_chapters;
}

$overall_percentage = ($total_chapters_in_bible > 0) ? round(($overall_chapters_read / $total_chapters_in_bible) * 100, 2) : 0;

$stmt_progress->close();
$conn->close();
?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="center container">
        <h1>Your Bible Reading Progress</h1>
        <h3>Overall Bible Reading Progress: <?php echo $overall_percentage; ?>%</h3>
        <canvas id="progressChart"></canvas>
        <button onclick="window.location.href='log_progress.php'" class="log-button">Log New Progress</button>
    </div>

    <script>
    const labels = <?php echo json_encode(array_column($book_data, 'book_name')); ?>;
    const data = <?php echo json_encode(array_map(function($data) {
        return ($data['total_chapters'] > 0) ? round(($data['chapters_read'] / $data['total_chapters']) * 100, 2) : 0;
    }, $book_data)); ?>;

    const ctx = document.getElementById('progressChart').getContext('2d');
    const progressChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Read (%)',
                data: data,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
                borderColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // Hides the legend entirely
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            return label + ': ' + value + '% read';
                        }
                    }
                }
            }
        }
    });
</script>


</body>
</html>
