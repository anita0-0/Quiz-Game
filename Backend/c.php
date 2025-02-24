
<?php   
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizdom - Frontpage</title>
  <style>
    /* Import Pixel Font */
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    /* General Reset */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }

    /* Header Section */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 20px;
      background-color: #333;
      color: white;
    }

    h1 {
      font-family: 'Press Start 2P', cursive;
      font-size: 3rem;
      margin: 0;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
      position: relative;
    }

    .header-right input[type="text"] {
      padding: 8px;
      font-size: 1rem;
      border: 2px solid #ccc;
      border-radius: 5px;
    }

    .header-right button {
      padding: 8px 20px;
      font-size: 1rem;
      background-color: rgb(30, 30, 177);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .header-right button:hover {
      background-color: #E0B0FF;
    }

    .profile-container {
      position: relative;
      cursor: pointer;
    }

    .photo {
      height: 40px;
      width: 40px;
      overflow: hidden;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .photo img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }

    .dropdown {
      display: none;
      position: absolute;
      top: 50px;
      right: 0;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 10;
      min-width: 200px;
      padding: 10px;
    }

    .dropdown.active {
      display: block;
    }

    .dropdown-item {
      padding: 10px;
      color: #333;
      text-decoration: none;
      display: block;
      cursor: pointer;
    }

    .dropdown-item:hover {
      background-color: #f4f4f4;
    }

    .dropdown-item a {
      color: inherit;
      text-decoration: none;
    }

    /* Categories Section */
    .categories {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-evenly;
      padding: 40px;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .category-box {
      width: 180px;
      height: 140px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: transform 0.2s;
    }

    .category-box:hover {
      transform: scale(1.05);
    }

    .category-box .icon {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .category-box span {
      font-size: 1.2rem;
      font-weight: bold;
    }

    /* Create Own Quiz Section */
    .create-quiz {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      background-color: #ffffff;
      margin-top: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .create-quiz .quiz-content {
      text-align: left;
      margin-left: 20px;
      max-width: 500px;
    }

    .create-quiz .quiz-content h2 {
      font-size: 2rem;
      color: #333;
    }

    .create-quiz .quiz-content p {
      font-size: 1rem;
      color: #555;
      margin-top: 10px;
      line-height: 1.6;
    }

    .create-quiz img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .create-quiz button {
      padding: 10px 30px;
      font-size: 1.5rem;
      background-color: #F4A460;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 20px;
    }

    .create-quiz button:hover {
      background-color: #5F9EA0;
    }
  </style>
    <!-- Importing FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <!-- Header Section -->
  <header>
    <h1>Quizdom</h1>
    <div class="header-right">
      <input type="text" placeholder="Search...">
      <?php
      if(isset($_SESSION["photo"], $_SESSION["username"], $_SESSION["email"])) {
          $photo = $_SESSION['photo'];
          $username = $_SESSION['username'];
          $email = $_SESSION['email'];
          echo "
          <div class='profile-container'>
            <div class='photo'>
              <img src='$photo'>
            </div>
            <div class='dropdown'>
              <div class='dropdown-item'>Username: $username</div>
              <div class='dropdown-item'>Email: $email</div>
              <div class='dropdown-item'><a href='logout.php'>Log Out</a></div>
            </div>
          </div>
          ";
      } else {
          echo "<button><a href='login.php'>Sign In</a></button>";
      }
      ?>
    </div>
  </header>

  <!-- Categories Section -->
  <section class="categories">
    <a href="art-and-design.html" class="category-box" style="background-color: #ffb6c1;">
      <div class="icon"><i class="fas fa-palette"></i></div>
      <span>Art & Design</span>
    </a>

    <a href="space.html" class="category-box" style="background-color: #87CEEB;">
      <div class="icon"><i class="fas fa-rocket"></i></div>
      <span>Space</span>
    </a>

    <a href="movies-and-music.html" class="category-box" style="background-color: #ffcc99;">
      <div class="icon"><i class="fas fa-film"></i></div>
      <span>Movies & Music</span>
    </a>

    <a href="travel-and-adventure.html" class="category-box" style="background-color: #98FB98;">
      <div class="icon"><i class="fas fa-globe"></i></div>
      <span>Travel & Adventure</span>
    </a>

    <a href="animals-and-wildlife.html" class="category-box" style="background-color: #f0e68c;">
      <div class="icon"><i class="fas fa-paw"></i></div>
      <span>Animal & Wildlife</span>
    </a>

    <a href="pop-culture.html" class="category-box" style="background-color: #ffb3e6;">
      <div class="icon"><i class="fas fa-cogs"></i></div>
      <span>Pop Culture</span>
    </a>
  </section>

  <!-- Create Own Quiz Section -->
  <section class="create-quiz">
    <img src="quizdom.jpg" alt="Quiz Image"> <!-- Placeholder image -->
    <div class="quiz-content">
      <h2>Create Your Own Quiz</h2>
      <p>Have a unique idea? Create your own quiz and share it with others!</p>
      <a href="create.html" class="create-quiz-btn">
        <button>Create Quiz</button>
      </a>
    </div>
  </section>

  <script>
     document.querySelectorAll('.category-box, .create-quiz-btn').forEach(function(element) {
    element.addEventListener('click', function(event) {
      <?php if(!isset($_SESSION['photo'])): ?>
        event.preventDefault();
        alert('please log in or sign up  first to enjoy Quizdom');
        window.location.href = 'login.php';
      <?php endif; ?>
    });
  });
    // Dropdown toggle
    document.querySelector('.photo')?.addEventListener('click', function() {
      const dropdown = document.querySelector('.dropdown');
      dropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.querySelector('.dropdown');
      const profileContainer = document.querySelector('.profile-container');
      if (!profileContainer.contains(event.target)) {
        dropdown?.classList.remove('active');
      }
    });
  </script>
</body>
</html>