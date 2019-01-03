$(function(){
    
//Живой поиск
$('#search_keywords').bind("change keyup input click", function() {
    /*if(this.value.length >= 1){
        $.ajax({
            type: 'post',
            url: "{{ path('Nitra_OutletBundle_Pos_To_Route') }}",
            data: {'referal':this.value},
            response: 'text',
            success: function(data){
                $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
           },
     error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
       })
    }*/
});
    
$(".search_result").hover(function(){
    $("#search_keywords").blur(); //Убираем фокус с input
});
    
//При выборе результата поиска, прячем список и заносим выбранный результат в input
$(".search_result").on("click", "li", function(){
    s_user = $(this).text();

    $(".search_result").fadeOut();
});

});

