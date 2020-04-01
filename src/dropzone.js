window.Dropzone = require('dropzone/dist/min/dropzone.min.js');
const dropzone = window.Dropzone;

dropzone.options.uploadForm = {
    init: function () {
        this.on('success', function (file, response) {
             document.getElementById('offerform-file_id').value = response;
             // todo: backend validation last uploaded file
        });
    },
    url: '/dashboard/upload',
    maxFiles: 1,
    thumbnailWidth: 200,
    acceptedFiles: 'image/*'
};
