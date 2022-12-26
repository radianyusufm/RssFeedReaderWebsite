<?php
    libxml_use_internal_errors(TRUE);

    $rss = [];
    $err = "";

    if(isset($_POST["submit"])){
        $xml=simplexml_load_file($_POST['url_rss']);

        if($xml === FALSE) {
            $err = "rss not available";
        } else {
            $rss = $xml;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSS feed reader website</title>
</head>
<body>

    <form method="post">
        <label >URL RSS:</label>
        <input type="url" name="url_rss">
        <input type="submit" name="submit" value="add">
    </form>

    <?php

        if(strlen($err) != 0) {
            echo '<h2>'. $err . '</h2>';	
        }

        if(count($rss) != 0) {
            echo '<h2>'. $rss->channel->title . '</h2>';	
            foreach ($rss->channel->item as $item) {

                echo '<p><a href="'. $item->link .'">' . $item->title . "</a></p>";
                echo "<p>" . $item->description . "</p>";
                echo "<hr>";
            
            } 
        }
    ?>
</body>
</html>


