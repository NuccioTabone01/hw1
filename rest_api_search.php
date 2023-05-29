
<?php
   // URL di destinazione
   $url = "https://api.scripture.api.bible/v1/bibles/41f25b97f468e10b-01/search?query=".$_GET['object'].".&sort=relevance&fuzziness=AUTO";
   
   $headers = array(
    "accept: application/json",
    "api-key: 76ba17ccdb439da7f6d049db05e9bf18"
   );
   
   $curl = curl_init($url);
   
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
   
   $response = curl_exec($curl);
   
   if ($response === false) {
       $error = curl_error($curl);
       echo "Errore nella richiesta: " . $error;
   }
   
   curl_close($curl);
   
   echo $response;
?>
   

