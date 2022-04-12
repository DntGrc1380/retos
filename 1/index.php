<?php

    $data = file('entrada.txt', FILE_IGNORE_NEW_LINES);
    if(count($data) < 4){
        echo 'El archivo no tiene las líneas necesarias';
    }else{
        var_dump($data);
        $count = 0;
        $inst1 = "";
        $inst2 = "";
        $lin1 = "NO";
        $lin2 = "NO";
        foreach($data as $d){
            $count++;
            switch($count){
                case 1:
                    echo '</br>';
                    break;
                case 2:
                    $inst1 = $d;
                    echo 'Inst1: ' . $inst1 .'</br>';
                    break;
                case 3:
                    $inst2 = $d;
                    echo 'Inst2: ' . $inst2 .'</br>';
                    break;
                case 4:
                    $lData = eliminarDuplicadosConsecutivos($d);
                    if (strpos($lData,$inst1)) {
                        $lin1="SI";
                    }elseif(strpos($lData,$inst2)){
                        $lin2 = "SI";
                    }
                    echo $lData . '</br>';
                    echo 'Salida: linea1: ' . $lin1 .'</br>';
                    echo 'Salida: linea2: ' . $lin2 .'</br>';
                    generaArchivo('salida.txt',$lin1,$lin2);
                    break;
            }
        }
    }

    /**

 * Funcion para eliminar los valores duplicados consecutivos en cada palabra

 * de una frase

 *

 * @param string $str

 *

 * @return string

 */

function eliminarDuplicadosConsecutivos($str) {

    return implode(

        " ", array_map(

            function ($palabra) {

                preg_match_all('/./u', $palabra, $matches);

                return array_reduce(

                    $matches[0],

                    function ($acum, $letra) {

                        return $acum==null || ($acum[-1]!=$letra && substr($acum, -2)!=$letra) ? $acum.$letra : $acum;

                    }

                );

            }, explode(" ", preg_replace('/\s+/', ' ', $str))

        )

    );

}
function generaArchivo($nombreArchivo,$lin1,$lin2){
    $archivo = fopen($nombreArchivo,'w');
    fwrite($archivo,$lin1 . "\n" . $lin2);
    fclose($archivo);
}
?>