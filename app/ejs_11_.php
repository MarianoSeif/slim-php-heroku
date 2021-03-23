<?php




/*
Seif Mariano

*/


/*
Seif Mariano
Aplicación No 11 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow).
*/
echo '<h2>Ejercicio 11</h2> <br>';

for ($i=1; $i < 5; $i++) { 
    for ($j=1; $j < 5; $j++) { 
        echo $i.' a la '.$j.' potencia es: '.calcularPotencia($i, $j) . '<br>';
    }
}

function calcularPotencia($num, $pot): int
{ 
    return pow($num, $pot);
}


/*
Seif Mariano
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
*/
echo '<h2>Ejercicio 12</h2> <br>';

$palabra = array('H', 'O', 'L', 'A');

for ($i=0; $i < count($palabra); $i++) { 
    echo $palabra[$i];
}

echo '<br>';

for ($i=count($palabra)-1 ; $i > -1 ; $i--) { 
    echo $palabra[$i];
}
echo '<br>';


/*
Seif Mariano
Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.
*/
echo '<h2>Ejercicio 13</h2> <br>';




/*
Seif Mariano

*/
echo '<h2>Ejercicio 14</h2> <br>';

/*
Seif Mariano

*/
echo '<h2>Ejercicio 15</h2> <br>';

/*
Seif Mariano
Aplicación No 16 (Rectangulo - Punto)
Codificar las clases Punto y Rectangulo.
*/
echo '<h2>Ejercicio 16</h2> <br>';
require './class/Punto.php';
require './class/Rectangulo.php';

$v1 = new Punto(1,1);
$v2 = new Punto(5,1);
$v3 = new Punto(5,3);
$v4 = new Punto(1,3);

$rectangulo = new Rectangulo($v1, $v3);

echo $rectangulo->mostrarDatos();
echo $rectangulo->Dibujar();


/*
Seif Mariano
Aplicación No 17 (Auto)
*/
echo '<h2>Ejercicio 17</h2> <br>';
require './class/Auto.php';

$a1 = new Auto('bmw', 'rojo');
$a2 = new Auto('bmw', 'amarillo');

$a3 = new Auto('audi', 'gris', 10500);
$a4 = new Auto('audi', 'gris', 18300);

$a5 = new Auto('lamborghini', 'negro', 22400, new \DateTime('01-01-2010'));

$a3->AgregarImpuestos(1500);
$a4->AgregarImpuestos(1500);
$a5->AgregarImpuestos(1500);

echo 'Suma de a1 y a2: '.Auto::Add($a1, $a2).'<br>';
echo 'Suma de a3 y a4: '.Auto::Add($a3, $a4).'<br>';

echo 'Compara a1 con a2: ';
if ($a1->Equals($a2)){
    echo 'son iguales';
}else{
    echo 'no son iguales';
}
echo '<br>';

echo 'Compara a1 con a5: ';
if ($a1->Equals($a5)){
    echo 'son iguales';
}else{
    echo 'no son iguales';
}
echo '<br>';
echo '<br>';

//Muestro los autos
$autos = array($a1, $a2, $a3, $a4, $a5);

for ($i=0; $i < count($autos); $i++) { 
    if($i % 2 != 0){
        Auto::MostrarAuto($autos[$i]);
    }
}


/*
Seif Mariano

*/
echo '<h2>Ejercicio 18</h2> <br>';

/*
Seif Mariano

*/
echo '<h2>Ejercicio 19</h2> <br>';