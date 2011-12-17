<?php
    function express_interest($userid, $movie_url, $interested)
    {
        if (isset($userid)) {
            $rs = mysql_query("SELECT ml_id FROM plancDB.movie_list WHERE " .
                "pp_id = " . intval($userid) . " " .
                "AND ml_movie = '" . mysql_real_escape_string($movie_url) . "'");

            if (!$rs) {
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }

            $row = mysql_fetch_assoc($rs);
            if ($row && !$interested) {
                $rs = mysql_query("DELETE FROM plancDB.movie_list WHERE " .
                    "ml_id = " . $row['ml_id']);
                if (!$rs) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    die($message);
                }
            }
            if (!$row && $interested) {
                $movie_escaped = mysql_real_escape_string($movie_url);
                $rs = mysql_query("INSERT INTO plancDB.movie_list VALUES (0, $userid, '$movie_escaped')");
                if (!$rs) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    die($message);
                }
            }
        }
    }

    $movie_url = $_GET['movie'];

    if (array_key_exists('interest', $_GET))
        express_interest($_SESSION['user'], $movie_url, $_GET['interest']);

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

    if (array_key_exists('user', $_SESSION)) {
        $user = intval($_SESSION['user']);
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

        $num_friends = 0;
        while ($row = mysql_fetch_assoc($rs)) {
            $num_friends++;
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

        if ($num_friends == 0) {
            echo("No friends interested in this movie<br>");
        }

        $rs = mysql_query("SELECT COUNT(pp_id) FROM plancDB.movie_list " .
            "WHERE pp_id = $user " .
            "AND ml_movie = '$movieid' ");

        if (!$rs) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }

        $row = mysql_fetch_array($rs);
        $i_am_interested = $row[0] > 0;
        if ($i_am_interested) {
            echo("<br><br><a href='index.php?current=movie&movie=$movie_url&interest=0'>I don't want to go any more</a>");
        } else {
            echo("<br><br><a href='index.php?current=movie&movie=$movie_url&interest=1'>Sounds fun!</a>");
        }
    }
?>
