<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura e escapa o valor para evitar XSS
    $imagem_html = htmlspecialchars($_POST['imagem_html']);

    // Exibe de forma segura
    echo "Imagem HTML recebida: " . $imagem_html;
}
?>
