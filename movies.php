<?php
    echo("<h3>Movies</h3>");

    $handle = fopen("http://api.cineti.ca/movies.json", "r");
    $movies_json = stream_get_contents($handle);
    fclose($handle);

    $movies = json_decode($movies_json, TRUE);
    foreach ($movies as $movie) {
        if (array_key_exists('thumbnail', $movie)) {
            echo("<img src=" . $movie['thumbnail'] . ">");
        }
    }
?>
