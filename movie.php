<?php
    $movie_url = $_GET['movie'];

    $handle = fopen($movie_url . ".json", "r");
    $movie_json = stream_get_contents($handle);
    fclose($handle);

    $movie = json_decode($movie_json, TRUE);
    echo("<h3>Details for " . $movie['title'] . "</h3>");

    if (array_key_exists('posters', $movie)) {
        foreach ($movie['posters'] as $poster) {
            if ($poster['size'] == 'large')
                echo("<img src=" . $poster['href'] . ">");
        }
    }

    echo("<table><tr><th>Theatre</th><th>Showtimes</th></tr>");
    foreach ($movie['theaters'] as $theater) {
        $times = implode(' ', $theater['times']);
        echo("<tr><td>" . $theater['name'] . "</td>");
        echo("<td>Today: $times</td>");
        echo("</tr>");
    }
    echo("</table>");
?>
