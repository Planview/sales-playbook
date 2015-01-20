require.config({
    shim: {
        '../bower_components/codemirror-emmet/dist/emmet': {
            deps: ['../../codemirror/lib/codemirror']
        }
    }
});

require([
    '../bower_components/codemirror/lib/codemirror',
    '../bower_components/codemirror/mode/htmlmixed/htmlmixed',
    '../bower_components/codemirror/keymap/sublime'
], function (codemirror) {
    'use strict';

    window.CodeMirror = codemirror;

    require(['../bower_components/codemirror-emmet/dist/emmet'], function () {
        var textareas = document.getElementsByClassName('ide'),
            config = {
                mode: 'text/html',
                theme: 'solarized dark',
                lineNumbers: true,
                keyMap: 'sublime',
                profile: 'html'
            },
            i, ii;

        console.log(textareas);
        for (i = textareas.length - 1; i >= 0; i -= 1) {
            codemirror.fromTextArea(textareas[i], config);
        }

    });
});
