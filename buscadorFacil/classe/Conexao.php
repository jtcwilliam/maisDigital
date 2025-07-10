<?php

class Conexao
{
    private $success;

    public function Conectar()
    {
        try {

         

//desenvolvimento local
  /* 

                $user = 'root';
                $password = '';
                $db = 'gramulhabanc';
                $host = '127.0.0.1';

     */  
   
  
            //Produção

            $user = 'gramulhabanc';
            $password = 'M@r1@He1en@';
            $db = 'gramulhabanc';
            $host = 'gramulhabanc.mysql.dbaas.com.br';




            //desenvolvimento online







            ini_set('default_socket_timeout', 300);

            $con = mysqli_connect($host, $user, $password, $db);

            if (!mysqli_ping($con)) {

                $con = mysqli_connect($host, $user, $password, $db, true);
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
