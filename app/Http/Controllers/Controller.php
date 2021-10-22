<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //

    public function hello_word(){
        $content = 'hello word';
        return response($content, 200)
        ->header('Content-Type', 'application/json');
    }

    public function testApi(){
        $url = 'https://www.todoalojamiento.com/resttest/api/configuracion/rooms?idHotel=373';

        $user = env('API_TODOALOJAMIENTO_USER');
        $pwd = env('API_TODOALOJAMIENTO_PASSWORD');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 150);
        curl_setopt($curl, CURLOPT_TIMEOUT, 150);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'idHotel: 373',
            'Authorization: Basic '.base64_encode("$user:$pwd"),
        ));
        $response = curl_exec($curl);
        $curl_errno = curl_errno($curl);
        curl_close($curl);

        return response($response, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function testxml(){
        $xmlstr = <<<XML
            <?xml version='1.0' standalone='yes'?>
            <peliculas>
                <pelicula>
                    <titulo>PHP: Tras el Analilzador</titulo>
                    <personajes>
                        <personaje>
                            <nombre>Srta. Programadora</nombre>
                            <actor>Onlivia Actora</actor>
                        </personaje>
                        <personaje>
                            <nombre>Sr. Programador</nombre>
                            <actor>El Actor</actor>
                        </personaje>
                    </personajes>
                    <argumento>
                        Así que, este lenguaje. Es como, un lenguaje de programación. ¿O es un
                        lenguaje de script? Lo descubrirás en esta intrigante y temible parodia
                        de un documental.
                    </argumento>
                    <grandes-frases>
                        <frase>PHP soluciona todos los problemas web</frase>
                    </grandes-frases>
                    <puntuacion tipo="votos">7</puntuacion>
                    <puntuacion tipo="estrellas">5</puntuacion>
                </pelicula>
            </peliculas>
        XML;

        $string = '<peliculas>
            <pelicula>
                <titulo>PHP: Tras el Analilzador</titulo>
                <personajes>
                    <personaje>
                        <nombre>Srta. Programadora</nombre>
                        <actor>Onlivia Actora</actor>
                    </personaje>
                    <personaje>
                        <nombre>Sr. Programador</nombre>
                        <actor>El Actor</actor>
                    </personaje>
                </personajes>
                <argumento>
                    Así que, este lenguaje. Es como, un lenguaje de programación. ¿O es un
                    lenguaje de script? Lo descubrirás en esta intrigante y temible parodia
                    de un documental.
                </argumento>
                <grandes-frases>
                    <frase>PHP soluciona todos los problemas web</frase>
                </grandes-frases>
                <puntuacion tipo="votos">7</puntuacion>
                <puntuacion tipo="estrellas">5</puntuacion>
            </pelicula>
        </peliculas>';

        $peliculas = simplexml_load_string($string);

        return response($peliculas->pelicula[0]->argumento, 200)
        ->header('Content-Type', 'application/json');
    }
}
