<?php

    // Array con las imágenes de todas las cartas
    $cartas = [
        'oros' => array ('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','10.jpg','11.jpg','12.jpg'),
        'copas' => array ('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','10.jpg','11.jpg','12.jpg'),
        'espadas' => array ('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','10.jpg','11.jpg','12.jpg'),
        'bastos' => array ('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','10.jpg','11.jpg','12.jpg')
        ];

    if (!isset($_SESSION['cartas'])){
        $_SESSION['cartas'] = $cartas;
    }

    //------------------------------ FUNCIONES -------------------------------//

    /**
    * Verifica si eres humano y si lo eres, y cumples los requisitos para pedir más cartas, llama a mostrarCarta($jugador)
    *
    * @param string $jugador tipo de jugador, humano o máquina.
    */
    function pedirCarta($jugador) {
        if ($jugador === 'humano') {
            if($_SESSION['puntosMaquina'] != 0){
                echo '<p>No puedes pedir más cartas, la partida terminó. Vuelve a jugar</p>';
                mostrarBotonOtraPartida();
            }else{
                if (!isset($_SESSION['puntosGeneralesHumano'])) {
                    $_SESSION['puntosGeneralesHumano'] = 0;
                }
                if (!isset($_SESSION['puntosGeneralesMaquina'])) {
                    $_SESSION['puntosGeneralesMaquina'] = 0;
                }
                if (!isset($_SESSION['puntos'])) {
                    $puntos = 0;
                    mostrarBotonPlantarse();
                }else{
                    $puntos = $_SESSION['puntos'];
                    mostrarBotonPlantarse();
                }
                if ($puntos>=7.5){
                    if ($puntos===7.5) {
                        echo '<p>No puedes pedir más cartas, tienes 7.5</p>';
                    }else {
                        echo '<p>No puedes pedir más cartas, te has pasado. Vuelve a jugar</p>';
                        mostrarBotonOtraPartida();
                    }
                }else{
                    mostrarCarta($jugador);
                }
            }
        }else {
            mostrarCarta($jugador);
        }
    }

    /**
    * Función utilizada en pedirCarta($jugador). Muestra una carta aleatoria y la borra del array.
    * Llama a las funciones calcularPuntos($puntos) o calcularPuntosMaquina($puntos), dependiendo si eres humano
    * o máquina y muestra los puntos acumulados.
    *
    * @param string $jugador tipo de jugador, humano o máquina.
    */
    function mostrarCarta($jugador) {
        $numPalo = rand(1, count($_SESSION['cartas']));
        switch ($numPalo) {
            case 1:
                $palo = 'oros';
                break;
            case 2:
                $palo = 'copas';
                break;
            case 3:
                $palo = 'espadas';
                break;
            case 4:
                $palo = 'bastos';
                break;
            default:
                break;
        }

        $numCarta = rand(0, count($_SESSION['cartas'][$palo])-1);
        $carta = $_SESSION['cartas'][$palo][$numCarta];

        switch ($_SESSION['cartas'][$palo][$numCarta]) {
            case '12.jpg':
                $puntos = 0.5;
                break;
            case '11.jpg':
                $puntos = 0.5;
                break;
            case '10.jpg':
                $puntos = 0.5;
                break;
            case '7.jpg':
                $puntos = 7;
                break;
            case '6.jpg':
                $puntos = 6;
                break;
            case '5.jpg':
                $puntos = 5;
                break;
            case '4.jpg':
                $puntos = 4;
                break;
            case '3.jpg':
                $puntos = 3;
                break;
            case '2.jpg':
                $puntos = 2;
                break;
            case '1.jpg':
                $puntos = 1;
                break;
            default:
                break;
        }
        if ($jugador == 'humano') {
            calcularPuntos($puntos);
            echo '<div class="carta_humano"><p><img src="img/'.$palo.'/'.$_SESSION['cartas'][$palo][$numCarta].'"/></p><p>Llevas: '.$_SESSION['puntos'].' puntos.</p></div>';
            unset($_SESSION['cartas'][$palo][$carta]);
        }else {
            calcularPuntosMaquina($puntos);
            echo '<div class="carta_maquina"><img src="img/'.$palo.'/'.$_SESSION['cartas'][$palo][$numCarta].'"/><p>La máquina lleva: '.$_SESSION['puntosMaquina'].' puntos.</p></div>';
            unset($_SESSION['cartas'][$palo][$carta]);
        }
    }

    /**
    * Función utilizada en mostrarCarta($jugador). Calcula los puntos que llevas, los guarda en la variable de sesión $_SESSION['puntos']
    * y si has igualado o superado 7.5 puntos actúa en consecuencia.
    *
    * @param int $puntos puntos de la carta.
    */
    function calcularPuntos($puntos) {
        if (isset($_SESSION['puntos'])){
            $jugador = 'humano';
            $_SESSION['puntos'] += $puntos;
            if ($_SESSION['puntos']===7.5) {
                echo '<p><strong>¡HAS CONSEGUIDO 7 Y MEDIO!</strong></p>'
                    . '<p>Plántate para que juegue la máquina</p>';
            }elseif ($_SESSION['puntos']>7.5) {
                pierde($jugador);
            }
        }else {
            $_SESSION['puntos'] = $puntos;
        }
    }

    /**
    * Función utilizada en mostrarCarta($jugador). Calcula los puntos que lleva la máquina y los guarda en la variable de sesión $_SESSION['puntosMaquina']
    *
    * @param int $puntosMaquina puntos de la carta.
    */
    function calcularPuntosMaquina($puntosMaquina) {
        if (isset($_SESSION['puntosMaquina'])){
            $_SESSION['puntosMaquina'] += $puntosMaquina;
        }else {
            $_SESSION['puntosMaquina'] = $puntosMaquina;
            }
    }

    /**
    * Función que muestra el mensaje al conseguir 7.5 para humano o máquina
    *
    * @param string $jugador tipo de jugador, humano o máquina.
    */
    function campeon($jugador) {
        if ($jugador === 'humano') {
            echo '<p><strong>¡ENHORABUENA HAS CONSEGUIDO 7 Y MEDIO!</strong></p>';
        } else {
            
            $_SESSION['puntosGeneralesMaquina']++;            
            ob_flush();flush();sleep(2.7);eliminarCarta();
            echo '<p><strong>¡LA MÁQUINA HA CONSEGUIDO 7 Y MEDIO! Mala suerte...</strong></p>';
        }
        mostrarBotonOtraPartida();
    }

    /**
    * Función que muestra el mensaje cuando la máquina te supera y pierdes
    *
    */
    function campeonSuperando() {
        ob_flush();flush();sleep(2.7);
        echo '<p><strong>¡LA MÁQUINA TE HA SUPERADO! Pierdes...</strong></p>';
        $_SESSION['puntosGeneralesMaquina']++;
        mostrarBotonOtraPartida();
        ocultarBotonPlantarse();
        eliminarCarta();
    }

    /**
    * Función que muestra, si eres humano el mensaje de derrota cuando te pasas de 7.5 y si eres máquina el mensaje de victoria
    * porque la máquina se ha pasado de 7.5.
    *
    * @param string $jugador tipo de jugador, humano o máquina.
    */
    function pierde($jugador) {
        if ($jugador === 'humano') {
            echo '<p><strong>¡TE HAS PASADO! Más suerte para la próxima...</strong></p>';
            $_SESSION['puntosGeneralesMaquina']++;
            ocultarBotonPlantarse();
            ocultarBotonPedir();
        } else {
            ob_flush();flush();sleep(2.7);
            echo '<p><strong>¡ENHORABUENA LA MÁQUINA SE PASA!</strong></p>';
            $_SESSION['puntosGeneralesHumano']++;
            ocultarBotonPlantarse();
            eliminarCarta();
        }
        mostrarBotonOtraPartida();
    }

    /**
    * Función que comprueba que te puedas plantar y si puedes plantarte te devuelve los puntos acumulados y llama a la
    * función maquina() para que comience a jugar la máquina.
    *
    */
    function plantarse() {
        if($_SESSION['puntosMaquina'] != 0){
            echo '<p>No puedes plantarte, la partida terminó. Vuelve a jugar</p>';
            mostrarBotonOtraPartida();
        }else{
            if (isset($_SESSION['puntos'])){
                if ($_SESSION['puntos']>7.5){
                    echo '<p>Has perdido. Vuelve a jugar.</p>';
                    mostrarBotonOtraPartida();
                }else {
                    echo '<p><strong>Te has plantado con '.$_SESSION['puntos'].' puntos.</strong></p>'
                            . '<p>Turno de la máquina</p>';
                    ocultarBotonPedir();
                    maquina();
                }
            }else {
                echo '<p><strong>Aún no has pedido cartas</strong></p>';
            }
        }
    }

    /**
    * Función que inicia el juego de la máquina, irá mostrando cartas hasta que no supere al jugador, no le iguale a 7,5
    * o no se pase de 7.5.
    *
    */
    function maquina() {
        $_SESSION['puntosMaquina'] = 0;
        while ($_SESSION['puntosMaquina']<7.5 && $_SESSION['puntosMaquina']<=$_SESSION['puntos']) {
            ob_flush();flush();sleep(2.7);
            eliminarCarta();
            $jugador = 'maquina';
            pedirCarta($jugador);
            if ($_SESSION['puntosMaquina']<7.5&&$_SESSION['puntosMaquina']>$_SESSION['puntos']) {
                campeonSuperando();
            }elseif ($_SESSION['puntosMaquina']===7.5) {
                campeon($jugador);
            }elseif ($_SESSION['puntosMaquina']>7.5) {
                pierde($jugador);
            }
        }
    }

    //------------ FUNCIONES JS--------------//

    /**
    * Función que oculta el botón de pedir cartas
    *
    */
    function ocultarBotonPedir() {
        echo '<script type="text/javascript">'
            . '$( ".pedir" ).hide();'
            . '</script>';
    }

    /**
    * Función que oculta el botón de plantarse
    *
    */
    function ocultarBotonPlantarse() {
        echo '<script type="text/javascript">'
            . '$( ".plantarse" ).hide();'
            . '</script>';
    }

    /**
    * Función que muestra el botón de otra partida
    *
    */
    function mostrarBotonOtraPartida() {
        echo '<script type="text/javascript">'
            . '$( ".otraPartida" ).show();'
            . '</script>';
    }

    /**
    * Función que muestra el botón de plantarse
    *
    */
    function mostrarBotonPlantarse() {
        echo '<script type="text/javascript">'
            . '$( ".plantarse" ).show();'
            . '</script>';
    }

    /**
    * Función que vacía el div donde se muestran las cartas para que muestre sólo la última.
    *
    */
    function eliminarCarta() {
        echo '<script type="text/javascript">'
            . '$( ".carta_maquina" ).empty();'
            . '</script>';
    }
?>
