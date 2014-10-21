console.log('iniciando eventos de bomberos, usuario');
    var actionBombero = (function() {
      var myOptions;
      var map;
      var marker;
      return {
        
        
        cargarMapa: function(){
            google.maps.event.addDomListener(window, 'load', actionBombero.initializeMap());
        },
        
        initializeMap: function(){
          
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
                 marker = new google.maps.Marker({position: initialLocationuser,map:map});
                 marker.setMap(map);
                
                 });
            }
        },
        
        
        };
    })();