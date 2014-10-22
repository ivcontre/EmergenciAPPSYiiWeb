console.log('iniciando eventos de bomberos, usuario');
    var actionBombero = (function() {
      var myOptions;
      var map;
      var marker;
      var markersArray = [];
      var bounds;
      var initialLocationuser;
      var ventana;
      
      
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
            bounds = new google.maps.LatLngBounds();
            if(navigator.geolocation){
                browserSupportFlag = true;
                 navigator.geolocation.getCurrentPosition(function(position) { 
                     var lat = position.coords.latitude;
                     var lng = position.coords.longitude;
                     initialLocationuser = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                     bounds.extend(initialLocationuser);
                    var cadena = "";
                    marker = new google.maps.Marker({position: initialLocationuser,map:map});
                    markersArray.push(marker);
                     console.log(lat+", "+lng);
                     var tabla = "bombero";
                     var datos = "&lat="+lat
                               +"&lng="+lng
                               +"&tabla="+tabla;
                $.ajax({
                type: "GET",
                url: "http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php?r=api/cercanos",
                data: datos,
                dataType: "json",
                success: function(response) {
                   console.log("ajax ejecutado correctamente");
                   var bombero = response.bombero;
                    $.each(bombero, function(i, item){
                        
                        var latlng = new google.maps.LatLng(item.lat,item.lng);
                        var marker = new google.maps.Marker({
                        position: latlng,
                        title: item.nombre,
                        icon: yii.urls.base+"/icons/marcadorbombero.png"});
                        bounds.extend(latlng);
                        var cadena ="<div><h2>"+item.nombre+"</h2><p>"+item.direccion+"</p><p>"+item.telefono+"</p></div>";
                        google.maps.event.addListener(marker,"click", function(){
                           if(ventana){
                               ventana.close();
                           } 
                           ventana = new google.maps.InfoWindow({content:cadena});
                           ventana.open(map, marker);
                        });
                        markersArray.push(marker);
                        marker.setMap(map); 
                        
                    });
                    map.fitBounds(bounds);
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
                
                 });
            }
        },
        
        initializeMapBomberosPorComuna: function(id_comuna){
               for (var i = 0; i < markersArray.length; i++ ) {
                        markersArray[i].setMap(null);
                }
                
                initialLocationuser = null;
                var tabla = "bombero";
                var datos ="&id_comuna="+id_comuna
                            +"&tabla="+tabla;
                console.log("datos: "+datos);
                $.ajax({
                type: "GET",
                url: "http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php?r=api/PorComuna",
                data: datos,
                dataType: "json",
                success: function(response) {
                   console.log("ajax ejecutado correctamente");
                   if(response.bombero == null){
                       console.log("Vacío");
                   }
                   var bombero = response.bombero;
                   
                    $.each(bombero, function(i, item){
                        var latlng = new google.maps.LatLng(item.lat,item.lng);
                        var marker = new google.maps.Marker({
                        position: latlng,
                        title: item.nombre,
                        icon: yii.urls.base+"/icons/marcadorbombero.png"});
                        bounds.extend(latlng);
                        var cadena ="<div><h2>"+item.nombre+"</h2><p>"+item.direccion+"</p><p>"+item.telefono+"</p></div>";
                        google.maps.event.addListener(marker,"click", function(){
                           if(ventana){
                               ventana.close();
                           } 
                           ventana = new google.maps.InfoWindow({content:cadena});
                           ventana.open(map, marker);
                        });
                        markersArray.push(marker);
                        marker.setMap(map); 
                        
                    });
                    map.fitBounds(bounds);
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
                
                
            
        },
        
        
        };
    })();