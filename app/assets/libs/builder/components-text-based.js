Vvveb.ComponentsGroup['Text based'] = ["text-based/text-box", "text-based/comment-box", "text-based/number", "text-based/multiple-text-box", "text-based/name", "text-based/email"];



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

Vvveb.Components.extend("_base", "text-based/text-box", {
    name: "Text box",
    attributes: { "type": "text" },
    image: "icons/tools/text-box.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                 <input type="text" class="form-control" id="exampleFormControlInput1">\
           </div>',
    properties: [{
        name: "Value",
        key: "value",
        htmlAttr: "value",
        inputtype: TextInput
    }, {
        name: "Placeholder",
        key: "placeholder",
        htmlAttr: "placeholder",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "text-based/comment-box", {
    name: "Comment box",
    attributes: { "type": "text" },
    image: "icons/tools/comment-box.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>\
           </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "text-based/number", {
    name: "Number",
    attributes: ["data-component-number"],
    image: "icons/tools/number.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <input type="number" class="form-control" id="exampleFormControlInput1">\
           </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});



Vvveb.Components.extend("_base", "text-based/multiple-text-box", {
    name: "Multiple text box",
    attributes: ["data-component-multiple-text-box"],
    image: "icons/tools/multiple-text-box.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="form-group">\
                    <label for="exampleFormControlInput1">Answer 1</label>\
                    <input type="text" class="form-control" id="exampleFormControlInput1">\
                </div>\
                <div class="form-group">\
                    <label for="exampleFormControlInput2">Answer 2</label>\
                    <input type="text" class="form-control" id="exampleFormControlInput2">\
                </div>\
                <div class="form-group">\
                    <label for="exampleFormControlInput3">Answer 3</label>\
                    <input type="text" class="form-control" id="exampleFormControlInput3">\
                </div>\
           </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});


Vvveb.Components.extend("_base", "text-based/name", {
    name: "Name",
    attributes: ["data-component-name"],
    image: "icons/tools/name.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="inner-addon left-addon">\
                    <i class="glyphicon glyphicon-user"></i>\
                    <input type="text" class="form-control"/>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "text-based/email", {
    name: "Email",
    attributes: ["data-component-email"],
    image: "icons/tools/email.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="inner-addon left-addon">\
                    <i class="glyphicon glyphicon-mail"></i>\
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});