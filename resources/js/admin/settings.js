// Inputs
$("input[name='pTitle'], input[name='gTitle'], input[name='projectName']").change(function () {
    //console.log(this.value);
    sendSettings({
        "settingsData": $(this).serializeArray()
    }).then(function (result) {
        if(result.status) {

        }
    });
});

// Display menu item form
$(".task").click(function () {
    $('#menuItemText').hide();
    $('#updateItemForm').hide();
    $('#menuItemLoader').show();

    let menuItemId = $(this).data("id");

    $.ajax({
        type: "POST",
        url: routeGetMenuItem,
        // dataType: 'json',
        data: {id: menuItemId},
        success: function (response) {

            let menuItem = response.menuItem;
            let childItem = response.childMenuItem;

            // parent Item
            $("#menuItemForm select[name='siteModule']").val(menuItem.site_module_id);
            $("#menuItemForm select[name='access']").val(menuItem.access);
            $("input[name='itemId']").val(menuItem.id);
            $("input[name='text']").val(menuItem.text);
            $("input[name='accessParams']").val(menuItem.access_params);
            $("input[name='route']").val(menuItem.route);
            $("input[name='routeParams']").val(menuItem.route_params);

            //child Item
            if (childItem) {
                $("input[name='itemChild']").val(true);
                $("input[name='childText']").val(childItem.text);
                $("input[name='childRoute']").val(childItem.route);
                $("input[name='childRouteParams']").val(childItem.route_params);

                $("#childItemForm").show();
                $("#childItemText").hide();
            } else {
                $("input[name='itemChild']").val(false);
                $("input[name='newChildItemParentId']").val(menuItem.id);
                $("#parentItemId").html(menuItem.text);

                $("#childItemText").show();
                $("#childItemForm").hide();
            }

            $('#menuItemLoader').hide();
            $('#updateItemForm').show();
        },
        error: function (response) {
            console.log(response);
        }
    });
});

// Save item
$("#saveItem").click(function () {
    let thisButton = $(this);
    $(thisButton).html(buttonPreloader+" Saving...");
    //console.log($(this));
    $(thisButton)[0].classList.add("disabled");
    let itemsPosition = updatePositionItems();
    sendItemData({
        "itemData": $("#menuItemForm").serializeArray(),
        "itemsPosition": itemsPosition
    }).then(function (result) {
        if(result.status) {
            $("#saveItem").html(buttonSuccess+" Saved");
            setTimeout(function () {
                $(thisButton)[0].classList.remove('disabled');
                $(thisButton).html("Save changes");
            }, 1000)
            //location.reload();
        }
    });
});

// Add item
$("#submitItem").click(function () {
    $('#submitItem').hide();
    let itemForm = $("#addItemForm").serializeArray();
    $('#modalAddItemBody').html(modalPreloader);
    sendItemData({
        "newItemData": itemForm
    }).then(function (result) {
        if(result.status) {
            $('#modalAddItemBody').html(modalCreateItemText);
            setTimeout(function() {
                    location.reload();
                }, 1500
            );
        }
    });

});

// Add Child Item
$("#submitChildItem").click(function () {
    $('#submitChildItem').hide();
    let itemChildForm = $("#addChildItemForm").serializeArray();
    $('#modalAddChildItemBody').html(modalPreloader);
    sendItemData({
        "itemChildData": itemChildForm
    }).then(function (result) {
        if(result.status) {
            $('#modalAddChildItemBody').html(modalCreateItemText);
            setTimeout(function () {
                    location.reload();
                }, 1500
            );
        }
    });

});

// Delete Item
$("#menuItemDelete").click(function () {
    sendItemData({
        "itemDelete": $("#menuItemForm").serializeArray()
    }).then(function (result) {
        if(result.status) {
            location.reload();
        }
    });
});

// Delete child
$("#childItemDelete").click(function () {
    sendItemData({
        "childItemDelete": $("#menuItemForm").serializeArray()
    }).then(function (result) {
        if(result.status) {
            location.reload();
        }
    });
});


function sendItemData(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routeUpdateMenuItem,
            // dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}

function updatePositionItems() {
    let menuItem = $('.task');
    menuItemsPosition = [];
    for (let i = 0; i < menuItem.length; i++) {
        //console.log('position = '+i+'; id = '+$(menuItem[i-1]).data('id'));
        menuItemsPosition.push({
            "id": $(menuItem[i]).data('id'),
            "position": i + 1
        });
    }
    return menuItemsPosition;
}

function sendSettings(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routeUpdateSettings,
            // dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}
