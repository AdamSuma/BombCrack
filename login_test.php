<!DOCTYPE html>
<head>
<title>Register test</title>
<style>
.register-form{
	width: 500px;
	margin: 0 auto;
	text-align: center;
	padding: 10px;
	color: #fff;
	background : #c4c4c4;
	border-radius: 10px;
	-webkit-border-radius:10px;
	-moz-border-radius:10px;
}

.register-form form input{padding: 5px;}
.register-form .btn{background: #726E6E;
padding: 7px;
border-radius: 5px;
text-decoration: none;
width: 50px;
display: inline-block;
color: #FFF;}

.register-form .register{
border: 0;
width: 60px;
padding: 8px;
}
</style>
<?php
	require('conectare.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];
 
        $query = "INSERT INTO `user` (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = mysql_query($query);
        if($result){
            $msg = "User Created Successfully.";
        }
    }
    ?>
</head>
<body>
<div class="register-form">
<h1>Register</h1>
<form action="" method="POST">
    <p><label>User Name : </label>
	<input id="username" type="text" name="username" placeholder="username" /></p>
	
	<p><label>E-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </label>
	 <input id="password" type="email" name="email"/></p>
 
     <p><label>Password&nbsp;&nbsp; : </label>
	 <input id="password" type="password" name="password" placeholder="password" /></p>
 
    <a class="btn" href="login.php">Login</a>
    <input class="btn register" type="submit" name="submit" value="Register" />
    </form>
</div>

</body>
</html>
