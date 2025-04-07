$(function () {
    plantaModal();
    previewModal();

    $("#mainBackground .img-fluid").on('click', function(){
        showModal($(this).attr('src'));
    })

    $(".collapse").each(function(){
        $(this).on('shown.bs.collapse', function(){
            var checked, expanded;
            $(this).children().each(function(){
                if($(this).is(':checked')){ 
                    $($(this).data('bs-target')).collapse('show');
                    return;
                }
            });
        });
    });

    function showModal(src){
        $("#plantaView").attr('src', src);
        $("#modalPlanta").modal('show');
    }

    function plantaModal(){
        $('.planta').each(function(){
            var planta = $(this);
            $(this).on('click', function(){
                showModal($(planta).attr('src'));
            });
        });
    }

    function previewModal(){
        $('.preview-edf').each(function(){
            var preview = $(this);
            preview.on('click', function(){
                $('.carousel-item').each(function(){
                    if($(this).hasClass('active'))
                        $(this).removeClass('active');
                    if($($(this).children('img')[0]).attr('src') == $(preview).attr('src'))
                        $(this).addClass('active');
                });
                $("#modalPreview").modal('show');
            });
        });
    }

    
});