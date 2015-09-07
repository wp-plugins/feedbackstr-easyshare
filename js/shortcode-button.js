(function() {
    tinymce.PluginManager.add('fdb_iframe', function( editor, url ) {
        var sh_tag = 'fdb_iframe';
 
        //helper functions
        function getAttr(s, n) {
            n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
            return n ?  window.decodeURIComponent(n[1]) : '';
        };
 
        function html( cls, data ,con) {
            var placeholder = url + '/img/' + getAttr(data,'type') + '.jpg';
            data = window.encodeURIComponent( data );
            content = window.encodeURIComponent( con );
 
            return '<img src="' + placeholder + '" class="mceItem ' + cls + '" ' + 'data-sh-attr="' + data + '" data-sh-content="'+ con+'" data-mce-resize="false" data-mce-placeholder="1" />';
        }
 
        function replaceShortcodes( content ) {
            //match [fdb_iframe(attr)](con)[/fdb_iframe]
            return content.replace( /\[fdb_iframe([^\]]*)\]([^\]]*)\[\/fdb_iframe\]/g, function( all,attr,con) {
                return html( 'wp-fdb_iframe', attr , con);
            });
        }
 
        function restoreShortcodes( content ) {
            //match any image tag with our class and replace it with the shortcode's content and attributes
            return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(?:<\/p>)*/g, function( match, image ) {
                var data = getAttr( image, 'data-sh-attr' );
                var con = getAttr( image, 'data-sh-content' );
 
                if ( data ) {
                    return '<p>[' + sh_tag + data + ']' + con + '[/'+sh_tag+']</p>';
                }
                return match;
            });
        }
 
        //add popup
        editor.addCommand('fdb_iframe_popup', function(ui, v) {
            //setup defaults
            var shortcode = '';
            if (v.shortcode)
                shortcode = v.shortcode;
            var height = '';
            if (v.height)
                height = v.height;
            var width = '';
            if (v.width)
                width = v.width;
            //open the popup
            editor.windowManager.open( {
                title: 'Feedbackstr iFrame Generator',
                body: [			
                    {//add shortcode input
                        type: 'textbox',
                        name: 'shortcode',
                        label: 'Short URL',
                        value: 'http://fdb.ac/easyshare',
                        tooltip: 'This is a Tooltip'
                    },
                    {//add height input
                        type: 'textbox',
                        name: 'height',
                        label: 'iFrame height:',
                        value: '640',
                        tooltip: 'Please enter the height (in PX) of your iFrame.'
                    },
                    {//add type input
                        type: 'textbox',
                        name: 'width',
                        label: 'iFrame width:',
                        value: '580',
                        tooltip: 'Please enter the width (in PX) of your iFrame.'
                    },
                 
                ],
                onsubmit: function( e ) { //when the ok button is clicked
                   //start the shortcode tag
					var shortcode_str = '[' + sh_tag + ' ';
 
                    //check for shortcode
                    if (typeof e.data.shortcode != '' && e.data.shortcode.length)
                        shortcode_str += ' shortcode="' + e.data.shortcode + '"';

					 //check for width
                    if (typeof e.data.shortcode != '' && e.data.width.length)
                        shortcode_str += ' width="' + e.data.width + '"';
                    //check for height
                    if (typeof e.data.height != '' && e.data.height.length)
                        shortcode_str += ' height="' + e.data.height + '"';
 
                    //add panel content
                    shortcode_str += '][/' + sh_tag + ']';
 
                    //insert shortcode to tinymce
                    editor.insertContent( shortcode_str);
                }
            });
        });
 
        //add button
        editor.addButton('fdb_iframe', {
            icon: 'fdb_iframe',
            tooltip: 'Feedbackstr iFrame',
            onclick: function() {
                editor.execCommand('fdb_iframe_popup','',{
                    shortcode : '',
                    height : '',
                    width  : 'default',
                    
                });
            }
        });
 
        
 
        //replace from image placeholder to shortcode
        editor.on('GetContent', function(event){
            event.content = restoreShortcodes(event.content);
        });
 
        //open popup on placeholder double click
        editor.on('DblClick',function(e) {
            var cls  = e.target.className.indexOf('wp-fdb_iframe');
            if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('wp-fdb_iframe') > -1 ) {
                var title = e.target.attributes['data-sh-attr'].value;
                title = window.decodeURIComponent(title);
                console.log(title);
                var content = e.target.attributes['data-sh-content'].value;
                editor.execCommand('fdb_iframe_popup','',{
                    shortcode : getAttr(title,'shortcode'),
                    height : getAttr(title,'height'),
                    width  : getAttr(title,'width')
                });
            }
        });
    });
})();