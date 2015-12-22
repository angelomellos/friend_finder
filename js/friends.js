$(document).ready(function(){
function friendClick(){
  $(".friend").click(function() {
    $(".friend").removeClass("active-friend");
    $(this).addClass("active-friend");
    var address = $(this)[0].dataset.address;
    $("iframe").remove();
    $('<iframe />');
    $('<iframe />', {
       width: '600',
       height: '450',
       id: 'map',
       style: "display: "+ ($(".selected-button").hasClass("map-button") ? "inline" : "none"),
       src: 'https://www.google.com/maps/embed/v1/directions?origin='+ $("#origin")[0].dataset.address + '&destination=' + address + '&key=AIzaSyCI6UJn0C4MdiUGS_7kz-e-W9_1wmjJkuA'
    }).appendTo('#map-div');
  }
)};
friendClick();
$("#search").keyup(function(){
  if(!$("#search").val()){
    body =  {"query": { "match_all": {} }}
  } else 
  {
    var body = 
    {
      "query" : {
        "multi_match" : {
          "query" : $("#search").val() + "*",
          "fields" : [ "full-name", "first-name", "last-name", "city", "address", "state" ],
          "type" : "phrase_prefix"
          }
      }
    };
  }
  $.ajax({
    method: "POST",
    url: "http://159.203.140.74:9200/friends/friends/_search",
    contentType: "application/json",
    data: JSON.stringify(body)
  }).done(function(res){
    $(".friend").remove();
    var hits = res['hits']['hits'];
    for(i=0; i < hits.length; i++){
      $("<div>")
      .addClass("friend")
      .attr("data-address", hits[i]._source.city)
      .html(hits[i]._source["full-name"] + "<br>" + hits[i]._source.city + ", " + hits[i]._source.state)
      .appendTo("#friend-container");
    };
    friendClick();
  })
})
})
