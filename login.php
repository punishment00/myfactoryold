<?php 
session_start(); 
// assign page title
$page_title = "Login"; 

// db conn
include "classes/Database.php"; 
$db = new Database(); 


if(isset($_SESSION["login_error"]))
{
    $login_error = ($_SESSION["login_error"]) ? true : false; 
}
else
{
    $login_error = false;
}

if(isset($_POST["username"]))
{
    $username = $_POST["username"]; 
    $usr_password = $_POST["usr_password"]; 

    include "classes/User.php"; 
    $user_class = new User(); 
    $user_class->setConn($db->conn); 

    $user_class->login($username, $usr_password); 
}



// include page header
include 'include/header.php';
?>
<style type="text/css">
    #login-form .form-group *, 
    #login-form p 
    {
        font-size: 12px !important; 
    }

    #login-form legend 
    {
        font-size: 1rem !important; 
        font-weight: 500; 
    }

    p#response_text 
    {
        color: red; 
    }
</style>

<div class="container-fluid">
    <div class="row no-gutter pt-5">
        <div class="card col-4 mx-auto mt-5">
            <div class="card-body">
                <form class="needs-validation" id="login-form" method="POST" action="login.php">
                    
                    <legend>Login</legend>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control" type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input class="form-control" type="password" name="usr_password" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>

                    <p class=" <?= ($login_error) ? "show" : "hide"; ?>" id="response_text">
                        <?= ($login_error) ? "Invalid username or password!" : ""; ?>
                    </p>
                </form>
            </div>
        </div>
    </div>    
</div>

<?php 
// include page footer
include 'include/footer.php'; 

// db close conn 
$db->closeConn(); 
?>