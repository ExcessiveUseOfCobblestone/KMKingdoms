<?php
session_start();
include("header.php");

if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    if(isset($_POST['train'])){
        $merchant = protect($_POST['merchant']);
        $farmer = protect($_POST['farmer']);
        $warrior = protect($_POST['warrior']);
        $defender = protect($_POST['defender']);
		$wizard = protect($_POST['wizard']);
        $food_needed = (10 * $merchant) + (10 * $farmer) + (10 * $warrior) + (10 * $defender) + (10 * $wizard);
        if($merchant < 0 || $farmer < 0 || $warrior < 0 || $defender < 0){
            output("You must train a positive number of units!");
        }elseif($stats['food'] < $food_needed){
            output("You do not have enough food!");
        }else{
            $unit['merchant'] += $merchant;
            $unit['farmer'] += $farmer;
            $unit['warrior'] += $warrior;
            $unit['defender'] += $defender;
			$unit['wizard'] += $wizard;
            
            $update_unit = mysql_query("UPDATE `unit` SET 
                                        `merchant`='".$unit['merchant']."',
                                        `farmer`='".$unit['farmer']."',
                                        `warrior`='".$unit['warrior']."',
                                        `defender`='".$unit['defender']."',
                                        `wizard`='".$unit['wizard']."'
                                        WHERE `id`='".$_SESSION['uid']."'") or die(mysql_error());
            $stats['food'] -= $food_needed;
            $update_food = mysql_query("UPDATE `stats` SET `food`='".$stats['food']."' 
                                        WHERE `id`='".$_SESSION['uid']."'") or die(mysql_error());
            include("update_stats.php");
            output("You have trained your units!");
        }
    }elseif(isset($_POST['untrain'])){
        $merchant = protect($_POST['merchant']);
        $farmer = protect($_POST['farmer']);
        $warrior = protect($_POST['warrior']);
        $defender = protect($_POST['defender']);
        $wizard = protect($_POST['wizard']);
        $food_gained = (8 * $merchant) + (8 * $farmer) + (8 * $warrior) + (8 * $defender) + (8 * $wizard);
        if($merchant < 0 || $farmer < 0 || $warrior < 0 || $defender < 0 || $wizard < 0 ){
            output("You must untrain a positive number of units!");
        }elseif($merchant > $unit['merchant'] || $farmer > $unit['farmer'] || 
                $warrior > $unit['warrior'] || $defender > $unit['defender'] || $wizard > $unit['wizard']){
            output("You do not have that many units to untrain!");
        }else{
            $unit['merchant'] -= $merchant;
            $unit['farmer'] -= $farmer;
            $unit['warrior'] -= $warrior;
            $unit['defender'] -= $defender;
            $unit['wizard'] -= $wizard;
            $update_unit = mysql_query("UPDATE `unit` SET 
                                        `merchant`='".$unit['merchant']."',
                                        `farmer`='".$unit['farmer']."',
                                        `warrior`='".$unit['warrior']."',
                                        `defender`='".$unit['defender']."',
                                        `wizard`='".$unit['wizard']."' 
                                        WHERE `id`='".$_SESSION['uid']."'") or die(mysql_error());
            $stats['food'] += $food_gained;
            $update_food = mysql_query("UPDATE `stats` SET `food`='".$stats['food']."' 
                                        WHERE `id`='".$_SESSION['uid']."'") or die(mysql_error());
            include("update_stats.php");
            output("You have untrained your units!");
        }
    }
    ?>
    <center><h2>Your Units</h2></center>
    <br />
    You can train and untrain your units here.
    <br /><br />
	<center>You have <?php echo $stats['food']; ?> food.</center>
    <form action="units.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Unit Type</b></td>
            <td><b>Number of Units</b></td>
            <td><b>Unit Cost</b></td>
            <td><b>Train More</b></td>
        </tr>
        <tr>
            <td>Merchant</td>
            <td><?php echo number_format($unit['merchant']); ?></td>
            <td>10 food</td>
            <td><input type="text" name="merchant" /></td>
        </tr>
        <tr>
            <td>Farmer</td>
            <td><?php echo number_format($unit['farmer']); ?></td>
            <td>10 food</td>
            <td><input type="text" name="farmer" /></td>
        </tr>
        <tr>
            <td>Warrior</td>
            <td><?php echo number_format($unit['warrior']); ?></td>
            <td>10 food</td>
            <td><input type="text" name="warrior" /></td>
        </tr>
        <tr>
            <td>Defender</td>
            <td><?php echo number_format($unit['defender']); ?></td>
            <td>10 food</td>
            <td><input type="text" name="defender" /></td>
        </tr>
        <tr>
        	<td>Wizard</td>
        	<td><?php echo number_format($unit['wizard']); ?></td>
        	<td>10 food</td>
        	<td><input type="text" name="wizard" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="train" value="Train"/></td>
        </tr>
    </table>
    </form>
    <hr />
        <form action="units.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Unit Type</b></td>
            <td><b>Number of Units</b></td>
            <td><b>Food Gain</b></td>
            <td><b>Untrain More</b></td>
        </tr>
        <tr>
            <td>merchant</td>
            <td><?php echo number_format($unit['merchant']); ?></td>
            <td>8 food</td>
            <td><input type="text" name="merchant" /></td>
        </tr>
        <tr>
            <td>Farmer</td>
            <td><?php echo number_format($unit['farmer']); ?></td>
            <td>8 food</td>
            <td><input type="text" name="farmer" /></td>
        </tr>
        <tr>
            <td>Warrior</td>
            <td><?php echo number_format($unit['warrior']); ?></td>
            <td>8 food</td>
            <td><input type="text" name="warrior" /></td>
        </tr>
        <tr>
            <td>Defender</td>
            <td><?php echo number_format($unit['defender']); ?></td>
            <td>8 food</td>
            <td><input type="text" name="defender" /></td>
        </tr>
              <tr>
        	<td>Wizard</td>
        	<td><?php echo number_format($unit['wizard']); ?></td>
        	<td>8 food</td>
        	<td><input type="text" name="wizard" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="untrain" value="Untrain"/></td>
        </tr>
    </table>
    </form>
    <?php
}
include("footer.php");
?>
