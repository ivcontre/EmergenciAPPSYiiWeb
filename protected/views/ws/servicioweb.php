<?php
    $tabla = $_POST['tabla'];
    $lat = (float)$_POST['lat'];
    $lng = (float)$_POST['lng'];
    //$comuna = $_GET[''];
    $distance = $_POST['distancia'];
    $box = getBoundaries($lat, $lng, $distance);
$link = mysql_connect("localhost","rhormaza","czeSCfCQ");
mysql_select_db("rhormaza",$link);

$laConsulta = 'SELECT '.$tabla.'.id AS id, '.$tabla.'.nombre AS nombre, '.$tabla.'.x AS x, '.$tabla.'.y AS y, '.$tabla.'.direccion AS direccion,'.$tabla.'.telefono AS telefono ,comuna.nombre AS nombre
        
                                        , ( 6371 * ACOS( 
                                             COS( RADIANS(' . $lat . ') ) 
                                             * COS(RADIANS( x ) ) 
                                             * COS(RADIANS( y ) 
                                             - RADIANS(' . $lng . ') ) 
                                             + SIN( RADIANS(' . $lat . ') ) 
                                             * SIN(RADIANS( x ) ) 
                                            )
                               ) AS distance 
                     FROM '.$tabla.', comuna 
                     WHERE (x BETWEEN ' . $box['min_lat']. ' AND ' . $box['max_lat'] . ')
                     AND (y BETWEEN ' . $box['min_lng']. ' AND ' . $box['max_lng']. ')
                         AND comuna.id_comuna = '.$tabla.'.id_comuna
                     HAVING distance < ' . $distance . ' 
                     ORDER BY distance ASC';
 $resultado = mysql_query($laConsulta,$link);
 $filas = array();
           while ($row = mysql_fetch_array($resultado)){
                           $columna = array();
                           $columna['id'] = $row['id'];
                           $columna['nombre'] = utf8_encode($row['nombre']);
                           $columna['lat'] = $row['x'];
                           $columna['lng'] = $row['y'];
                           $columna['direccion'] = utf8_encode( $row['direccion']);
                           $columna['telefono'] =$row['telefono'] ;
                           $columna['distancia'] =$row['distance'] ;
                           $columna['comuna'] = utf8_encode($row['nombre'] );
                           $filas[] = $columna;
           }
  $total = array();
  $total[$tabla] = $filas;
  $total['comuna'] = $filas[0]['comuna'];
  echo json_encode($total);
  
    function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371)
{
    $return = array();
     
    // Los angulos para cada dirección
    $cardinalCoords = array('north' => '0',
                            'south' => '180',
                            'east' => '90',
                            'west' => '270');
 
    $rLat = deg2rad($lat);
    $rLng = deg2rad($lng);
    $rAngDist = $distance/$earthRadius;
 
    foreach ($cardinalCoords as $name => $angle)
    {
        $rAngle = deg2rad($angle);
        $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
        $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
 
         $return[$name] = array('lat' => (float) rad2deg($rLatB), 
                                'lng' => (float) rad2deg($rLonB));
    }
 
    return array('min_lat'  => $return['south']['lat'],
                 'max_lat' => $return['north']['lat'],
                 'min_lng' => $return['west']['lng'],
                 'max_lng' => $return['east']['lng']);
}
?>