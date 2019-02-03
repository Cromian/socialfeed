<?php

class SocialFeed
{
    var $src;
    
    function getData($src) 
    {    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $src);
        curl_setopt($curl, CURLOPT_REFERER, $src);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);

        // Decode JSON data into PHP array.
        $links = json_decode($str, true);

        // Return PHP array.
        return $links;
    }

    function __construct($src)
    {  
        $data = $this::getData($src);
        include ('templates/head.tpl.php');
    
        foreach ($data as $link) {

            $url = $link['field_social_link'];

            // If url has twitter.
            if (strpos($url, 'twitter.com') !== false) 
            {
                include ('templates/twitter.tpl.php');
            }

            // If url has instagram.
            if (strpos($url, 'instagram.com') !== false) 
            {
                include ('templates/instagram.tpl.php');
            }
        }
    }
}

?>