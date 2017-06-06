# teste_locaweb


# Informações gerais #
----------------------
* Linguagem: PHP
* Sistema operacional: 64 bits
* Utilizados como apoio ao desenvolvimento:
WampServer (v3.0.6): <http://www.wampserver.com/en/>
BootStrap (v3.3.7): <http://getbootstrap.com/>
* O projeto está disponível no gitHub: <https://github.com/lcpapa/teste_locaweb.git>


# Requisitos Gerais #
----------------------
* Versão mínima PHP: 5.6.25
* Versão mínima Apache: 2.4.23
* Versão mínima MySql: 5.7.14


# Libs #
--------
* PHPUnit (v5.7.20): <https://phpunit.de/>


# Informações Complementares #
----------------------
Optei por utilizar uma linguagem web me baseando nos requisitos vaga (que é para desenvolvimento web). Dentre as linguagens atuais, tenho mais familiaridade com PHP, por isso acabei decidindo por ela. Com base nisso, escolhi utilizar o PHPUnit como ferramenta de teste, uma vez que esta é bastante conhecida, documentada e utilizada.

Sobre a estratégia de desenvolvimento, optei pela ponderação por meio de pesos, de acordo com a relevância destas:
1) Usuários com mais seguidores -> Peso 0.6
2) Tweets que tenham mais retweets (considerar apenas o RT oficial do Twitter) -> Peso 0.3
3) Tweet com mais likes -> Peso 0.1

De acordo com estas, um tweet tem seu "índice" calculado e é inserido em uma lista, que é posteriormente ordenada de acordo com a devida relevância. De acordo com o exemplo abaixo, a classificação seria o tweet ID 22 seguido do de ID 32.

Um exemplo:
-> Tweet ID 32
* 20 seguidores 
* 10 retweets   
* 2 likes       
Índice final: 15,2


-> Tweet ID 22
* 30 seguidores 
* 20 retweets   
* 5 likes       
Índice final: 24,5