console.log('iniciando eventos de PDI, usuario');
    var actionPDI = (function() {
      var myOptions;
      var map;
      var marker;
      var markersArray = [];
      var bounds;
      var initialLocationuser;
      var ventana;
      var miComuna;
      
      return {
        
        
        cargarMapa: function(){
            google.maps.event.addDomListener(window, 'load', actionPDI.initializeMap());
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
                     geocoder.geocode({'latLng': initialLocationuser}, function(results, status) {
                         if (status == google.maps.GeocoderStatus.OK) {
                             if (results[0]) {
                                 var direccion = results[0].formatted_address;
                                 console.log(direccion);
                                 var elementos = direccion.split(',');
                                 var com = elementos[1].toUpperCase();
                                 miComuna = com.replace(" ","");
                                 
                                 document.getElementById("comuna").value = miComuna;
                                 var info = "<div><h2>Estás Aquí</h2><p>"+results[0].formatted_address+"</p></div>";
                                 marker = new google.maps.Marker({position: initialLocationuser,map:map});
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
                    var cadena = "";
                    
                     console.log(lat+", "+lng);
                     var tabla = "pdi";
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
                   var pdi = response.pdi;
                    $.each(pdi, function(i, item){
                        
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
        
        initializeMapPDIPorComuna: function(id_comuna){
               bounds = new google.maps.LatLngBounds();
               for (var i = 0; i < markersArray.length; i++ ) {
                        markersArray[i].setMap(null);
                }
                
                
                var tabla = "pdi";
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
                   if(response.pdi == null ){
                       alert("No existen resultados para la comuna consultada");
                       actionPDI.cargarMapa();
                   }else{
                       var pdi = response.pdi;
                    $.each(pdi, function(i, item){
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
                   }
                   
                    
                    
                },
                error: function(e) {
                    console.log("Error al ejecutar AJAX"+e);
                    
                                  
                }      });
                
                
            
        },
        
        
        };
    })();