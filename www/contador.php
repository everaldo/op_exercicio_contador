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

/*
 * registra uma visita: aumenta o total de visitantes
 */
function registra_visita(){

}

/*
 * retorna o número de visitantes
 */
function get_num_visitantes(){
  return 42; //stub value
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
