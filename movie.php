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

    echo("<p>".$movie['plot']."</p>");

    echo("<table><tr><th>Theatre</th><th>Showtimes</th></tr>");
    foreach ($movie['theaters'] as $theater) {
        $times = implode(' ', $theater['times']);
        echo("<tr><td>" . $theater['name'] . "</td>");
        echo("<td>Today: $times</td>");
        echo("</tr>");
    }
    echo("</table>");

    if (array_key_exists('user', $_GET)) {
        $user = intval($_GET['user']);
        $movieid = mysql_real_escape_string($movie_url);
        echo("<h3>My friends interested in this movie:</h3>");

        $rs = mysql_query("SELECT pp_id FROM plancDB.movie_list " . 
            "WHERE pp_id != $user " .
            "AND ml_movie = '$movieid' ");

        if (!$rs) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }

        while ($row = mysql_fetch_assoc($rs)) {
            $friend_id = $row['pp_id'];

            $friend_rs = mysql_query("SELECT pp_name, pp_img FROM plancDB.people " .
                "WHERE pp_id = $friend_id");

            if (!$friend_rs) {
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }

            $friend = mysql_fetch_assoc($friend_rs);
            echo(" <img width=48 height=48 src=images/" . $friend['pp_img'] . ">");
            echo($friend['pp_name']);
        }
    }
?>
