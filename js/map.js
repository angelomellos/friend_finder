function updateDirections(){
  directionsService.route({
    origin: $("#origin")[0].dataset.address,
    destination: $(".active-friend")[0].dataset.address,
    travelMode: google.maps.TravelMode[$(".selected-button")[0].dataset.mode]
  }, function(response, status){
    if (status === "OK"){
      directionsDisplay.setDirections({routes: []});
      directionsDisplay.setDirections(response);
    } else{
      $("#directions").html("Sorry: " + status);
      $(".friend, button").one("click", function(){
        $("#directions").html("");
      });
    }
  });
  }

function initMap(){
  directionsDisplay = new google.maps.DirectionsRenderer;
  directionsService = new google.maps.DirectionsService;
  var map = new google.maps.Map($("#map")[0],{});
  directionsDisplay.setPanel($("#directions")[0]);
  $(".friend").click(function(){
    updateDirections();
  });
}   
$("button").click(function(){
  $("button").removeClass("selected-button");
  $(this).addClass("selected-button");
  if ($(this).hasClass("directions-button")){
    $("#map").css("display","none");
    $("#directions").css("display","inline");
  }
  else{
    $("#map").css("display","inline");
    $("#directions").css("display", "none");
  }
  updateDirections();
});
