$(function(){
    const THEME_VAR_NAME = "bsTheme";

    // Inicializa o tema com base na preferência armazenada ou padrão (escuro)
    switchTheme(true); 

    $("#themeToggle input").on('change', function(){
        localStorage.setItem(THEME_VAR_NAME, $(this).is(':checked'));
        switchTheme();
    });

    function switchTheme(onLoad = false){
        var theme = localStorage.getItem(THEME_VAR_NAME) || 'true'; // Assume tema escuro por padrão
        $("body").attr('data-bs-theme', theme=='true'?'dark':'light');
        if(onLoad){
            $("#themeToggle input").prop('checked', theme=='true');
       }
    }
    
});

function addFooter(text){
    $("footer div .row").append(`<div class="col-lg"><p class="my-auto">${text}</p></div>`);
}
function formatNum(num){
    return Number(num).toLocaleString('pt', {
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    });
}