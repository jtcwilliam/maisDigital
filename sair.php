<?php

session_start();



if(session_destroy()){?>
        <script>
        window.setTimeout(() => {
            window.location =
                "logar.php";
        }, 200);
    </script>
    <?php
}




?>

