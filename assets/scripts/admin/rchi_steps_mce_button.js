jQuery(function(){ 
    tinymce.create('tinymce.plugins.RchiSteps', {
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
                editor.addCommand('rchi_insert_steps_shortcode', function() {
                    var cssClass = prompt("Assign a specific class to steps?");
                    if (cssClass == null) {
                        cssClass = "";
                    }
                    selected = tinyMCE.activeEditor.selection.getContent();

                    if( selected ){
                        //If text is selected when button is clicked
                        //add after the content;
                        /*jshint multistr: true */
                        content =  selected + '[steps css_class="' + cssClass + '"/] \
                                    <!-- Note: Alignment works with 3 steps only --> \
                                    [step step_number="1" image_file="http://example.com/image.png" caption="This is a step 1" /] \
                                    [step step_number="2" image_file="http://example.com/image.png" caption="This is a step 2" /] \
                                    [step step_number="3" image_file="http://example.com/image.png" caption="This is a step 3" /] \
                                    [/steps]';
                    } else {
                        content =  '[steps css_class="' + cssClass + '"] \
                                    <!-- Three steps can be added here --> \
                                    [step step_number="1" image_file="http://example.com/image.png" caption="This is a step 1" /] \
                                    [step step_number="2" image_file="http://example.com/image.png" caption="This is a step 2" /] \
                                    [step step_number="3" image_file="http://example.com/image.png" caption="This is a step 3" /] \
                                    [/steps]';
                    }
                    
                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            editor.addButton('rchi_steps_button', {title : 'Insert \'Steps\' shortcode', cmd : 'rchi_insert_steps_shortcode', image: url.replace(url.substr(url.lastIndexOf('/') + 1), '/images/insert_steps.png') });
        },
 
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Rchi Steps Button',
                author : 'Hitankar Ray',
                authorurl : 'http://hitankarray.com',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'rchi_steps_button', tinymce.plugins.RchiSteps );
});