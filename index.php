<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-Libarary website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="stylehome.css">


</head>
<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class=" container-fluid ">
      <p class="logo display-2 me-5 mb-1 fw-bold">e-Library</p>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5 fw-semibold">

          <li class="nav-item">
            <button class="nav-link active" aria-current="page" href="#">Home</button>
          </li>

          <li class="nav-item">
            <button class="nav-link" id="addBookHook" aria-current="page" data-bs-toggle="modal" data-bs-target="#addBookModal" href="#">Add Book</button>
          </li>

          <li class="nav-item">
            <form action="" method="post"><button class=" btn nav-link" name="logout" id="logoutHook" aria-current="page" href="#">Logout</button></form>
          </li>

          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" id="loginHook" aria-current="page" href="#">Login</button>
          </li>

        </ul>
       

        <form class="d-flex" role="search" action="search_books.php" method="GET">
    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<!-- Add a div to display search results -->
<div id="searchResults"></div>


      </div>
  </nav>
</header>

<body>


  <div class="w-100">
    <img src="image.png" alt="" class="img-fluid w-100 h-75 mb-5">
  </div>


  <div class="d-flex flex-wrap gap-5 justify-content-center">

    <?php
    require_once('db.php');
    $stmt = $conn->prepare("SELECT * FROM booksss");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($book = $result->fetch_assoc()) {
      echo '
      <div class="card" style="width: 14rem; height:26rem">
        <img src="' . $book['cover'] . '" class="card-img-top h-75">
      <div class="card-body">
       <h5 class="card-title">' . $book['title'] . '</h5>
       <p class="card-subtitle">' . $book['author'] . '</p>
    </div>
</div>
    ';
    }
    $stmt->close();
    ?>
  </div>


  <!-- Modal  login-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">LogIn</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="loginform">
            <input type="hidden" name="signIn">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp">
              <div id="emailHelp" class="text-danger"></div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="inputPassword">
              <div id="passwordHelp" class="text-danger"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal register-->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action='' method='POST' id="registerform">
            <input type="hidden" name='signUp'>
            <div class="mb-3">
              <label for="registerInputUsername" class="form-label">Username</label>
              <input type="Username" class="form-control" name='username' id="registerInputUsername">
            </div>

            <div class="mb-3">
              <label for="registerInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" name='email' id="registerInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="registerInputPassword1" class="form-label">Password</label>
              <input type="password" name='password' class="form-control" id="registerInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">sign in</button>
        </div>
      </div>
    </div>
  </div>



  <!-- model add-book -->

  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action='' method='POST' enctype="multipart/form-data">
            <input type="hidden" name='addBook'>
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Title</label>
              <input type="text" class="form-control" name='title' id="bookTitle">
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Author</label>
              <input type="text" class="form-control" name='author' id="bookAuthor">
            </div>
            <div class="mb-3">
              <label for="bookGenre" class="form-label">Description</label>
              <input type="text" class="form-control" name='genre' id="bookGenre">
            </div>
            <div class="mb-3">
              <label for="bookCover" class="form-label">Cover Image</label>
              <input type="file" class="form-control" name="cover" id="bookCover">
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
          </form>
        </div>
      </div>
    </div>
  </div>




</body>

<?php



if (isset($_POST['signUp'])) {
  session_start();
  $username = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $id = '';
  $maxAttempts = 10; // Maximum attempts to find a unique token
  for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
    $temp = generateToken(); // Generate a token

    $stmt = $conn->prepare("SELECT * FROM registrationn WHERE id = ?");
    $stmt->bind_param("s", $temp);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
      $id = $temp;
      break;
    }
  }
  $stmt = $conn->prepare("INSERT INTO registrationn (id, username, email, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $id, $username, $email, $pass);
  $stmt->execute();
  header('Location: index.php');
  exit();
}




?>


<footer class="bg-dark text-white mt-5">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-4">
        <h3>About Us</h3>
        <p>Information about our e-Library.</p>
      </div>
      <div class="col-md-4">
        <h3>Contact Us</h3>
        <p>Email: <a href="mailto:priyanjali1501@gmail.com">priyanjali1501@gmail.com</a></p>
        <p>Phone: 9389731986</p>
      </div>
      <div class="col-md-4">
        <h3>Follow Us</h3>

        <a href="https://www.instagram.com/#" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram" style="font-size: 35px;"></i></a>

        <a href="https://www.linkedin.com/in/your_linkedin_profile/" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin" style="font-size: 35px;"></i></a>
      </div>
    </div>
  </div>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
  <?php
  if (isset($_SESSION['token'])) {
    $stmt = $conn->prepare("SELECT * FROM registrationn WHERE id =?");
    $stmt->bind_param('s', $_SESSION['token']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      echo 'document.getElementById("loginHook").classList.add("d-none");';
      echo 'console.log("5667");';
    } else {
      echo 'document.getElementById("addBookHook").classList.add("d-none");';
      echo 'document.getElementById("logoutHook").classList.add("d-none");';
      echo 'console.log("two");';
    }
  } else {
    echo 'document.getElementById("addBookHook").classList.add("d-none");';
    echo 'document.getElementById("logoutHook").classList.add("d-none");';
    echo 'console.log("three");';
  }

  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
  }  ?>
</script>

<script>
  document.querySelector('form[role="search"]').addEventListener('submit', function(event) {
    event.preventDefault();
    const query = document.querySelector('input[type="search"]').value;

    fetch('search_books.php?query=' + encodeURIComponent(query))
      .then(response => response.json())
      .then(books => {
        const searchResultsDiv = document.getElementById('searchResults');
        searchResultsDiv.innerHTML = ''; // Clear previous results

        if (books.length === 0) {
          searchResultsDiv.innerHTML = '<p>No results found.</p>';
        } else {
          books.forEach(book => {
            const bookCard = `
                            <div class="card">
                                <img src="${book.cover}" class="card-img-top h-75">
                                <div class="card-body">
                                    <h5 class="card-title">${book.title}</h5>
                                    <p class="card-subtitle">${book.author}</p>
                                </div>
                            </div>
                        `;
            searchResultsDiv.innerHTML += bookCard;
          });
        }
      })
      .catch(error => console.error('Error fetching search results:', error));
  });
</script>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</html>