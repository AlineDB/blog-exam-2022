<?php
use Carbon\Carbon;

class Rss extends \Blog\Models\Model

// on détermine le type de document, ici du xml
header ( "Content-type: rss/xml" ) ;

/*
 Inclure ici votre script de connexion base de données
*/

$date = date ( "Y:m:d" ) ;

// On récupère la liste des news publiés et dont la date de publication est valable

$requete_news = (new PDO)->query( "
    SELECT
        *
    FROM
        news    
    WHERE
        actif=1
        and date_debut <= '$date'
    ORDER BY
        date DESC
    ") or die ( (new PDO)->errorInfo() ) ;




$rss = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>" ;
$rss .= "<rss version=\"2.0\">" ;
$rss .= "<channel>" ;
$rss .= "<title>My awesome blog</title>" ;
$rss .= "<link>http://blog.test/</link>" ;
$rss .= "<description>The Awesome blog of Dominique Vilain</description>" ;

while ( $tab_news = (new PDOStatement)->fetch ((int)$requete_news) ) {
    
    // Récupère la date de publication de la news
    $date_news= date ( "D, d M Y H:i:s" , strtotime( $tab_news[$date] ) );
    
    // On crée l'item avec ces données
   $rss .= "<item>" ;
    $rss .= "<title><![CDATA[".$tab_news['titre']."]]></title>"; 
    $rss .= "<link>http://blog.test/?action=show&amp;resource=post&amp;slug=".$tab_news['id']."</link>" ;
    $rss .= "<description><![CDATA[".$tab_news['texte']."]]></description>" ;
    $rss .= "<pubDate>".$date_news." GMT</pubDate>" ;
    $rss .= "</item>" ;
}

$rss .= "</channel>" ;
$rss .= "</rss>" ;

// On affiche le contenu XML
echo $rss;

?>