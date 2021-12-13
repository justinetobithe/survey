Vvveb.ComponentsGroup['Media based'] = ["media-based/picture-selection", "media-based/picture-ranking", "media-based/file-upload"];



Vvveb.Components.add("_base", {
    name: "Element",
    properties: [{
        name: "Id",
        key: "id",
        htmlAttr: "id",
        inputtype: TextInput
    }, {
        name: "Class",
        key: "class",
        htmlAttr: "class",
        inputtype: TextInput
    }]
});



Vvveb.Components.extend("_base", "media-based/picture-selection", {
    name: "Picture selection",
    nodes: ["img"],
    image: "icons/tools/picture-selection.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="picture-selection">\
                    <img src="../assets/img/main/media-gallery-default-1.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                    <img src="../assets/img/main/media-gallery-default-2.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                    <img src="../assets/img/main/media-gallery-default-3.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                </div>\
            </div>',
    afterDrop: function(node) {
        node.attr("src", '');
        return node;
    },
    properties: [{
        name: "Image",
        key: "src",
        htmlAttr: "src",
        inputtype: FileUploadInput
    }, {
        name: "Width",
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: "Height",
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    }, {
        name: "Alt",
        key: "alt",
        htmlAttr: "alt",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "media-based/picture-ranking", {
    name: "Picture Ranking",
    nodes: ["img"],
    image: "icons/tools/picture-ranking.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="picture-ranking">\
                    <img src="../assets/img/main/media-gallery-default-1.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                    <img src="../assets/img/main/media-gallery-default-2.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                    <img src="../assets/img/main/media-gallery-default-3.png" class="rounded img-fluid img-thumbnail" width="" height="" alt="...">\
                </div>\
            </div>',
    afterDrop: function(node) {
        node.attr("src", '');
        return node;
    },
    properties: [{
        name: "Image",
        key: "src",
        htmlAttr: "src",
        inputtype: FileUploadInput
    }, {
        name: "Width",
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: "Height",
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    }, {
        name: "Alt",
        key: "alt",
        htmlAttr: "alt",
        inputtype: TextInput
    }]
});



Vvveb.Components.extend("_base", "media-based/file-upload", {
    name: "File upload",
    attributes: { "type": "file" },
    image: "icons/tools/file-upload.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <input type="file" class="form-control">\
           </div>',
});