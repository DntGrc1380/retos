<?php
    $data = file('entrada.txt', FILE_IGNORE_NEW_LINES);
    $count = 0;
    $arrayMaxWinner = array(0,0);
    $arrayRoundWinner = array(0,0);
    //$playerRoundWinner = 0;
    foreach($data as $d){
        $count ++;
        $dif = 0;
        if($count > 1){
            //$arrayRound['player1'] = $d[0];
            //$arrayRound['player2'] = $d[1];
            $r = explode(" ",$d);
            if($r[0] > $r[1]){
                $dif = $r[0] - $r[1];
                $arrayRoundWinner[0] = 1;
                $arrayRoundWinner[1] = $dif;
            }else{
                $dif = $r[1] - $r[0];
                $arrayRoundWinner[0] = 2;
                $arrayRoundWinner[1] = $dif;
            }
            echo 'El ganador de la ronda '. $count . ' es: J' . $arrayRoundWinner[0] . ' con: ' . $dif . ' puntos </br>';
            if ($arrayRoundWinner[1] > $arrayMaxWinner[1]){
                $arrayMaxWinner[0] = $arrayRoundWinner[0];
                $arrayMaxWinner[1] = $dif;
            }
            echo 'El ganador maximo es: J' . $arrayMaxWinner[0] . ' con: ' . $arrayMaxWinner[1] . ' puntos' . "</br></br>";
        }
    }
    generaArchivo('salida.txt',$arrayMaxWinner);

    function generaArchivo($nombreArchivo,$winner){
        $archivo = fopen($nombreArchivo,'w');
        fwrite($archivo,$winner[0] . "\n" . $winner[1]);
        fclose($archivo);
        echo "<b>Archivo generado con exito<b>";
    }
?>