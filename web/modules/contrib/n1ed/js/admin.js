/**
 * @file
 * 'n1ed' plugin admin behavior.
 */

if (!window.n1edEcoControlPanelLoaded) {

    window.n1edEcoControlPanelLoaded = true;

    var elFieldSet = document.getElementById("editor-settings-wrapper");
    var elConf = document.createElement("div");
    elFieldSet.parentElement.insertBefore(elConf, elFieldSet);

    elConf.innerHTML = '<div style="border: 1px solid #c0c0c0; margin: 1em 0; padding: 18px; border-radius: 2px; background-color: #fcfcfa">' +

        '<div style="display:flex;align-items: center">' +
            '<img style="flex: 0 0 280px; margin-right: 25px; border: 1px solid #CCC" src="https://n1ed.com/img/dashboard/dashboard-mini.png"/>' +

            '<div style="flex: 1 1 100%">' +

                '<div style="letter-spacing: 0.08em; text-transform: uppercase; font-size: 1em; font-weight: bold;">N1ED configuration</div>' +
                '<p style="max-width: 800px;">Your N1ED add-on for CKEditor is linked to API key <code style="border: 1px solid #AAA; padding: 4px 7px; margin: 0 4px 0 2px;">' + window.drupalSettings.n1edApiKey + '</code> <a href="/admin/config/content/n1ed" target="_blank">Change</a></p>' +

                (
                    (["N1D8", "N1ED"].indexOf(window.drupalSettings.n1edApiKey.substr(0, 4).toUpperCase()) > -1)
                    ?
                    '<p style="max-width: 800px;">This is <i>shared</i> API key. You can continue using it, but in order to configure N1ED you need to obtain your own API key for free.</p>'
                    :
                    ''
                ) +

                '<p style="max-width: 800px;">Configuration applies to all N1ED Ecosystem add-ons: N1ED, Bootstrap Editor, File Manager and other plugins you can enable from this dashboard. N1ED stores configuration on own server and using the power of CDN received both configuration and updates on the fly.</p>' +

                '<a target="_blank" href="https://n1ed.com/dashboard" class="button button--primary" style="margin:0">Configure N1ED Ecosystem</a>' +

            '</div>' +

        '</div>' +

    '</div>';

}