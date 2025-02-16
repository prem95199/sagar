<?php

    include("connection.php");

    $fname = $_POST['fname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone= $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];

    if($fname !="" && $dob !=""  && $email !=""  && $gender !=""  && $phone !=""  && $password !=""  && $cpassword !=""  && $address !="")
    {
        if($password==$cpassword)
        {
            $insert = mysqli_query($conn, "INSERT INTO voter (fname, dob, email, gender, phone, password, cpassword, address)
             VALUES ('$fname', '$dob', '$email', '$gender', '$phone', '$password', '$cpassword', '$address')");
            
            if($insert)
            {
                echo '
                    <script>
                        alert("Registration succesfully");
                        window.location ="login_user.html";
                    </script>
            
                ';  
            }
            else
            {
                echo '
                    <script>
                        alert("Some error occured");
                        window.location ="register_user.html";
                    </script>
            
                ';
            }
        }
        else
        {
            echo '
                <script>
                    alert("Password and confirm password dose not match");
                    window.location ="register_user.html";
                </script>
            
            ';
        } 
    }
    else
    {
        echo '
            <script>
                alert("Please fill the form");
                window.location ="register_user.html";
            </script>
    
        ';

    }

   

?>