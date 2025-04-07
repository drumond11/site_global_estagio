function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'pt,en,es,fr,de,ru,zh-CN',   
        }, 'google_translate_element');
    }

    function mudarLingua(lang) {
        var selectElement = document.querySelector("#google_translate_element select");
        var currentFlag = document.getElementById("current_flag");
        var flagClass = "";

        switch (lang) {
            case 'en':
                flagClass = "flag-icon-uk";
                break;
            case 'ru':
                flagClass = "flag-icon-ru";
                break;
            case 'zh-CN':
                flagClass = "flag-icon-zh-CN";
                break;    
            case 'fr':
                flagClass = "flag-icon-fr";
                break;
            case 'de':
                flagClass = "flag-icon-de";
                break;
            case 'pt':
                flagClass = "flag-icon-pt";
                break;
            default:
                flagClass = "flag-icon-pt";
                break;
        }

        currentFlag.className = "flag-icon " + flagClass;

        for (var i = 0; i < selectElement.options.length; i++) {
            var option = selectElement.options[i];
            if (option.value === lang) {
                selectElement.selectedIndex = i;
                selectElement.dispatchEvent(new Event('change'));
                break;
            }
        }
    }