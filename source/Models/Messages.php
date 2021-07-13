<?php

namespace Source\Models;

class Messages{
    public function Mensagens(){
        if( isset($_SESSION['mensagem']) && isset($_SESSION['typeMessage'])){
       
              echo "<script>";
                echo "Message('";
                 echo $_SESSION['mensagem']."',"."'".$_SESSION['typeMessage']."";
                echo "')";
              echo "</script>"; 
            
              unset($_SESSION['mensagem']);
              unset($_SESSION['typeMessage']);    
        }
    }
}




?>