<?php
include("database.php");



if (isset($_POST['submit'])) {
    $naam=$_POST['name'];
    $name = $_POST['username'];
    $pw = $_POST['password'];
    $email = $_POST['email'];

    $file_name = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = 'Images/' . basename($file_name);

    // Check if username already exists
    $sql1 = "SELECT * FROM login WHERE username = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $name);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        echo "Username already exists";
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['photo']['type'], $allowed_types)) {
            echo "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        } else {
            // Hash the password

            // Insert user into the database
            $sql2 = "INSERT INTO login (name,username, password, photo,email) VALUES (?, ?, ?,?,?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sssss", $naam,$name, $pw, $folder,$email);

            // Move file and execute query
            if (move_uploaded_file($tempname, $folder)) {
                if ($stmt2->execute()) {
                    echo "Signup successful! You can now log in.";
                    header("location:login.php");
                } else {
                    echo "Error: " . $stmt2->error;
                }
            } else {
                echo "Failed to upload profile picture.";
            }
        }
    }

    $stmt1->close();
    if (isset($stmt2)) {
        $stmt2->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('signup1.jpg'); /* Replace 'art1.jpg' with the path to your background image */
      background-size: cover;
      background-repeat: repeat-y; /* Allows vertical scrolling */
      background-position: center 0;
      animation: scrollBackground 2s linear infinite; /* Anim ate scrolling */
      height: 100vh; /* Full viewport height */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
    }

    /* Keyframes for scrolling background */
    @keyframes scrollBackground {
      0% {
        background-position: center 0;
      }
      100% {
        background-position: center 100%;
      }
    }
   
        .login-box {
  height: 50px;
  width: 500px;
  font-size: 1.2rem;
}

    </style>
</head>

<body>
    <div style="display: flex; justify-content: center;font-size:2.3rem;font-weight:bold;padding-top:1.5rem;font-family: 'Press Start 2P', cursive;
">
        SIGN UP
    </div>
    <div align="center">
        <form action="signup.php" method="POST" enctype="multipart/form-data" style="width: 1000px;">
            

        <div align="left" style="width: 500px;">
                    <big><b>Name</b></big><br>
                    <input name="name" type="text" class="login-box" required>
                </div><br><br>
                <div align="left" style="width: 500px;">
                    <big><b>Username</b></big><br>
                    <input name="username" type="text" class="login-box" required>
                </div><br><br>
                <div align="left" style="width: 500px;">
                    <big><b>Password</b></big><br>
                    <input name="password" type="password" class="login-box" required>
                </div><br><br>
                <div align="left" style="width: 500px;">
                    <big><b>Email</b></big><br>
                    <input name="email" type="email" class="login-box" required>
                </div><br><br>
                <div align="left" style="width: 500px;">
                    <big><b>Profile Picture</b></big><br>
                    <input type="file" name="photo" accept="image/*" required>
                </div><br><br>
                <div align="center">
                    <input type="submit" name="submit" value="Sign up"
                        style="padding: 10px 30px;background-color:#CD5C5C; color: white; font-size: 1.2rem;">
                </div><br><br>
            </fieldset>
        </form>
    </div>
</body>

</html>