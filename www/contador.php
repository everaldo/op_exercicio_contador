<?php
/* Everaldo Gomes - 22/05/2015 - Oficina de Programação
 * everaldo.gomes@pucpr.br
 *
 * Contador de Visitas usando MySQL
 *
 *
 * Pré-requisitos: (execute os seguintes comandos)
 *
 *
 * Crie um banco de dados:
 *
 * create database contador;
 *
 *
 * Uma tabela para armazenar as visitas:
 *
 * use contador;
 * create table visitas(
 *  total int not null default 0 primary key
 * );
 *
 * Inicialize o valor de total (único registro da tabela)
 *
 * insert into `visitas`(total) values(0); 
 *
 */


define('__ROOT_PATH__', dirname(dirname(__FILE__)));
require_once(__ROOT_PATH__ . '/config.php');

/*
 * As constantes DB_HOST, DB_USER e DB_PASSWORD devem estar
 * definidas no arquivo config.php, localizado na raiz do projeto
 * As constantes DB_HOST, DB_USER e DB_PASSWORD devem estar
 * definidas no arquivo config.php, localizado na raiz do projeto
 */
function get_conexao(){
  //conecta ao banco de dados
  $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
  if (!$link) {
    die('Não foi possível conectar: ' . mysql_error());
  }
  return $link;
}


/*
 *
 * Função que executa uma query e retorna o resultado
 * Depende da constante:
 *
 * DB_DATABASE
 *
 */
function executa_query($query){
  mysql_select_db(DB_DATABASE);
  $resultado = mysql_query($query);
  if (!$resultado) {
    $mensagem  = 'Consulta inválida: ' . mysql_error() . "\n";
    $mensagem .= 'Consulta feita: ' . $query;
    die($mensagem);
  }
  return $resultado;
}

/*
 * Verifica se uma query select retornou resultados
 *
 *
 */
function  verifica_resultado_query_select($resultado){
  if (mysql_num_rows($resultado) == 0) {
    die("ERRO: Nenhum resultado encontrado");
  }
  return true;
}

/*
 *
 * Analista os resultados da consulta de contagem de visitas
 *
 */
function parse_resultado($resultado){
  $linha = mysql_fetch_array($resultado);
  return $linha["total"];
}


/*
 *
 * Retorna consulta que atualiza o número de visitantes
 *
 * Depende das constante:
 *
 * DB_TABLE
 */
function get_query_atualiza_visitantes(){
  $table = DB_TABLE; //necessário para interpolação
  return <<<EOT
    UPDATE `$table` SET total = total + 1
EOT;
}

/*
 *
 * Retorna consulta que mostra o número total de visitantes
 *
 * Depende da constante:
 *
 * DB_TABLE
 *
*/
function get_query_num_visitantes(){
  $table = DB_TABLE; //necessário para interpolação
  return <<<EOT
    SELECT total from `$table` ORDER BY total ASC LIMIT 1
EOT;
}

/*
 * Atualiza no banco de dados o número de visitantes
 *
 */
function atualiza_visitantes(){
  $query_atualizacao = get_query_atualiza_visitantes();
  executa_query($query_atualizacao);
}


/*
 * registra uma visita: aumenta o total de visitantes
 *
*
 */
function registra_visita(){
  $link = get_conexao();
  atualiza_visitantes();
}

/*
 * retorna o número de visitantes
 */
function get_num_visitantes(){
  $query_num_visitantes = get_query_num_visitantes();
  $resultado = executa_query($query_num_visitantes);
  verifica_resultado_query_select($resultado);
  return parse_resultado($resultado);
}

/*
 * imprime o número de visitantes
 *
 */
function imprime_contador(){
  return '<h1>' . get_num_visitantes() . '</h1>';
}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8 />
  <title>Contador de Visitas</title>

</head>
<body>
<?php
  registra_visita();
  echo imprime_contador(); ?>  
</body>
</html>
