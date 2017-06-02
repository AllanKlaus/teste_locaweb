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
        <form action="./most_relevants/most_relevants.php" method="POST">
        <?php
            session_start(); 
            require_once 'Tweet.php';
            
            $listaTweet = Array();
            $i = 0;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://tweeps.locaweb.com.br/tweeps');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $headers = [
                'Username: lcpapa@outlook.com'
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $data = curl_exec($ch);
            curl_close($ch);

            $userData = json_decode($data); 
            //var_dump($userData);
            
            $position_json = 0;
            
            '<ul>';
            foreach($userData->statuses as $t) {               
                $usuario = $t->{"user"};
                
                $mencao = $t->{"entities"};
                $user_mentions = $mencao->user_mentions;
                //var_dump($user_mentions);
                
                $followers_count = $usuario->followers_count;
                $retweet_count = $t->{"retweet_count"};
                $favourites_count = $usuario->favourites_count;
                $screen_name = $usuario->screen_name;
                $created_at = $t->{"created_at"};
                $text = $t->{"text"};
                $id_str_tweet = $t->{"id_str"};
                $id_str_user = $usuario->id_str;
                
                if (count($user_mentions))
                    $id_str_user_mentions = $user_mentions[0]->{"id_str"};
                else 
                    $id_str_user_mentions = null;
                
                $id_in_reply_to_user_id_str = $t->{"in_reply_to_user_id_str"};
                
                $followers_count = $usuario->followers_count;
                
                if (($id_str_user_mentions == 42 && $id_in_reply_to_user_id_str != 42) || ($id_str_user_mentions != 42 && $id_in_reply_to_user_id_str != 42)){
                    $tweet = new Tweet($position_json, $followers_count, $retweet_count, $favourites_count, $screen_name, $created_at, $text, $id_str_tweet, $id_str_user, $id_str_user_mentions, $id_in_reply_to_user_id_str);
                
                    $listaTweet[$i] = $tweet;
                    $i = $i + 1;
                }                
                $position_json = $position_json + 1;
            }
            echo '</ul>';
            
            for ($y=0; $y<$i; $y = $y+1){
                $listaTweet[$y]->avaliarTweet();                
            }
                        
            usort(
                $listaTweet,
                function($a,$b) {
                    if($a->getAvaliacao() == $b->getAvaliacao()) return 0;
                    return (($a->getAvaliacao() > $b->getAvaliacao()) ? -1 : 1 );
                }
            );
            $ser = serialize($listaTweet);
            
            $_SESSION['tweets'] = serialize($listaTweet);
            //echo $ser;
            
            echo '<button type="submit" name="mostRelevants" value="">Ver os tweets mais relevantes</button>';
            /*echo '<ul>';
            for ($y=0; $y<$i; $y = $y+1){
                echo '<li>';
                echo 'Posição json'; echo $listaTweet[$y]->getPositionJson();
                echo '</li>';
                
                echo '<li>';
                echo 'Avaliação'; echo $listaTweet[$y]->getAvaliacao();
                echo '</li>';
            }
            echo '</ul>';*/
            
            
            /*require_once 'vendor/autoload.php';
            
            use GuzzleHttp\Client;

            $httpClient = new Client(); 
            
            $response = $httpClient->request('POST', 'http://tweeps.locaweb.com.br/tweeps', [
                "headers" => [
                    "Username" => "lcpapa@outlook.com",
                ],
            ]);
            
            $userData = json_decode($response->getBody()->getContents());
            var_dump($userData);
            $i = 0;
            '<ul>';
            foreach($userData->statuses as $tweet) {
                $tweet_text = $tweet->{"text"};
                echo '<li>';
                echo $tweet_text;
                echo '</li>';
                $i = $i +1;;
            }
            echo '</ul>';
            */
        ?>
        </form>
    </body>
</html>
