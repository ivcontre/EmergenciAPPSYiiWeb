console.log('iniciando eventos de cuenta');
    var actionCarabinero = (function() {
      var myOptions;
      var map;
      return {
        /**
         * 
         * page-wrapper
         * @author Sebastian
         * @param {String} tabla
         * @returns {undefined}
         */
        initializeconcoordenadas: function(lat,lon) {
            var latlng = new google.maps.LatLng(lat,lon);
            myOptions = {
              zoom: 12,
              center: latlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP  
            };
            map = new google.maps.Map(document.getElementById("map_detalle"),myOptions);
            var marker = new google.maps.Marker({
            position: latlng});
            marker.setMap(map); 
        },
        /**
         * 
         * @param {type} nombreServicio
         * @returns {undefined}
         */
        cargarMapaIngreso: function(nombreServicio){
            google.maps.event.addDomListener(window, 'load', actionCarabinero.initializeMapIngreso(nombreServicio));
        },
        initializeMapIngreso: function(nombreServicio){
            var centroEmergencia = nombreServicio;
     
        
            var markersArray = [];
            mapOptions = {
                      zoom: 13,
                      mapTypeId: google.maps.MapTypeId.ROADMAP  
            };
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(document.getElementById('map'),mapOptions);

            if(navigator.geolocation){
                browserSupportFlag = true;
                 navigator.geolocation.getCurrentPosition(function(position) { 
                 initialLocationuser = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                 map.setCenter(initialLocationuser);
                 var marker = new google.maps.Marker({position: initialLocationuser,map:map});
                 marker.setMap(map);
                 markersArray.push(marker);
                google.maps.event.addListener(map, "click", function(evento) {
                    for (var i = 0; i < markersArray.length; i++ ) {
                        markersArray[i].setMap(null);
                    }

                    document.getElementById(centroEmergencia+"_x").value = evento.latLng.lat();
                    document.getElementById(centroEmergencia+"_y").value = evento.latLng.lng();

                     marker = new google.maps.Marker({
                        position: evento.latLng});
                        marker.setMap(map);
                        markersArray.push(marker);
                    });
                 });
            }
        },
        centrarMapaConDireccion: function(location){
            var geocoder = new google.maps.Geocoder();
            var request = {
                address: location+", Chile"
            }
            console.log("buscando para: "+location+ ", Chile");
            geocoder.geocode(request, function(geocodes, status) {

            /*
             * geocodes = result
             * OK
             * ZERO_RESULTS
             * OVER_QUERY_LIMIT
             * REQUEST_DENIED
             * INVALID_REQUEST
             */
            // Notifica al usuario el resultado obtenido
            console.log("respuesta obtenida: "+status);
            // En caso de terminarse exitosamente el proyecto ...
            if(status == google.maps.GeocoderStatus.OK){
                // Invoca la función de callback
                for(i=0; i<geocodes.length; i++){
                    // Centra el mapa en la nueva ubicación
                    map.setCenter(geocodes[i].geometry.location);
                    // Valores iniciales del marcador
                    var marker = new google.maps.Marker({
                        map: map,
                        title: geocodes[i].formatted_address
                    });

                    // Establece la ubicación del marcador

                    marker.setPosition(geocodes[i].geometry.location);

                    // Establece el contenido de la ventana de información

                    var infoWindow = new google.maps.InfoWindow();

                    content = "Ubicación: " + geocodes[i].formatted_address + "<br />" +
                              "Tipo: " + geocodes[i].types + "<br />" +
                              "Latitud: " + geocodes[i].geometry.location.lat() + "<br />" +
                              "Longitud: " + geocodes[i].geometry.location.lng();

                    infoWindow.setContent(content);

                    // Asocia el evento de clic sobre el marcador con el despliegue
                    // de la ventana de información

                    google.maps.event.addListener(marker, 'click', function(event) {
                        infoWindow.open(map, marker);
                    });
                }
            }
            // En caso de error retorna el estado
        });
        }
      };
    })();