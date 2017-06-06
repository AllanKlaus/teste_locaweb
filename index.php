<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/cover.css" rel="stylesheet" type="text/css" media="screen">
        <title>Página Inicial</title>
    </head>
    <body>
        
        <?php 
            session_start(); 
            require_once 'Tweet.php';
            
            $listaTweet = Array(); //Um array que guardará a lista de tweets recuperados do JSON
            $idUsuario = Array(); //Um array auxiliar que gravará os ids dos usuários

            
            //Estabelecendo conexão com webservice e recuperando o JSON
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://tweeps.locaweb.com.br/tweeps');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $headers = [
                'Username: lcpapa@outlook.com'
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $data = curl_exec($ch);
            curl_close($ch);

            // Decodificando o JSON e jogando dentro de uma variável
            $userData = json_decode($data); 

            foreach($userData->statuses as $t) {               
                //Pegando os dados considerados úteis para a resolução do problema
                $usuario = $t->{"user"};
                
                $mencao = $t->{"entities"};
                $user_mentions = $mencao->user_mentions;
                
                $followers_count = $usuario->followers_count;
                $retweet_count = $t->{"retweet_count"};
                $favourites_count = $usuario->favourites_count;
                $screen_name = $usuario->screen_name;
                $created_at = $t->{"created_at"};
                $text = $t->{"text"};
                $id_str_tweet = $t->{"id_str"};
                $id_str_user = $usuario->id_str;
                
                // Se tiver mencionado algum usuário, guarda-se essa informação. Caso contrário, seta-se como null a variável.
                if (count($user_mentions)) 
                    $id_str_user_mentions = $user_mentions[0]->{"id_str"};
                else 
                    $id_str_user_mentions = null;
                
                // Caso o tweet seja um reply
                $id_in_reply_to_user_id_str = $t->{"in_reply_to_user_id_str"};
                
                //Número de seguidores do usuário
                $followers_count = $usuario->followers_count;
                
                // Considera-se as seguintes regras:
                //(1) tweets que mencionem o usuário da Locaweb
                //(2) tweets não são replies para tweets da Locaweb
                
                if (($id_str_user_mentions == 42 && $id_in_reply_to_user_id_str != 42) || ($id_str_user_mentions != 42 && $id_in_reply_to_user_id_str != 42)){
                    // Guardando dentro de um objeto as informações coletadas
                    $tweet = new Tweet($followers_count, $retweet_count, $favourites_count, $screen_name, $created_at, $text, $id_str_tweet, $id_str_user, $id_str_user_mentions, $id_in_reply_to_user_id_str);
                    
                    // Os tweets são avaliados de acordo com uma ponderação explicada dentro do método
                    $tweet->avaliarTweet();
                    
                    // Inserindo o abjeto dentro da lista de tweets
                    array_push($listaTweet, $tweet);
                    
                    // Caso o usuário ainda não exista na lista de usuários, ele é inserido.
                    if (!in_array($tweet->getId_str_user(), $idUsuario)){
                        array_push($idUsuario, $tweet->getId_str_user());
                    }
                }                
            }
            $tweet2 = new Tweet(11, 5, 4, "Larissa_Camila", "Mon Sep 24 03:35:21 +0000 2012", "Teste 1", 2, 1, 42, 42);
            array_push($listaTweet, $tweet2);
            if (!in_array($tweet2->getId_str_user(), $idUsuario)){
                        array_push($idUsuario, $tweet2->getId_str_user());
                    }
            $tweet3 = new Tweet(11, 4, 3, "Larissa_Camila", "Mon Sep 24 03:35:21 +0000 2012", "Teste 2", 3, 1, 42, 42);
            array_push($listaTweet, $tweet3);
            if (!in_array($tweet3->getId_str_user(), $idUsuario)){
                        array_push($idUsuario, $tweet3->getId_str_user());
                    }
            
            $tweet4 = new Tweet(11, 5, 10, "Willian", "Mon Sep 24 03:35:21 +0000 2012", "Teste 1", 2, 3, 42, 42);
            array_push($listaTweet, $tweet4);
            if (!in_array($tweet2->getId_str_user(), $idUsuario)){
                        array_push($idUsuario, $tweet4->getId_str_user());
                    }
            $tweet5 = new Tweet(11, 4, 3, "Willian", "Mon Sep 24 03:35:21 +0000 2012", "Teste 2", 3, 3, 42, 42);
            array_push($listaTweet, $tweet5);
            if (!in_array($tweet3->getId_str_user(), $idUsuario)){
                        array_push($idUsuario, $tweet5->getId_str_user());
                    }        
            
            /*for ($y=0; $y<count($listaTweet); $y = $y+1){
                $listaTweet[$y]->avaliarTweet();                
            } */         
            
            $_SESSION['tweets'] = serialize($listaTweet);
            $_SESSION['idUsers'] = serialize($idUsuario);

        ?>
        <div id="texto">
            A Locaweb está planejando uma maneira de prover suporte e iniciar protocolos para quem reclamar de seus produtos via Twitter. A idéia é listar os tweets mais relevantes e os usuários que mais mencionam a Locaweb.
        </div>
        <div id="menu">
            <form action="./most_relevants/most_relevants.php" method="POST">
                <button type="submit" name="mostRelevants" class="btn-default">Ver os tweets mais relevantes</button>
            </form>
            </br>
            <form action="./most_mentions/most_mentions.php" method="POST">                
                <button type="submit" name="mostMentions" class="btn btn-default">Ver usuários que mais mencionaram Locaweb</button>
            </form>
        </div>
    </body>
</html>
