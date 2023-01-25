<?php
//we include the connection file.
require_once 'config.php';

//we check whether the record button has been clicked. We use isset for this.
if (isset($_POST['signup'])) {
    //We transfer the data from the POST to individual variables.
    $user_name = $_POST['user_name'];
    $user_mail = $_POST['user_mail'];
    /*We save the password from the POST to the database in an encrypted way. 
    For this we use the sha1 and mb5 command. Thus, we record in a 2-fold protected way. */
    $encrypted_user_pass = sha1(md5($_POST['user_pass']));

    /*We check whether the place where the username, user email, user password will be entered is empty. 
    In this way, we prevent anonymous registration in the database. */
    if (empty($_POST['user_name'])) {
        //we warn if the user name is empty.
        echo "Please enter your user name";
    } elseif (empty($_POST['user_mail'])) {
        //we warn if the user email is empty.
        echo "Please enter your email";
    } elseif (empty($_POST['user_pass'])) {
        //we warn if the user password is empty.
        echo "Please enter your password";
    } else {

        //if no box is empty, we perform the registration process.
        //during the registration process, we do the same as the operations in the datainsert file.
        $signup = $db->prepare("INSERT INTO members SET user_name=?, user_mail=?, user_pass=?");
        $run = $signup->execute([
            $user_name,
            $user_mail,
            //we write the variable of the data we encrypt.
            $encrypted_user_pass
        ]);
        //In the ELSE block, if the registration process has been successfully completed, we send a successful alert.
        if ($signup) { ?>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    The data was added with success. Page is being refreshed.

                </div>
            </div>
            <!-- if the registration process has been completed successfully, we ensure that the page is automatically refreshed. -->
        <?php header("Refresh:5");
        } else { ?>
            <!-- if the registration is unsuccessful, we send a warning alert. -->
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    The data was added with not success.
                </div>
            </div>
<?php }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign Up</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="row p-5">
                <div class="col p-5">
                    <form method="POST">
                        <div class="form-group">
                            <label for="exampleInputUsername1">User Name</label> <!-- when the boxes are empty and the record button is pressed, we write a short if query so that the entered data is not deleted from the boxes. -->
                            <input type="text" name="user_name" class="form-control" placeholder="Enter User Name" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : null; ?>">

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="user_mail" class="form-control" placeholder="Enter Email" value="<?= isset($_POST['user_mail']) ? $_POST['user_mail'] : null; ?>">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="user_pass" class="form-control" placeholder="Password" value="<?= isset($_POST['user_pass']) ? $_POST['user_pass'] : null; ?>">

                        </div>
                        <button type="submit" name="signup" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col p-5">
                    <img src="img/signup-image.jpg" alt="">
                </div>
            </div>

        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
