<?php
require_once('db.php'); // Include your database connection code

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM booksss WHERE title LIKE ? OR author LIKE ?");
    $queryParam = '%' . $query . '%';
    $stmt->bind_param("ss", $queryParam, $queryParam);
    $stmt->execute();
    $result = $stmt->get_result();

    $books = [];
    while ($book = $result->fetch_assoc()) {
        $books[] = $book;
    }

    echo json_encode($books);
}
?>
