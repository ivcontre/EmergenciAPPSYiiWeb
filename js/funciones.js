function initializeconcoordenadas(lat,lon){
       var latlng = new google.maps.LatLng(lat,lon);

       var myOptions = {
         zoom: 12,
         center: latlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP  
       };
       map = new google.maps.Map(document.getElementById("map_detalle"),myOptions);
       var marker = new google.maps.Marker({
       position: latlng});
       marker.setMap(map); 
}

function initializeMapIngreso(id){
        var centroEmergencia = ""+id;
     
        
        var markersArray = [];
        var mapOptions = {
                  
                  zoom: 13,
                  mapTypeId: google.maps.MapTypeId.ROADMAP  
        };
        geocoder = new google.maps.Geocoder();
        
        var map = new google.maps.Map(document.getElementById('map'),mapOptions);
        
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
        
        
}

function initializeMapEdicion(x,y){
        console.log("inicializa mapa edicion");
        var x = x;
        var y = y;
        var xy = new google.maps.LatLng(x,y);
        var mapOptions = {
                  center: new google.maps.LatLng(x, y),
                  zoom: 13,
                  mapTypeId: google.maps.MapTypeId.ROADMAP  
        };
        var elementMap = document.getElementById('map');
        var map = new google.maps.Map(elementMap,mapOptions);
       
        var marker = new google.maps.Marker({
        position: xy});
    
        marker.setMap(map);
        
        var markersArray = [];
        
        markersArray.push(marker);
        
        
            google.maps.event.addListener(map, "click", function(evento) {
                for (var i = 0; i < markersArray.length; i++ ) {
                    markersArray[i].setMap(null);
                }

                document.getElementById("CentroMedico_x").value = evento.latLng.lat();
                document.getElementById("CentroMedico_y").value = evento.latLng.lng();

                 marker = new google.maps.Marker({
                    position: evento.latLng});
                marker.setMap(map);
                markersArray.push(marker);



             });
}

function cargarMapaIngreso(id){
    google.maps.event.addDomListener(window, 'load', initializeMapIngreso(id));
}

function cargarMapaEdicion(x,y){
    google.maps.event.addDomListener(window, 'load', initializeMapEdicion(x,y));
}
        
