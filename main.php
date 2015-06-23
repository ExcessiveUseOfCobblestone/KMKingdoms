<?php
session_start();
include("header.php");

if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    ?>
    <center><h2>House <?php echo $user['house']; ?></h2></center>
    <br />
	<center>
    <table cellpadding="3" cellspacing="5">
        <tr>
            <td>Current Lord:</td>
            <td><i><?php echo $user['currentlord']; ?> <?php echo $user['house']; ?></i></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Health:</td>
            <td><i><?php echo $stats['health']; ?></i></td>
        </tr>
        <tr>
        <tr>
            <td>Attack:</td>
            <td><i><?php echo $stats['attack']; ?></i></td>
        </tr>
        <tr>
            <td>Defense:</td>
            <td><i><?php echo $stats['defense']; ?></i></td>
        </tr>
        <tr>
            <td>Mana:</td>
            <td><i><?php echo $stats['defense']; ?></i></td>
        </tr>
        <tr>
            <td>Gold:</td>
            <td><i><?php echo $stats['gold']; ?></i></td>
        </tr>
        <tr>
            <td>Income:</td>
            <td><i><?php echo $stats['income']; ?></i></td>
        </tr>
        <tr>
            <td>Food:</td>
            <td><i><?php echo $stats['food']; ?></i></td>
        </tr>
        <tr>
            <td>Farming:</td>
            <td><i><?php echo $stats['farming']; ?></i></td>
        </tr>
         <tr>
            <td>Mana Power:</td>
            <td><i><?php echo $stats['manapow']; ?></i></td>
        </tr>
        <tr>
            <td>Turns:</td>
            <td><i><?php echo $stats['turns']; ?></i></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Workers:</td>
            <td><i><?php echo $unit['worker']; ?></i></td>
        </tr>
        <tr>
            <td>Farmers:</td>
            <td><i><?php echo $unit['farmer']; ?></i></td>
        </tr>
        <tr>
            <td>Warriors:</td>
            <td><i><?php echo $unit['warrior']; ?></i></td>
        </tr>
        <tr>
            <td>Defenders:</td>
            <td><i><?php echo $unit['defender']; ?></i></td>
        </tr>
        <tr>
            <td>Wizards:</td>
            <td><i><?php echo $unit['wizard']; ?></i></td>
        </tr>
          <tr>
            <td>Towers:</td>
            <td><i><?php echo $building['tower']; ?></i></td>
        </tr>
        <tr>
            <td>Seige Equipment:</td>
            <td><i><?php echo $building['seige']; ?></i></td>
        </tr>
        <tr>
            <td>Wizard Guilds:</td>
            <td><i><?php echo $building['wizguild']; ?></i></td>
        </tr>
        <tr>
            <td>Granaries:</td>
            <td><i><?php echo $building['granary']; ?></i></td>
        </tr>
        <tr>
            <td>Tax Houses:</td>
            <td><i><?php echo $building['taxhouse']; ?></i></td>
        </tr>
    </table>
    <?php
}
include("footer.php");
?>
