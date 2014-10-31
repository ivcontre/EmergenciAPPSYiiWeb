console.log('iniciando eventos para Seguimiento, usuario');
    var actionSeguimiento = (function() {
      var mapOptions = {
                      zoom: 13,
                      mapTypeId: google.maps.MapTypeId.ROADMAP  
            };
      var markerMyPosition;
      var markerAlerta;
      var map;
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
            google.maps.event.addListener(markerAlerta, 'click', function() {
                infowindow.open(map,markerAlerta);
            });
        },
        };
    })();
