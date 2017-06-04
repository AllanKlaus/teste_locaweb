<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            /*function idUser($lista, $id) {
                return ($lista->getId_str_user() == $id);
            }*/
        
            session_start();
            $caminho = $_SERVER['DOCUMENT_ROOT']."/teste_locaweb/trunk/";
            require_once $caminho."Tweet.php";

            $listaTweet = unserialize($_SESSION['tweets']);
            $idUsers = unserialize($_SESSION['idUsers']);
            
            $mostMentionsLocaweb = array();
            
            for ($i=0; $i<count($idUsers);$i=$i+1){
                $id = $idUsers[$i];
                $ret = array_filter($listaTweet, function ($lista) use ($id){
                                                    return $lista->getId_str_user() == $id;
                                                 }
                        );
                array_push($mostMentionsLocaweb, $ret);
            }
            
            $b = array_map('count', $mostMentionsLocaweb);
            
            arsort($b);
            $v = key($b);

            $tweets = array();
            while ($b[$v] > 1){
                array_push($tweets, $mostMentionsLocaweb[$v]);
                unset($b[$v]);
                unset($mostMentionsLocaweb[$v]);
                $v = key($b);
            }
            
            while (!empty($b)){
                array_push($tweets, $mostMentionsLocaweb[$v]);
                unset($b[$v]);
                unset($mostMentionsLocaweb[$v]);
                $v = key($b);
            }
            var_dump($tweets);          
            
        ?>
    </body>
</html>
