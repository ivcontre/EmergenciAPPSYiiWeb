console.log('iniciando eventos de carabineros, usuario');
    var actionCarabinero = (function() {
      var myOptions;
      var map;
      var marker;
      var markersArray = [];
      var bounds;
      var initialLocationuser;
      var directionsDisplay;
      var directionsService = new google.maps.DirectionsService();
      var ventana;
      var info;
      var miComuna;
      var radioBusqueda;
      
      return {
        
        
        cargarMapa: function(){
            google.maps.event.addDomListener(window, 'load', actionCarabinero.initializeMap());
        },
       
        initializeMap: function(){
           directionsDisplay = new google.maps.DirectionsRenderer();
            mapOptions = {
                      zoom: 13,
                      mapTypeId: google.maps.MapTypeId.HYBRID  
            };
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(document.getElementById('map'),mapOptions);
            directionsDisplay.setMap(map);
            directionsDisplay.setOptions( { suppressMarkers: true } );
            bounds = new google.maps.LatLngBounds();
            if(navigator.geolocation){
                browserSupportFlag = true;
                 navigator.geolocation.getCurrentPosition(function(position) { 
                     var lat = position.coords.latitude;
                     var lng = position.coords.longitude;
                     initialLocationuser = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                     bounds.extend(initialLocationuser);
                    geocoder.geocode({'latLng': initialLocationuser}, function(results, status) {
                         if (status == google.maps.GeocoderStatus.OK) {
                             if (results[0]) {
                                 var direccion = results[0].formatted_address;
                                 console.log(direccion);
                                 var elementos = direccion.split(',');
                                 var com = elementos[1].toUpperCase();
                                 miComuna = com.replace(" ","");
                                 
                                 document.getElementById("comuna").value = miComuna;
                                 info = "<div><h2>Estás Aquí</h2><p>"+results[0].formatted_address+"</p></div>";
                                 marker = new google.maps.Marker({position: initialLocationuser,map:map,icon:yii.urls.base+"/icons/iconoposicion_37x37.png"});
                                 markersArray.push(marker);
                                 google.maps.event.addListener(marker,"click", function(){
                                    if(ventana){
                                        ventana.close();
                                    } 
                                    ventana = new google.maps.InfoWindow({content:info});
                                    ventana.open(map, marker);
                                });
                             }
                         }
                     });
                     console.log(lat+", "+lng);
                     var tabla = "carabinero";
                     var datos = "&lat="+lat
                               +"&lng="+lng
                               +"&tabla="+tabla;
                $.ajax({
                type: "GET",
                url: "http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php?r=api/cercanos",
                data: datos,
                dataType: "json",
                success: function(response) {
                if(response.carabinero == 0){
                    if(confirm("No se encuentran resultados en el radio de búsqueda de "+response.radio+" km que usted ha configurado. ¿ Desea configurarlo ahora ?.")){
                           document.location.href="http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php?r=configuracion/update&id="+response.id_config;
                       }else{
                          actionCarabinero.mapaChile();
                       }
                }else{
                   console.log("ajax ejecutado correctamente");
                   var carabinero = response.carabinero;
                    $.each(carabinero, function(i, item){
                        
                        var latlng = new google.maps.LatLng(item.lat,item.lng);
                        var marker = new google.maps.Marker({
                        position: latlng,
                        title: item.nombre,
                        icon: yii.urls.base+"/icons/marcadorcarabinero.png"});
                        bounds.extend(latlng);
                        var cadena ="<div><h2>"+item.nombre+"</h2><p>"+item.direccion+"</p><p>"+item.telefono+"</p><input type='button' value='Ir' onclick='actionCarabinero.ruta("+item.lat+","+item.lng+");'></div>";
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
                }
                
                radioBusqueda = new google.maps.Circle({
                                                strokeColor: "#FFFF01",
                                                strokeOpacity: 0.8,
                                                strokeWeight: 1,
                                                fillColor: "#FFFF01",
                                                fillOpacity: 0.05,
                                                map: map,
                                                center: initialLocationuser,
                                                clickable: false,
                                                zIndex: -1,
                                                radius: (response.radio * 1000)
                                              });
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
                
                 });
            }
        },
        
        initializeMapCarabinerosPorComuna: function(id_comuna){
               bounds = new google.maps.LatLngBounds();
               radioBusqueda.setMap(null);
               directionsDisplay.setMap(null);
               
                
                
                var tabla = "carabinero";
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
                   if(response.carabinero == 0 ){
                       alert("No existen resultados para la comuna de "+response.comuna);
                       actionCarabinero.cargarMapa();
                   }else{
                       for (var i = 0; i < markersArray.length; i++ ) {
                            markersArray[i].setMap(null);
                        }
                       var carabinero = response.carabinero;
                    $.each(carabinero, function(i, item){
                        var latlng = new google.maps.LatLng(item.lat,item.lng);
                        var marker = new google.maps.Marker({
                        position: latlng,
                        title: item.nombre,
                        icon: yii.urls.base+"/icons/marcadorcarabinero.png"});
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
                   }
                   
                    
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
                
                
            
        },
        ruta: function(lat, lng){
            
//            var start = new google.maps.LatLng(lat_miPos, lng_miPos);
//            console.log(start);
//            var end = new google.maps.LatLng(lat_bom, lng_bom);
//            console.log(end);
            var request = {
                origin: initialLocationuser,
                destination: new google.maps.LatLng(lat, lng),
                travelMode: google.maps.TravelMode.WALKING
            }; 
            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                  directionsDisplay.setDirections(result);
                }
            });
        },
        mapaChile: function(){
             console.log("mapa de chile");
            
            var mapOptions = {
                zoom: 4,
                center: new google.maps.LatLng(-36.739055, -71.0574941)
              };
              
             map = new google.maps.Map(document.getElementById('map'),
                  mapOptions);
             
             document.getElementById("comuna").value = "";              
             document.getElementById("comuna").placeholder ="Ingrese Comuna";
             console.log("mapa de chile2");
        },
        
        
        };
    })();