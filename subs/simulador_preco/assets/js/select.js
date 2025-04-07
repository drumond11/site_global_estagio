$(function () {
    /*var selectorList = $("select");
    selectorList.not(':last').on('change',function(){
        var parent = $(this).val();
        var index = selectorList.index($(this));
        $(this).find(':selected').data('list-parent');
        console.log('changed idex '+index)
        for(var i = index+1; i < selectorList.length;i++){
            var elem = selectorList.eq(i);
            if(elem.find(':selected').data('list-parent') == parent) break;
            console.log(elem.find('[hidden]'))
            elem.find(`[data-list-parent="${parent}"]`).attr('hidden',false);
        }
    });*/


    var concelhoDistrito = [];
    var freguesiaConcelho = [];
    var totalData = {};
    $(document).ready(function () {
        $.ajax({
            url: 'distritos.json',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Process the JSON data and populate the Concelho select element
                var optionsC = '<option value="none"></option>';
                var optionsD = '<option value="none"></option>';
                var optionsF = '<option value="none"></option>';
                //console.log(data);
                data.forEach(function (district, index) {
                    var districtName = normalizeString(district.name);
                    if (!totalData.hasOwnProperty(districtName)) {
                        // If not, initialize it with an empty object
                        totalData[districtName] = [];
                    }
                    district.concelhos.forEach(function (municipality, index) {

                        var municipalityName = normalizeString(municipality.name);
                        concelhoDistrito[municipalityName] = districtName;
                        if (!totalData[districtName].hasOwnProperty(municipalityName)) {
                            // If not, initialize it with an empty array
                            totalData[districtName][municipalityName] = [];
                        }
                        municipality.freguesias.forEach(function (parish, index) {
                            var parishName = normalizeString(parish.name);
                            freguesiaConcelho[parishName] = municipalityName;
                            totalData[districtName][municipalityName].push(parishName);
                            optionsF += '<option value="' + parishName + '">' + parish.name + '</option>';
                        });
                        optionsC += '<option value="' + municipalityName + '">' + municipality.name + '</option>';
                    });
                    optionsD += '<option value="' + districtName + '">' + district.name + '</option>';
                });
                $('#concelho').html(optionsC);
                $('#distrito').html(optionsD);
                $('#freguesia').html(optionsF);
                //console.log(totalData)
            },
            error: function (xhr, status, error) {
                console.error(status, error);
            }
        });
    });
    var selected
    // Update Freguesia and Distrito options based on selected Concelho
    $('#concelho').change(function () {
        var selectedConcelho = $(this).val();
        if (concelhoDistrito[selectedConcelho] != null) {
            var selectedDistrito = concelhoDistrito[selectedConcelho];
            //take out all distritos and append selecteDistrito
            $('#distrito').val(selectedDistrito);

            var options = '<option value="none"></option>';
            totalData[selectedDistrito][selectedConcelho].forEach(function (freguesia, index) {
                options += '<option value="' + freguesia + '">' + freguesia + '</option>';
            });
            $('#freguesia').html(options);
        } else {
            updateOptions();
            return
        }
        //var selected = $('#'+type).val();


    });
    $('#distrito').change(function () {
        if ($(this).val() == "none" || $(this).val() == null) {
            updateOptions();
            return;
        }
        var selectedDistrito = $(this).val();
        var options = '<option value="none"></option>';
        var optionsF = '<option value="none"></option>';
        for (var concelho in totalData[selectedDistrito]) {
            options += '<option value="' + concelho + '">' + concelho + '</option>';
            totalData[selectedDistrito][concelho].forEach(function (freguesia, index) {
                optionsF += '<option value="' + freguesia + '">' + freguesia + '</option>';
            });
        }
        $('#concelho').html(options);
        $('#freguesia').html(optionsF);
    });
    $('#freguesia').change(function () {
        if ($(this).val() == "none" || $(this).val() == null) {
            updateOptions();
            return;
        }
        var selectedFreguesia = $(this).val();
        var selectedConcelho = freguesiaConcelho[selectedFreguesia];
        var selectedDistrito = concelhoDistrito[selectedConcelho];
        $('#concelho').val(selectedConcelho);
        $('#distrito').val(selectedDistrito);
    });
    function updateOptions() {
        //fill all
        var options = '<option value="none"></option>';
        var optionsF = '<option value="none"></option>';
        var optionsD = '<option value="none"></option>';
        for (var distrito in totalData) {
            optionsD += '<option value="' + distrito + '">' + distrito + '</option>';
            for (var concelho in totalData[distrito]) {
                options += '<option value="' + concelho + '">' + concelho + '</option>';
                totalData[distrito][concelho].forEach(function (freguesia, index) {
                    optionsF += '<option value="' + freguesia + '">' + freguesia + '</option>';
                });
            }
        }
        $('#concelho').html(options);
        $('#distrito').html(optionsD);
        $('#freguesia').html(optionsF);
    }

    function normalizeString(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
});