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
            require_once $caminho."Usuario.php";

            $listaTweet = unserialize($_SESSION['tweets']);
            //var_dump($listaTweet);
            
            /*usort(
                $listaTweet,
                function($a,$b) {
                    if($a->getFollowersCount() == $b->getFollowersCount()) return 0;
                    return (($a->getFollowersCount() > $b->getFollowersCount()) ? -1 : 1 );
                }
            );*/
            
            //var_dump($listaTweet);
            
            $idUsers = unserialize($_SESSION['idUsers']);
            
            $mostMentionsLocaweb = array();
            
            
            
            $listaUsuarios = array();
            
            for ($i=0; $i<count($idUsers);$i=$i+1){
                $id = $idUsers[$i];
                $ret = array_filter($listaTweet, function ($lista) use ($id){
                                                    return $lista->getId_str_user() == $id;
                                                 }
                        );
                $totalSeguidores = 0;
                $totalRetweets = 0;
                $totalLikes = 0;
                
                for ($j=0; $j < count($ret); $j = $j+1){
                   $totalSeguidores = $ret[$i]->getFollowersCount();
                   $totalRetweets += $ret[$i]->getRetweetCount();
                   $totalLikes += $ret[$i]->getFavoritesCount();
                }
                
                $usuario = new Usuario();
                
                $usuario->setIdUser($id);
                $usuario->setTotalFollowers($totalSeguidores);
                $usuario->setTotalLikes($totalLikes);
                $usuario->setTotalRetweets($totalRetweets);
                $usuario->setIdPosi($i);
                
                $usuario->avaliarTweetUsuario();
                echo $usuario->getAvaliacao();
                echo '<br>';
                array_push($listaUsuarios, $usuario);
                array_push($mostMentionsLocaweb, $ret);
            }
            
            //echo count($mostMentionsLocaweb);
            //var_dump($listaUsuarios);
            //var_dump($mostMentionsLocaweb);
            /*for ($i=0; $i<count($mostMentionsLocaweb);$i=$i+1){
                $flag = 0;
                $avaliacao = 0;
                $vet = $mostMentionsLocaweb[$i];
                for ($j=0; $j < count($vet); $j = $j+1){
                   echo $avaliacao += $vet[$i]->avaliarTweetUsuario($flag);
                   $flag = 1;
                }
            }
            
            var_dump($mostMentionsLocaweb);*/
            
            
            /*$b = array_map('count', $mostMentionsLocaweb);
            
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
            var_dump($tweets);          */
        ?>
    </body>
</html>
