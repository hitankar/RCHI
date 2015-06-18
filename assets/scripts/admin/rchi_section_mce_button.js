jQuery(function(){ 
    var openTagExists = false;
    tinymce.create('tinymce.plugins.RchiSection', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(editor, url) {
                // Register command for when button is clicked
                editor.addCommand('rchi_insert_section_shortcode', function() {
                    if ( openTagExists ) {
                        openTagExists = false;
                        tinymce.execCommand('mceInsertContent', false, "[/section]");
                    }
                    else {

                        var cssClass = prompt("Assign a specific class to section? It can be the following combination separated by space:\n even, odd ","basic");
                        if (cssClass == null) {
                            cssClass = "basic";
                        }
                        selected = tinyMCE.activeEditor.selection.getContent();

                        if( selected ){
                            //If text is selected when button is clicked
                            //Wrap section around it.
                            content =  '[section css_class="' + cssClass + '"/]'+selected+'[/section]';
                        } else {
                            content =  '[section css_class="' + cssClass + '"]';
                        }
                        
                        openTagExists = true;
                        tinymce.execCommand('mceInsertContent', false, content);
                    }
                });

            // Register buttons - trigger above command when clicked
            editor.addButton('rchi_section_button', {title : 'Insert \'Section\' shortcode', cmd : 'rchi_insert_section_shortcode', image: url.replace(url.substr(url.lastIndexOf('/') + 1), '/images/insert_section.png') });
        },
 
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Rchi Section Button',
                author : 'Hitankar Ray',
                authorurl : 'http://hitankarray.com',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'rchi_section_button', tinymce.plugins.RchiSection );
});