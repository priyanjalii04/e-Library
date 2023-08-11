<?php
include("db.php");

function convertToImageUrl($title)
{
    $title = preg_replace("/[^a-zA-Z0-9\s\-]/", "", $title);
    $title = str_replace(" ", "-", $title);
    $title = strtolower($title);

    return $title;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if (isset($_POST["addBook"])) {

        $title = $_POST["title"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $cover = $_FILES["choosefile"];

        $target_dir = 'cover/';
        $cover_name = convertToImageUrl($title) . "." . pathinfo($cover["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . $cover_name;
        move_uploaded_file($cover["tmp_name"], $target_file);

        $stmt = $conn->prepare('INSERT INTO booksss(cover,title,author,description)VALUES(?,?,?,?)');
        $stmt->bind_param('ssss', $target_file, $title, $author, $description);

        if ($stmt->execute()) {
            $stmt->close();
        } else {
            echo 'ERROR: ' . $stmt->error;
        }
    }
} else {
    echo "access denied ,
        not working properly";
}
