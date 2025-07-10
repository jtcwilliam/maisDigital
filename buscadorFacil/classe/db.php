<?php

class Conexao
{
    private $success;

    public function Conectar()
    {
        try {

         

//desenvolvimento local
  

                

   /* 
                $host = '127.0.0.1';
                $user = 'root';
                $password = 'root';
                $db = 'dbportalfacil';
                $db_port = 8889;

    */
  
            //Produção

            $user = 'manualservico';
            $password = 'Sge@4@5';
            $db = 'manualservico';
            $host = 'manualservico.mysql.dbaas.com.br';
            $db_port = 3306;
  



            //desenvolvimento online







            ini_set('default_socket_timeout', 300);

            $con = mysqli_connect($host, $user, $password, $db, $db_port);

            if (!mysqli_ping($con)) {

                $con = mysqli_connect($host, $user, $password, $db, $db_port, true);
            }

            mysqli_set_charset($con, "utf8");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            return $con;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
