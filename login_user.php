<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM voter WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Check password (use password_verify if passwords are hashed)
        if ($user['password'] === $pwd) { // Change to password_verify($pwd, $user['password']) if using hashing

            if ($user['status'] == 'Approved') {
                $_SESSION['user_id'] = $user['id']; // Store user ID instead of email

                // Check if the user has already voted
                $voteQuery = "SELECT * FROM votes WHERE email = ?";
                $stmt2 = mysqli_prepare($conn, $voteQuery);
                mysqli_stmt_bind_param($stmt2, "s", $email);
                mysqli_stmt_execute($stmt2);
                $voteResult = mysqli_stmt_get_result($stmt2);

                if (mysqli_num_rows($voteResult) > 0) {
                    echo '
                        <script>
                            alert("You have already voted. You cannot vote again!");
                            window.location = "home.html";
                        </script>
                    ';
                } else {
                    echo '
                        <script>
                            alert("Login successful. Your approval is confirmed!");
                            window.location = "user_vote.html";
                        </script>
                    ';
                }
            } else {
                echo '
                    <script>
                        alert("Your voter ID registration is under verification. Kindly wait for approval.");
                        window.location = "home.html";
                    </script>
                ';
            }
        } else {
            echo '
                <script>
                    alert("Login failed. Invalid email or password.");
                    window.location = "login_user.html";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Login failed. Invalid email or password.");
                window.location = "login_user.html";
            </script>
        ';
    }
}
?>
