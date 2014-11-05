console.log('iniciando eventos para Seguimiento, usuario');
    var actionSeguimiento = (function() {
      var mapOptions = {
                      zoom: 13,
                      mapTypeId: google.maps.MapTypeId.ROADMAP  
            };
      var markerMyPosition;
      var markerAlerta;
      var map;
      var latitud, longitud, nombreAlerta, numeroTelefono, mensaje;
      var accionTiempo;
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
                 markerMyPosition = new google.maps.Marker({position: initialLocationuser,map:map});
                 markerMyPosition.setMap(map);
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
            markerAlerta = new google.maps.Marker({
                position: locationAlerta,
                map:map,
                title: nombre + " N° telefónico: "+ numero,
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
                   $("div.contenedor_dropdown").empty();
                   $("div.contenedor_dropdown").append(response['dropdown']);
                   if(response['lat'] == 0 && response['lng'] == 0){
                       clearInterval(accionTiempo);
                       alert('El usuario ya no está en peligro, si quieres llamalo al teléfono '
                               +numeroTelefono+ 'para saber más de él');
                       markerAlerta = null;
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
