window.Dropzone = require('dropzone/dist/min/dropzone.min.js');
const dropzone = window.Dropzone;
const image = {
    width: document.querySelectorAll('[app-base-config="image_width"]')[0].value,
    height: document.querySelectorAll('[app-base-config="image_height"]')[0].value
}

dropzone.options.uploadForm = {
    init: function () {
        this.on('addedfile', function (file) {
            console.log(file.width);
        })
            .on('success', function (file, response) {
                document.getElementById('offerform-file_id').value = response;
                // todo: backend validation last uploaded file
            });
    },
    url: '/dashboard/upload',
    addRemoveLinks: true,
    maxFiles: 1,
    thumbnailWidth: 200,
    acceptedFiles: 'image/*'
};
