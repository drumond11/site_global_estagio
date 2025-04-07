$(function(){
    function formatNum(num){
        return Number(num).toLocaleString('pt', {
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        });
    }

    $("#formIMT").on("submit", function(event){
        var values = {};
        $("#formIMT :input").each(function(){
            values[this.name] = $(this).val();
        });
        $.ajax({
            url: location.href,
            type: "get",
            data: values,
            dataType: 'json',
            success: function(response){
                $("table").show();
                $("#imt").text(formatNum(response.imt)+"€");
                $("#selo").text(formatNum(response.selo)+"€");
                $("#total").text(formatNum(response.total)+"€");
            }
        });
        event.preventDefault();
    });    
});