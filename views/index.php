<h1><?php echo $title; ?></h1>
<?php 

//var_dump($data);

$count = 0;
$limit = 4;

foreach ($data as $tweet) {
    
    if ($count == $limit)   break;

    if ($count < $limit) {

        echo "<div class='tweet'>";
        echo $data['text'];
        echo "</div><br/>";
        $count++;
    
    }

}


?>
