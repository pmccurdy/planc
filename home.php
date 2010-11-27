<?// lancement de la requête. on sélectionne les news que l'on va ordonner suivant l'ordre "inverse" des dates (de la plus récente à la plus vieille : DESC) tout en ne sélectionnant que le nombre voulu de news à afficher (LIMIT)  
    $sql = 'SELECT * FROM people WHERE pp_id="3"';  
   
    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)  
   $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
    
   // on compte le nombre de news stockées dans la base de données  
   $data = mysql_fetch_array($req);

// on libère l'espace mémoire alloué à cette requête  
   mysql_free_result ($req);
?>
<table><tr><td><img src="mpic1.php?img=<? echo $data['pp_img'];?>"></td><td><font size="5">Hello<br><? echo $data['pp_name'];?>!</font></td></table><hr><? // lancement de la requête. on sélectionne les news que l'on va ordonner suivant l'ordre "inverse" des dates (de la plus récente à la plus vieille : DESC) tout en ne sélectionnant que le nombre voulu de news à afficher (LIMIT)  
    $sql = 'SELECT count(*) FROM friend_list WHERE pp_id="'.$data['pp_id'].'"';  
   
    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)  
   $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
    
   // on compte le nombre de news stockées dans la base de données  
   $friend = mysql_fetch_array($req);

// on libère l'espace mémoire alloué à cette requête  
   mysql_free_result ($req);
?> Your <? echo $friend[0];?> friend(s)<hr>

<? // on prépare une requête permettant de calculer le nombre total d'éléments qu'il faudra afficher sur nos différentes pages  
 $sql = 'SELECT count(fl_id) FROM friend_list WHERE pp_id="'.$data['pp_id'].'" GROUP BY fl_friend';  
 
  
 // on exécute cette requête  
 $resultat = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
  
 // on récupère le nombre d'éléments à afficher  
 $nb_total = mysql_fetch_array($resultat);  
  
 // on teste si ce nombre de vaut pas 0  
 if (($nb_total = $nb_total[0]) == 0) {
echo '';
}  
 else {  
    
// sinon, on regarde si la variable $debut (le x de notre LIMIT) n'a pas déjà été déclarée, et dans ce cas, on l'initialise à 0  


// Préparation de la requête avec le LIMIT  
  $sql1 = 'SELECT * FROM friend_list,people WHERE friend_list.pp_id="'.$data['pp_id'].'" AND friend_list.fl_friend=people.pp_id GROUP BY friend_list.fl_friend';  
  
 // on exécute la requête  
 $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());  

echo '<table><tr>';

while ($write = mysql_fetch_array($req1)) {?><td><img src="mpic1.php?img=<? echo $write['pp_img']?>"><br><? echo $write['pp_name'];?></td><?}

echo '</tr></table>';
 // on affiche les résultats 
}

?><hr>
Movie you like<hr>
<? // on prépare une requête permettant de calculer le nombre total d'éléments qu'il faudra afficher sur nos différentes pages  
 $sql = 'SELECT count(ml_id) FROM movie_list WHERE pp_id="'.$data['pp_id'].'"';  
 
  
 // on exécute cette requête  
 $res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
  
 // on récupère le nombre d'éléments à afficher  
 $nb = mysql_fetch_array($res);  
  
 // on teste si ce nombre de vaut pas 0  
 if (($nb = $nb[0]) == 0) {
echo '';
}  
 else {  
    
// sinon, on regarde si la variable $debut (le x de notre LIMIT) n'a pas déjà été déclarée, et dans ce cas, on l'initialise à 0  


// Préparation de la requête avec le LIMIT  
  $sql1 = 'SELECT * FROM movie_list WHERE pp_id="'.$data['pp_id'].'"';  
  
 // on exécute la requête  
 $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());  

echo '<table><tr>';

while ($wr = mysql_fetch_array($req1)) { $movie_url = $wr['ml_movie'];

    $handle = fopen($movie_url . ".json", "r");
    $movie_json = stream_get_contents($handle);
    fclose($handle);

    $movie = json_decode($movie_json, TRUE);
    
    if (array_key_exists('posters', $movie)) {
        foreach ($movie['posters'] as $poster) {
            if ($poster['size'] == 'large')
                echo("<td><img src=" . $poster['href'] . "></td>");
        }
    }
}

echo '</tr></table>';
 // on affiche les résultats 
}

?>