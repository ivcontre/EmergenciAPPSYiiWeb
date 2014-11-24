console.log('iniciando eventos para Seguimiento, usuario');
    var actionSeguimiento = (function() {
      var mapOptions = {
                      zoom: 13,
                      mapTypeId: google.maps.MapTypeId.HYBRID  
            };
      var markerMyPosition;
      var markerAlerta = null;
      var map;
      var contador = false;
      var latitud, longitud, nombreAlerta, numeroTelefono, mensaje;
      var accionTiempo;
      var ventana;
      var initialLocationuser;
      return {

        cargarMapa: function(){
            google.maps.event.addDomListener(window, 'load', actionSeguimiento.inicializaMapa());
        },
        
        inicializaMapa: function(){     

            
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(document.getElementById('map'),mapOptions);

            if(navigator.geolocation){
                browserSupportFlag = true;
                 navigator.geolocation.getCurrentPosition(function(position) { 
                    initialLocationuser = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                    map.setCenter(initialLocationuser);
                    markerMyPosition = new google.maps.Marker({
                        position: initialLocationuser,
                        map:map,
                        icon:yii.urls.base+"/icons/iconoposicion_37x37.png",
                        animation: google.maps.Animation.DROP
                    });
                    markerMyPosition.setMap(map);
                 
                 /*
                  * Se busca direccion del usuario
                  */
                    geocoder.geocode({'latLng': initialLocationuser}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    var direccion = results[0].formatted_address;
                                    var info = "<div><h2>Estás Aquí</h2><p>"+results[0].formatted_address+"</p></div>";
                                    markerMyPosition.setMap(map);
                                    google.maps.event.addListener(markerMyPosition,"click", function(){
                                       if(ventana){
                                           ventana.close();
                                       }
                                        ventana = new google.maps.InfoWindow({content:info});
                                         ventana.open(map, markerMyPosition);

                                       
                                   });
                                }
                            }
                        });
                     });
            }
        },
        /**
         * funcion encargada de cargar un punto en el mapa
         * @param {type} lat
         * @param {type} lng
         * @param {type} nombre
         * @param {type} numero
         * @returns {undefined}
         */        
        cargaPunto: function(lat, lng, nombre, numero, msg){
            latitud = lat;
            longitud = lng;
            nombreAlerta = nombre;
            numeroTelefono = numero;
            mensaje = msg;
            contentString = '<div id="container">'+
                            '<h2 >'+nombre+' - '+numero+'</h2>'+
                            '<div id="bodyContent">'+
                            '<p><b>Mensaje escrito por tu amigo:</b>\n'+
                            '<p>'+ msg+'</p>'+
                            
                            '</div>'+
                            '</div>';
            infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            
            locationAlerta = new google.maps.LatLng(lat,lng);
            map.setCenter(locationAlerta);
            if(markerAlerta!=null)
                markerAlerta.setMap(null);
            markerAlerta = new google.maps.Marker({
                position: locationAlerta,
                map:map,
                title: nombre + " N° telefónico: "+ numero,
                icon:yii.urls.base+"/icons/posicionauxilio_37x29.png",
                animation: google.maps.Animation.DROP,
            });
            //se agrega info window al hacer click en el marcador del usuario en alerta
            google.maps.event.addListener(markerAlerta, 'click', function() {
                infowindow.open(map,markerAlerta);
            });
             console.log("Se inicia Evento de tiempo");
            accionTiempo = setInterval("actionSeguimiento.actualizaPosicion()", 30000);
            // clearInterval(time);
        },
                
        actualizaPosicion: function(){
            console.log("Se actualiza Posicion");
            var datos = "&id_usuario="+numeroTelefono;
            $.ajax({
                type: "GET",
                url: "http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php?r=contacto/alertas",
                data: datos,
                dataType: "json",
                success: function(response) {
                   if(contador){
                        $("div.contenedor_dropdown").empty();
                        $("div.contenedor_dropdown").append(response['dropdown']);
                        contador = false;
                   }else{
                       contador = true;
                   }
                   if(response['lat'] == 0 && response['lng'] == 0){
                       clearInterval(accionTiempo);
                       alert('El usuario ya no está en peligro, si deseas puedes llamarlo al siguiente número '
                               +numeroTelefono+ ' para saber más de él');
                       markerAlerta.setMap(null);
                       map.setCenter(initialLocationuser);
                   }else{
                       
                       locationAlerta = new google.maps.LatLng(response['lat'],response['lng']);
                       map.setCenter(locationAlerta);
                       markerAlerta.setPosition(locationAlerta);
                   }
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
        }
        };
    })();
