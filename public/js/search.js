$(function(){

  //Живой поиск
$('.search_keywords').bind("keyup", function() {
    if(this.value.length >= 1){
        $.ajax({
            type: 'post',
            url: Routing.generate('news_search'),
            data: {query: this.value},
            dataType: 'json',
            success: function(data){
                $(".search_result_items").empty().hide();
                if(data){
                    $(".search_result, .search_result_items").show();
                    $.each(data, function(translit, name){
                        $(".search_result_items").append("<a href='/player/"+translit+"'>"+name+"</a>");

                    });
                } else {

                }
                console.log(data);
           },
     error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
       })
    }
});
});
