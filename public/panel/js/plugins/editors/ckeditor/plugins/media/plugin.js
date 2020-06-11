CKEDITOR.plugins.add( 'media', {
    icons: 'media',
    init: function( editor ) {
        editor.addCommand( 'insertMedia', {
            exec: function( editor ) {
                pashayev.selectMedia(media => {
                    medias = '';
                    media.forEach(imageData => {
                        medias += `<img width="150" height="150" alt="${imageData.name}" src="${imageData.url}"/>`;
                    });
                    editor.insertHtml(medias);
                });

            }
        });
        editor.ui.addButton( 'Media', {
            label: 'Insert Media',
            command: 'insertMedia',
            toolbar: 'insert'
        });
    }
});
