<?php

    $movie_url = "index.php?current=movie";
    
    $handle = fopen("http://api.cineti.ca/movies.json", "r");
    $movies_json = stream_get_contents($handle);
    fclose($handle);

    $movies = json_decode($movies_json, TRUE);
    foreach ($movies as $movie) {
        
    if (array_key_exists('thumbnail', $movie)) {
       $thumbnail = "<img src=" . $movie['thumbnail'] . ">";
       $url = $movie_url . "&movie=".$movie['href'];
            
           
        }
    }


?>
<div id="top">
<div class="left">
Movies I'm Interesting
	<table border="1">
  <tr>
        <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
  </tr>
    <tr>
            <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
  </tr>
</table>


</div>

<div class="right">

Movies my friends are interesting 
	<table border="1">
  <tr>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
  </tr>
  <tr>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
    <td><?php echo "<a href='$url'>$thumbnail</a>"; ?></td>
  </tr>
</table>

</div>

</div>

