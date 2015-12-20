function friendClick(){
  $(".friend").click(function() {
    var address = $(this).context.dataset.address;
    $("iframe").remove();
    $('<iframe />');
    $('<iframe />', {
       width: '600',
       height: '450',
       id: 'map',
       src: 'https://www.google.com/maps/embed/v1/directions?origin={{origin}}&destination=' + address + '&key={{key}}'
    }).appendTo('#map-div');
  }
)};
friendClick();
$("#search").keyup(function(){
  var body = {
    "query" : {
      "multi_match" : {
        "query" : $("#search").val() + "*",
        "fields" : [ "first-name", "last-name", "city", "address", "state" ],
        "type" : "phrase_prefix"
        }
    }
  };
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
      .html("Name: " + hits[i]._source["first-name"] +
      " " + hits[i]._source["last-name"] + "<br>City: " + hits[i]._source.city)
      .appendTo("#friend-container");
    };
    friendClick();
  })
})
