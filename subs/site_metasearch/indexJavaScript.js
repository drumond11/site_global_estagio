function openModal(id) {
    $('#propertyIdInput').val(id);
    $('#emailModal').modal('show');
}
function closeModal() {
    $('#emailModal').modal('hide');
}

$(document).ready(function () {
    // Inicializa objetos para armazenar relações
    var totalData = {};
    var concelhoDistrito = {};
    var freguesiaConcelho = {};

    var selectedDistrito = $('#selectedDistrito').val();
    var selectedConcelho = $('#selectedConcelho').val();
    var selectedFreguesia = $('#selectedFreguesia').val();

    $.ajax({
        url: 'distritos.json',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Inicializa opções com "none" como padrão
            var optionsD = '<option value="none">Selecione o Distrito</option>';
            var optionsC = '<option value="none">Selecione o Concelho</option>';
            var optionsF = '<option value="none">Selecione a Freguesia</option>';

            data.forEach(function (district) {
                var districtName = normalizeString(district.name);
                if (!totalData.hasOwnProperty(districtName)) {
                    totalData[districtName] = {};
                }

                var selectedDistrictAttr = (districtName === selectedDistrito) ? 'selected' : '';
                optionsD += `<option value="${districtName}" ${selectedDistrictAttr}>${district.name}</option>`;

                district.concelhos.forEach(function (municipality) {
                    var municipalityName = normalizeString(municipality.name);
                    concelhoDistrito[municipalityName] = districtName;
                    if (!totalData[districtName].hasOwnProperty(municipalityName)) {
                        totalData[districtName][municipalityName] = [];
                    }

                    var selectedMunicipalityAttr = (municipalityName === selectedConcelho) ? 'selected' : '';
                    optionsC += `<option value="${municipalityName}" ${selectedMunicipalityAttr}>${municipality.name}</option>`;

                    municipality.freguesias.forEach(function (parish) {
                        var parishName = parish.name;
                        freguesiaConcelho[parishName] = municipalityName;
                        totalData[districtName][municipalityName].push(parishName);

                        var selectedParishAttr = (parishName === selectedFreguesia) ? 'selected' : '';
                        optionsF += `<option value="${parishName}" ${selectedParishAttr}>${parish.name}</option>`;
                    });
                });
            });
            $('#distrito').html(optionsD);
            $('#concelho').html(optionsC);
            $('#freguesia').html(optionsF);

            // Define as seleções padrão quando a página carrega
            $('#distrito').val(selectedDistrito);
            $('#concelho').val(selectedConcelho);
            $('#freguesia').val(selectedFreguesia);
            
            // Chama a função para atualizar as opções (descomentar esta linha)
            updateOptionsOnChange();
        },
        error: function (xhr, status, error) {
            console.error(status, error);
        }
    });

    // Função para normalizar string para comparações
    function normalizeString(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    // Manipulador de evento para mudança no "distrito"
    $('#distrito').change(function () {
        var selectedDistrito = $(this).val();
        if (selectedDistrito === "none") {
            // Reseta apenas os dropdowns de Concelho e Freguesia
            $('#concelho').html('<option value="none">Selecione o Concelho</option>');
            $('#freguesia').html('<option value="none">Selecione a Freguesia</option>');
        } else {
            var optionsC = '<option value="none">Selecione o Concelho</option>';
            for (var concelho in totalData[selectedDistrito]) {
                var selectedConcelhoAttr = (concelho === selectedConcelho) ? 'selected' : '';
                optionsC += `<option value="${concelho}" ${selectedConcelhoAttr}>${concelho}</option>`;
            }
            $('#concelho').html(optionsC);
            $('#freguesia').html('<option value="none">Selecione a Freguesia</option>');
        }
    });

    // Manipulador de evento para mudança no "concelho"
    $('#concelho').change(function () {
        var selectedConcelho = $(this).val();
        if (selectedConcelho === "none") {
            // Reseta apenas o dropdown da Freguesia
            $('#freguesia').html('<option value="none">Selecione a Freguesia</option>');
        } else {
            var selectedDistrito = concelhoDistrito[selectedConcelho];
            $('#distrito').val(selectedDistrito);

            var optionsF = '<option value="none">Selecione a Freguesia</option>';
            if (selectedDistrito && selectedConcelho) {
                totalData[selectedDistrito][selectedConcelho].forEach(function (freguesia) {
                    var selectedParishAttr = (freguesia === selectedFreguesia) ? 'selected' : '';
                    optionsF += `<option value="${freguesia}" ${selectedParishAttr}>${freguesia}</option>`;
                });
            }
            $('#freguesia').html(optionsF);
        }
    });

    // Manipulador de evento para mudança na "freguesia"
    $('#freguesia').change(function () {
        var selectedFreguesia = $(this).val();
        if (selectedFreguesia !== "none") {
            var selectedConcelho = freguesiaConcelho[selectedFreguesia];
            var selectedDistrito = concelhoDistrito[selectedConcelho];
            $('#distrito').val(selectedDistrito);
            $('#concelho').val(selectedConcelho);
            $('#freguesia').val(selectedFreguesia);
        }
    });

    // Função para garantir que as opções sejam atualizadas corretamente na mudança
    function updateOptionsOnChange() {
        setTimeout(function() {
            if (selectedDistrito !== 'none') {
                $('#distrito').val(selectedDistrito).trigger('change');
            }
            if (selectedConcelho !== 'none') {
                $('#concelho').val(selectedConcelho).trigger('change');
            }
            if (selectedFreguesia !== 'none') {
                $('#freguesia').val(selectedFreguesia).trigger('change');
            }
        }, 500); // Meio segundo de atraso para garantir que as opções sejam carregadas
    }
});