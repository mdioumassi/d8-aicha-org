/**
 * @file
 * 'n1ed' plugin admin behavior.
 */

if (!includeJS) {
    function includeJS(urlJS, callback) {
        var doc = document;
        var scripts = doc.getElementsByTagName("script");
        var alreadyExists = false;
        var existingScript = null;
        for (var i = 0; i < scripts.length; i++) {
            var src = scripts[i].getAttribute("src");
            if (src && src.indexOf(urlJS) !== -1) {
                alreadyExists = true;
                existingScript = scripts[i];
            }
        }
        if (!alreadyExists) {
            var script = doc.createElement("script");
            script.type = "text/javascript";
            if (callback != null) {
                if (script.readyState) {  // IE
                    script.onreadystatechange = function () {
                        if (script.readyState === "loaded" || script.readyState === "complete") {
                            script.onreadystatechange = null;
                            callback(false);
                        }
                    };
                } else {  // Others
                    script.onload = function () {
                        callback(false);
                    };
                }
            }
            script.src = urlJS;
            doc.getElementsByTagName("head")[0].appendChild(script);
            return script;
        } else {
            if (callback != null)
                callback(true);
            return null;
        }
    }
}

if (!window.n1edEcoControlPanelLoaded) {

    window.n1edEcoControlPanelLoaded = true;

    var elsInputs = document.querySelectorAll("[data-n1ed-eco-param-name]");
    if (elsInputs.length === 0) {
        console.error("No params found on page, unable to run N1ED ecosystem admin panel");
    } else {

        var elFieldSet = document.getElementById("editor-settings-wrapper");
        var elPlaceHolder = document.createElement("div");
        elFieldSet.parentElement.insertBefore(elPlaceHolder, elFieldSet);

        includeJS("https://cloud.n1ed.com/cdn/" + window.drupalSettings.n1edApiKey + "/n1ed-conf.js", function() {

            setTimeout(
                (function() {
                    var _elPlaceHolder = elPlaceHolder;
                    var _elsInputs = Array.prototype.slice.call(elsInputs);
                    return function() {

                        var attach = function() {
                            if (window.N1EDConfigEditor) {
                                window.N1EDConfigEditor.getPluginsAvailable(
                                    window.drupalSettings.n1edApiKey,
                                    function (pluginsAvailable) {
                                        window.N1EDConfigEditor.attachToMultipleInputs(
                                            _elPlaceHolder,
                                            _elsInputs,
                                            pluginsAvailable
                                        );
                                    }
                                );
                            } else {
                                setTimeout(function () {
                                    attach();
                                }, 500);
                            }
                        };

                        attach();

                    }
                })(),
                1);

        });

    }

}