<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 2019-03-09
 * Time: 18:48
 */
/*
 *
 * Cette page correspond au code brut pour parser le json de l'API de Github
 *
 * Elle teste uniquement le dernier gist existant
 *
 * array_keys() : permet d'obtenir la première valeur dans le tableau "files"
 * substr() : permet de retirer les 3 derniers éléments du nom (le .md)
 * preg_replace() : permet d'indiquer les caractères acceptés (pour retirer les tirets qui séparent chaque mot (_)
 * implode() : permet de convertir un array en chaine de caractères
 */


//header('Content-Type: application/json');
$curl = curl_init('https://api.github.com/users/aliastim/gists');
//curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt');
//curl_setopt($curl, CURLOPT_USERAGENT,  'aliastim');
curl_setopt_array($curl, [
    CURLOPT_USERAGENT => 'aliastim',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 1
]);
$data = curl_exec($curl);
if ($data === false) {
    var_dump(curl_error($curl));
} else {
        $data = json_decode($data, true);
        echo '<pre>';
        //var_dump($data);
        var_dump(array_keys($data[0]['files'])[0]);
        /*$test =  $data[0]['files'];
        $test2 = array_keys($test);
        $test2 = $test2[0];
        var_dump($test2);*/
        //var_dump($data['0']['files']);
        var_dump($data['0']['html_url']);
        var_dump($data['0']['created_at']);
        var_dump($data['0']['updated_at']);

        $gist_title = (array_keys($data[1]['files'])[0]);
        $gist_title = substr($gist_title, 0, -3);
        $gist_title = preg_replace("#[^a-zA-Zéèàê!']#", " ", $gist_title);
        echo $gist_title;


        echo '</pre>';
}
curl_close($curl);