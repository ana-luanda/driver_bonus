<?php
// dependencias de firebase
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Configuração do Firebase
$serviceAccount = ServiceAccount::fromJsonFile('path/to/firebase_credentials.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://your-database.firebaseio.com')
    ->create();

$database = $firebase->getDatabase();


// Captura de dados do formulário
// calculo com base na distancia 
$driver_id = $_POST['driver_id'];

// Função para calcular o bônus do motorista
function calcularBonus($driverId) {
    global $pdo;

    // Definir critérios do bônus
    $bonusRate = 0.05; // 5% do valor total das corridas
    $minRides = 10;    // Mínimo de 10 corridas para receber bônus
    

    // Dados a serem armazenados
$data = [
    'driver_id' => $driver_id,
    'total_rides' => $trips,
    'rating' => $rating,
    'bonus' => $bonus
];

    $stmt->execute(['driver_id' => $driverId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalRides = $result['total_rides'];
    $totalAmount = $result['total_amount'];

    // Verificar se os critérios de bônus são atendidos
    if ($totalRides >= $minRides) {
        $bonus = $totalAmount * $bonusRate;
    } else {
        $bonus = 0;
    }

    return $bonus;
}


// Armazenar dados no Firebase
$database->getReference('drivers/' . $driver_id)->set($data);

// mostrar resultado
echo "O bônus do motorista é: MZN " . number_format($bonus, 2);
?>