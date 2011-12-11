<?php
if (isset($_POST['mon_champ'])) {
    echo "Vous avez choisi :";
    for ($i = 0, $c = count($_POST['mon_champ']); $i < $c; $i++) {
        echo "<br/><b>" . $_POST['mon_champ'][$i] . "</b>";
    }
}
?>
 
<form method="POST">
 <textarea name="test"></textarea>
    <input type="checkbox" name="mon_champ[]" value="<?php echo $test; ?>"/>Option 1<br>
	
    <input type="checkbox" name="mon_champ[]" value="Option 2"/>Option 2<br>
    <input type="checkbox" name="mon_champ[]" value="Option 3"/>Option 3<br>
    <input type="submit" value="OK">
</form>