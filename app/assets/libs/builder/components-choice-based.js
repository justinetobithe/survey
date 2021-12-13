function changeNodeName(node, newNodeName) {
    var newNode;
    newNode = document.createElement(newNodeName);
    attributes = node.get(0).attributes;

    for (i = 0, len = attributes.length; i < len; i++) {
        newNode.setAttribute(attributes[i].nodeName, attributes[i].nodeValue);
    }

    $(newNode).append($(node).contents());
    $(node).replaceWith(newNode);

    return newNode;
}


Vvveb.ComponentsGroup['Choice based'] = ["choice-based/single-selection", "choice-based/multiple-selection", "choice-based/dropdown", "choice-based/likert", "choice-based/opinion-scale",
    "choice-based/nps", "choice-based/rating", "choice-based/sliders", "choice-based/emojis", "choice-based/thumbs", "choice-based/button"
];




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



Vvveb.Components.extend("_base", "choice-based/single-selection", {
    name: "Single Selection",
    attributes: { "type": "radio" },
    image: "icons/tools/single-selection.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <label class="radio"><input type="radio"> Answer 1</label>\
                <label class="radio"><input type="radio"> Answer 2</label>\
                <label class="radio"><input type="radio"> Answer 3</label>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/multiple-selection", {
    name: "Multiple Selection",
    attributes: { "type": "checkbox" },
    image: "icons/tools/multiple-selection.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <label for="" class="checkbox"><input type="checkbox"> Answer 1</label>\
                <label for="" class="checkbox"><input type="checkbox"> Answer 2</label>\
                <label for="" class="checkbox"><input type="checkbox"> Answer 3</label>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});


Vvveb.Components.extend("_base", "choice-based/dropdown", {
    nodes: ["select"],
    name: "Dropdown",
    // attributes: ["data-component-dropdown"],
    image: "icons/tools/dropdown.svg",
    html: '<div class="form-group" role="checkboxgroup" aria-labelledby="bulgy-checkbox-label">\
                <label for="" class="">Type your question here...</label>\
                <select class="form-control form-spacing">\
                    <option value=""> Answer 1</option>\
                    <option value=""> Answer 2</option>\
                    <option value=""> Answer 3</option>\
                </select>\
            </div>',
    beforeInit: function(node) {
        properties = [];
        var i = 0;

        $(node).find('option').each(function() {

            data = { "value": this.value, "text": this.text };

            i++;
            properties.push({
                name: "Option " + i,
                key: "option" + i,
                //index: i - 1,
                optionNode: this,
                inputtype: TextValueInput,
                data: data,
                onChange: function(node, value, input) {

                    option = $(this.optionNode);

                    //if remove button is clicked remove option and render row properties
                    if (input.nodeName == 'BUTTON') {
                        option.remove();
                        Vvveb.Components.render("html/selectinput");
                        return node;
                    }

                    if (input.name == "value") option.attr("value", value);
                    else if (input.name == "text") option.text(value);

                    return node;
                },
            });
        });

        //remove all option properties
        this.properties = this.properties.filter(function(item) {
            return item.key.indexOf("option") === -1;
        });

        //add remaining properties to generated column properties
        properties.push(this.properties[0]);

        this.properties = properties;
        return node;
    },

    properties: [{
        name: "Option",
        key: "option1",
        inputtype: TextValueInput
    }, {
        name: "Option",
        key: "option2",
        inputtype: TextValueInput
    }, {
        name: "Option",
        key: "option3",
        inputtype: TextValueInput
    }, {
        name: "",
        key: "addChild",
        inputtype: ButtonInput,
        data: { text: "Add option" },
        onChange: function(node) {
            $(node).append('<option value="value">Text</option>');

            //render component properties again to include the new column inputs
            Vvveb.Components.render("html/selectinput");

            return node;
        }
    }]
});


// Vvveb.Components.add("choice-based/likert", {
//     name: "Likert",
//     attributes: { "type": "likert" },
//     image: "icons/tools/likert.svg",
//     html: '<div class="form-group" role="checkboxgroup" aria-labelledby="bulgy-checkbox-label">\
//                 <label for="" class="">Type your question here...</label>\
//                 <div class="form-group">\
//                     <label class="radio"><input type="radio"> Answer 1</label>\
//                     <label class="radio"><input type="radio"> Answer 2</label>\
//                     <label class="radio"><input type="radio"> Answer 3</label>\
//                 </div>\
//             </div>',
//     properties: [{
//         name: "Name",
//         key: "name",
//         htmlAttr: "name",
//         inputtype: TextInput
//     }]
// });


// Vvveb.Components.add("choice-based/opinion-scale", {
//     name: "Opinion scale",
//     attributes: { "type": "opinion-scale" },
//     image: "icons/tools/opinion-scale.svg",
//     html: '<div class="form-group">\
//                 <label for="" class="">Type your question here...</label>\
//                 <div class="form-group">\
//                     <div class="opinion-scale btn-group btn-group-lg">\
//                         <button type="button" class="btn btn-dark">1</button>\
//                         <button type="button" class="btn btn-dark">2</button>\
//                         <button type="button" class="btn btn-dark">3</button>\
//                         <button type="button" class="btn btn-dark">4</button>\
//                         <button type="button" class="btn btn-dark">5</button>\
//                     </div>\
//                     <div class="opinion-scale-text">\
//                     <span>Dissatisfied</span>\
//                     <span>Neutral</span>\
//                     <span>Satisfied</span>\
//                     </div>\
//                 </div>\
//             </div>',
//     properties: [{
//         name: "Name",
//         key: "name",
//         htmlAttr: "name",
//         inputtype: TextInput
//     }]
// });

Vvveb.Components.extend("_base", "choice-based/nps", {
    name: "NPS",
    attributes: { "type": "nps" },
    image: "icons/tools/nps.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="form-group">\
                    <div class="nps btn-group btn-group-lg">\
                        <button type="button" class="btn btn-primary">1</button>\
                        <button type="button" class="btn btn-primary">2</button>\
                        <button type="button" class="btn btn-primary">3</button>\
                        <button type="button" class="btn btn-primary">4</button>\
                        <button type="button" class="btn btn-primary">5</button>\
                        <button type="button" class="btn btn-primary">6</button>\
                        <button type="button" class="btn btn-primary">7</button>\
                        <button type="button" class="btn btn-primary">8</button>\
                        <button type="button" class="btn btn-primary">9</button>\
                        <button type="button" class="btn btn-primary">10</button>\
                    </div>\
                    <div class="nps-text">\
                        <span>Not at all likely</span>\
                        <span>Extremely likely</span>\
                    </div>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/rating", {
    name: "Rating",
    attributes: { "type": "rating" },
    image: "icons/tools/rating.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="rating">\
                    <input type="radio" name="star" id="star-1"><label for="star1">\
                    </label>\
                    <input type="radio" name="star" id="star-2"><label for="star2">\
                    </label>\
                    <input type="radio" name="star" id="star-3"><label for="star3">\
                    </label>\
                    <input type="radio" name="star" id="star-4"><label for="star4">\
                    </label>\
                    <input type="radio" name="star" id="star-5"><label for="star5">\
                    </label>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/sliders", {
    name: "Sliders",
    attributes: { "type": "text" },
    image: "icons/tools/sliders.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="range">\
                    <div class="sliderValue">\
                        <span>100</span>\
                    </div>\
                    <div class="field">\
                        <div class="value left">1</div>\
                        <input type="range" min="1" max="5" value="1" steps="1">\
                        <div class="value right">5</div>\
                    </div>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/emojis", {
    name: "Emojis",
    attributes: { "type": "emojis" },
    image: "icons/tools/emojis.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="emojis">\
                    <input type="radio" name="emojis" id="sad"><label for="sad">\
                    </label>\
                    <input type="radio" name="emojis" id="netural"><label for="netural">\
                    </label>\
                    <input type="radio" name="emojis" id="happy"><label for="happy">\
                    </label>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/thumbs", {
    name: "Thumbs",
    attributes: { "type": "thumbs" },
    image: "icons/tools/thumbs.svg",
    html: '<div class="form-group">\
                <label for="" class="">Type your question here...</label>\
                <div class="thumbs">\
                    <input type="radio" name="thumbs" id="dislike"><label for="dislike">\
                    </label>\
                    <input type="radio" name="thumbs" id="like"><label for="like">\
                    </label>\
                </div>\
            </div>',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "choice-based/button", {
    classes: ["btn", "btn-link"],
    name: "Button",
    image: "icons/tools/button.svg",
    html: '<div class="form-group d-flex align-items-center justify-content-center">\
                <button type="button" class="btn btn-primary">Submit</button>\
            </div>',
    properties: [{
        name: "Link To",
        key: "href",
        htmlAttr: "href",
        inputtype: LinkInput
    }, {
        name: "Type",
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-default", "btn-primary", "btn-info", "btn-success", "btn-warning", "btn-info", "btn-light", "btn-dark", "btn-outline-primary", "btn-outline-info", "btn-outline-success", "btn-outline-warning", "btn-outline-info", "btn-outline-light", "btn-outline-dark", "btn-link"],
        data: {
            options: [{
                value: "btn-default",
                text: "Default"
            }, {
                value: "btn-primary",
                text: "Primary"
            }, {
                value: "btn btn-info",
                text: "Info"
            }, {
                value: "btn-success",
                text: "Success"
            }, {
                value: "btn-warning",
                text: "Warning"
            }, {
                value: "btn-info",
                text: "Info"
            }, {
                value: "btn-light",
                text: "Light"
            }, {
                value: "btn-dark",
                text: "Dark"
            }, {
                value: "btn-outline-primary",
                text: "Primary outline"
            }, {
                value: "btn btn-outline-info",
                text: "Info outline"
            }, {
                value: "btn-outline-success",
                text: "Success outline"
            }, {
                value: "btn-outline-warning",
                text: "Warning outline"
            }, {
                value: "btn-outline-info",
                text: "Info outline"
            }, {
                value: "btn-outline-light",
                text: "Light outline"
            }, {
                value: "btn-outline-dark",
                text: "Dark outline"
            }, {
                value: "btn-link",
                text: "Link"
            }]
        }
    }, {
        name: "Size",
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-lg", "btn-sm"],
        data: {
            options: [{
                value: "",
                text: "Default"
            }, {
                value: "btn-lg",
                text: "Large"
            }, {
                value: "btn-sm",
                text: "Small"
            }]
        }
    }, {
        name: "Target",
        key: "target",
        htmlAttr: "target",
        inputtype: TextInput
    }]
});