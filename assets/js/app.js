// app.js

const $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    var $collectionHolder, $collectionAddressHolder;

    // setup an "add a tag" link
    var $addTagButton = $('<button type="button" class="add_phone_link">Add a phone</button>');
    var $addTagAdderssButton = $('<button type="button" class="add_address_link">Add an address</button>');
    var $newLinkLi = $('<li></li>').append($addTagButton);
    var $newAddressLinkLi = $('<li></li>').append($addTagAdderssButton);

    function addTagForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);
    }

    // Get the ul that holds the collection of tags
    $collectionHolder = $('#account_contact_phones');
    $collectionHolder = $( "div[id$='contact_phones']" );
    console.log($collectionHolder);

    $collectionAddressHolder = $('#account_contact_addresses');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    $collectionAddressHolder.append($newAddressLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $collectionAddressHolder.data('index', $collectionAddressHolder.find(':input').length);

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });

    $addTagAdderssButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionAddressHolder, $newAddressLinkLi);
    });
});