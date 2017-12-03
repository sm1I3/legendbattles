<? require('kernel/before.php'); 

if (isset($_POST['text'])) {
    
    $letters = array();
    for ($i=0; $i<strlen($_POST['text']); $i++)
        if (!isset($letters[ substr($_POST['text'], $i, 1) ]))
            $letters[ substr($_POST['text'], $i, 1) ] = 1;
        else
            $letters[ substr($_POST['text'], $i, 1) ]++;
            
    foreach($letters as $l => $count)
        if ($count == $_POST['number'])
            echo '<br /><br />'.$l.'<br /><br />';
    
}

?>
<h3>Admin home page</h3>
<form name="test" action="" method="post">
<textarea name="text" cols="50" rows="5"></textarea>
<input type="text" name="number" />
<input type="submit" name="submit" />
</form>
<? require('kernel/after.php'); ?>