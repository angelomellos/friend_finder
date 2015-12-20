function initMap(){
  var routeObj = {
    origin: "detroit, michigan",
    destination: "chicago, illinois",
    travelMode: google.maps.TravelMode.DRIVING
  };
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var directionsService = new google.maps.DirectionsService;
  var map = new google.maps.Map($("#map")[0],{});
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel($("#directions")[0]);
  $("#directions").click(function(){
    directionsService.route({
      origin: "detroit, michigan",
      destination: "chicago, illinois",
      travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status){
      directionsDisplay.setDirections(response);
    });
  });
}   
