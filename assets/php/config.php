<?php
try {
    $cnt = new PDO("mysql:HOST=localhost; dbname=dbf8htlgpqpay2; charset=utf8", "ukvos3nvslhza", "1s1Lhbc4e4@J");
    $cnt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "EL Error de Conexión es el siguiente:<br>" . $e->getMessage();
}