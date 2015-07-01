<?php
session_start();
include("header.php");
?>
Register
<br /><br />
<?php
if(isset($_POST['register'])){
    $username = protect($_POST['username']);
    $password = protect($_POST['password']);
    $email = protect($_POST['email']);
	$currentlord = protect($_POST['currentlord']);
	$house = protect($_POST['house']);
	$location = protect($_POST['location']);
    
    if($username == "" || $password == "" || $email == ""){
        echo "Please supply all fields!";
    }elseif(strlen($username) > 20){
        echo "Username must be less than 20 characters!";
    }elseif(strlen($email) > 100){
        echo "E-mail must be less than 100 characters!";
    }else{
        $register1 = mysql_query("SELECT `id` FROM `user` WHERE `username`='$username'") or die(mysql_error());
        $register2 = mysql_query("SELECT `id` FROM `user` WHERE `email`='$email'") or die(mysql_error());
        if(mysql_num_rows($register1) > 0){
            echo "That username is already in use!";
        }elseif(mysql_num_rows($register2) > 0){
            echo "That e-mail address is already in use!";
        }else{
            $ins1 = mysql_query("INSERT INTO `stats` (`health`,`gold`,`attack`,`defense`,`food`,`income`,`farming`,`mana`,`turns`) VALUES (100,100,10,10,100,10,11,0,100)") or die(mysql_error());
            $ins2 = mysql_query("INSERT INTO `unit` (`merchant`,`farmer`,`warrior`,`defender`,`wizard`) VALUES (5,5,0,0,0)") or die(mysql_error());
            $ins3 = mysql_query("INSERT INTO `user` (`username`,`password`,`email`,`lord`,`house`,`location`) VALUES ('$username','".md5($password)."','$email','$currentlord','$house','$location')") or die(mysql_error());
            $ins4 = mysql_query("INSERT INTO `weapon` (`sword`,`shield`,`tome`) VALUES (0,0,0)") or die(mysql_error());
            $ins5 = mysql_query("INSERT INTO `ranking` (`attack`,`defense`,`overall`) VALUES(0,0,0)") or die(mysql_error());
			$ins6 = mysql_query("INSERT INTO `building` (`tower`,`siege`,`wizguild`,`granary`,`taxhouse`) VALUES(0,0,0,0,0)") or die(mysql_error());
			$ins7 = mysql_query("INSERT INTO `dev` (`devlevel`,`currentdev`,`aligndev`) VALUES(1,0,)") or die(mysql_error());
            echo "You have registered!";
        }
    }
}
?>
<br /><br />
<form action="register.php" method="POST">
Username: <input type="text" name="username"/><br />
Password: <input type="password" name="password"/><br />
E-mail: <input type="text" name="email"/><br />
<hr>
Lord: <input type="text" name="currentlord"/><br />
House: <input type="text" name="house"/><br />
Location: <input type="text" name="location"/><br />
Alignment <b>[AFFECTS GAMEPLAY AND CANNOT BE CHANGED!]</b>:
<select name="align">
  <option value="order">Order [Defense Based]</option>
  <option value="nature">Nature [Farming Based]</option>
  <option value="blood">Blood [Attack Based]</option>
  <option value="gold">Gold [Income Based]</option>
   <option value="magic">Magic [Mana Based]</option>
</select>
<input type="submit" name="register" value="Register"/>
</form>
<?php
include("footer.php");
?>
