<?php
session_start();
$i = 2;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пресс-секретарь</title>
    <link rel="stylesheet" href="assets/style.css?=5">
</head>
<body>
    <form action="vendor/handlerCSV.php" method="post" enctype="multipart/form-data">
        <input name="csvn" type="file" id="csv" accept=".csv">
        <button type="submit">Обработать файл</button>
    </form>
 
    <?php
    if(!empty($_SESSION['request'])){
        $decodedRequestJSON = json_decode($_SESSION["request"]);

        echo '<form id="Form" action="vendor/requestSender.php" method="post">
            <textarea name="contentOfRequest" id="requestText">';

            print_r($decodedRequestJSON->{'messages'}->{'requirements'} . "\n");
            print_r($decodedRequestJSON->{'messages'}->{'etc'});

            while(isset($decodedRequestJSON->{'messages'}->{'completedTasks'}[$i])){
                echo "|| ";
                foreach($decodedRequestJSON->{'messages'}->{'completedTasks'}[$i] as $req){
                    echo $req . " || ";
                };
                echo "\n\n";
                $i++;
            };

        echo '</textarea> 
            <button type="submit">Отправить в нейросеть</button>
        </form>';
    }
    ?>  

    <?php
    if(!empty($_SESSION['answer'])){
        echo '<form id="Form" action="vendor/requestSaver.php" method="post">
            <textarea name="answer" id="requestText">';

            print_r($_SESSION['answer']);

        echo '</textarea> 
            <button type="submit">Сохранить</button>
        </form>';
    }
    ?> 
</body>
</html>