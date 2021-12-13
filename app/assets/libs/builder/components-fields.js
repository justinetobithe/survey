Vvveb.ComponentsGroup['Fields'] = ["fields/page-break", "fields/welcomepage", "fields/branding", "fields/section-break", "fields/thankyoupage", "fields/whitelabel"];



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


Vvveb.Components.extend("_base", "fields/page-break", {
    name: "Page break",
    attributes: ["data-component-page-break"],
    image: "icons/tools/page-break.svg",
    html: ''
});


Vvveb.Components.extend("_base", "fields/section-break", {
    name: "Section break",
    attributes: ["data-component-section-break"],
    image: "icons/tools/section-break.svg",
    html: '',
    properties: [{
        name: "Name",
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "fields/welcomepage", {
    classes: ["jumbotron"],
    image: "icons/jumbotron.svg",
    name: "Welcome page",
    html: '<div class="jumbotron">\
		  <h1 class="display-3">Type your welcome title</h1>\
		  <p class="lead">Add a description</p>\
		  <p class="lead">\
			<a class="btn btn-lg btn-success" href="#" role="button">Type &lsquo;Start&lsquo; button label</a>\
		  </p>\
		</div>'
});


Vvveb.Components.extend("_base", "fields/thankyoupage", {
    name: "Thank you page",
    attributes: ["data-component-thankyoupage"],
    image: "icons/tools/thank-you-page.svg",
    html: ''
});

Vvveb.Components.extend("_base", "fields/whitelabel", {
    name: "White label",
    attributes: ["data-component-whitelabel"],
    image: "icons/tools/white-label.svg",
    html: ''
});

Vvveb.Components.extend("_base", "fields/branding", {
    name: "Branding",
    attributes: ["data-component-branding"],
    image: "icons/tools/branding.svg",
    html: ''
});