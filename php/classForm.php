<label>Your Name is:</label><span><?php echo $_POST["name"];?></span><br/>
<label>Email:</label><?php echo "<a mailto=" . $_POST["email"] . ">" . $_POST["email"] . "</a>";?><br/>
<label>Major:</label><?php echo $_POST["major"];?><br/>
<label>Places You've Been:</label><br/>
<?php
    for ($i=0; $i < count($_POST['places']); $i++){
      echo $_POST['places'][$i] . "<br/>";
    }
?>
