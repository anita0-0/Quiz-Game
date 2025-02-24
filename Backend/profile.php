
<?php 
  session_start();

  // Example session variables for testing
  // Uncomment the below lines if you're testing the code locally
  // $_SESSION['photo'] = 'profile.jpg'; // Path to user's profile picture
  // $_SESSION['username'] = 'John Doe'; // User's name
  // $_SESSION['email'] = 'johndoe@example.com'; // User's email
  // $_SESSION['score'] = 250; // User's total score
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>
  <style>
    /* General Reset */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }

    /* Header Section */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: #333;
      color: white;
    }

    .header-title {
      font-size: 1.5rem;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .profile-container {
      position: relative;
    }

    .profile-picture {
      height: 40px;
      width: 40px;
      border-radius: 50%;
      cursor: pointer;
      overflow: hidden;
    }

    .profile-picture img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }

    /* Profile Dropdown */
    .profile-dropdown {
      position: absolute;
      top: 50px;
      right: 0;
      width: 250px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 15px;
      display: none;
      z-index: 1000;
    }

    .profile-dropdown::before {
      content: '';
      position: absolute;
      top: -10px;
      right: 20px;
      border-width: 10px;
      border-style: solid;
      border-color: transparent transparent white transparent;
    }

    .profile-info {
      text-align: center;
    }

    .profile-info img {
      height: 70px;
      width: 70px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .profile-info p {
      margin: 5px 0;
    }

    .profile-info .username {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .profile-info .email {
      font-size: 0.9rem;
      color: #555;
    }

    .profile-info .score {
      font-size: 1rem;
      font-weight: bold;
      color: #333;
    }

    .profile-dropdown a {
      display: block;
      text-align: center;
      margin-top: 15px;
      padding: 10px;
      background-color: #333;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .profile-dropdown a:hover {
      background-color: #555;
    }

    /* Categories Section */
    .categories {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 20px;
    }

    .category-card {
      width: 150px;
      height: 150px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-weight: bold;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .category-card:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <!-- Header Section -->
  <header>
    <div class="header-title">Quiz Categories</div>
    <div class="profile-container">
      <?php
      if (isset($_SESSION['photo'])) {
          $photo = $_SESSION['photo'];
          $username = $_SESSION['username'] ?? "User";
          $email = $_SESSION['email'] ?? "example@example.com";
          $score = $_SESSION['score'] ?? 0;

          echo "
            <div class='profile-picture'>
              <img src='$photo' alt='Profile'>
            </div>
            <div class='profile-dropdown'>
              <div class='profile-info'>
                <img src='$photo' alt='Profile'>
                <p class='username'>$username</p>
                <p class='email'>$email</p>
                <p class='score'>Score: $score</p>
              </div>
              <a href='logout.php'>Log Out</a>
            </div>
          ";
      } else {
          echo "<a href='login.php' style='color:white; text-decoration:none;'>Sign In</a>";
      }
      ?>
    </div>
  </header>

  

  <script>
    // Dropdown toggle functionality
    const profilePicture = document.querySelector('.profile-picture');
    const profileDropdown = document.querySelector('.profile-dropdown');

    profilePicture.addEventListener('click', () => {
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (e) => {
      if (!profilePicture.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.style.display = 'none';
      }
    });
  </script>

</body>
</html>
