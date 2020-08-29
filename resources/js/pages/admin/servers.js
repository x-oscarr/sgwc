/************************* Servers ************************/

// Update servers
$("#saveServers").click(function () {
    let thisButton = $(this);
    $(thisButton).html(buttonPreloader+" Saving...");
    $(thisButton)[0].classList.add("disabled");

    sendServers({
        "serversData": $("#serversForm").serializeArray()
    }).then(function (result) {
        //console.log(result);
        if(result.status) {
            $("#saveServers").html(buttonSuccess+" Saved");
            setTimeout(function () {
                $(thisButton)[0].classList.remove('disabled');
                $(thisButton).html("Save changes");
            }, 1000)
        }
    });
});

// Add new server
$("#submitNewServer").click(function () {
    let thisButton = $(this);
    $(thisButton).html(buttonPreloader+" Saving...");
    $(thisButton)[0].classList.add("disabled");
    sendServers({
        "addServerData": $("#addServerForm").serializeArray()
    }).then(function (result) {
        if(result.status) {
            $(thisButton).html(buttonSuccess+" Saved");
            location.reload();
        }
    });
});

// Delete server
$(".server-delete").click(function () {
    let thisButton = $(this);
    $(thisButton).html(buttonPreloader+" Deleting...");
    $(thisButton)[0].classList.add("disabled");
    sendServers({
        "deleteServer": thisButton.data('id')
    }).then(function (result) {
        if(result.status) {
            $(thisButton).html(buttonSuccess+" Deleted");
            location.reload();
        }
    });
});

// Enable/Disable plugin module
$(".pmEnable").change(function() {
    let pmId = $(this).data('id');
    let pmEnable = $(this).prop('checked');
    sendPModules({
        pmEnable: {'id': pmId, 'value': pmEnable ? 1:0}
    }).then(function (result) {
        if(result.status) {
            $('#pmStatus_'+pmId).html(pmEnable ? pmStatusEnable : pmStatusDisable)
        }
    })
});

//Get Plugin Modules Data
$(".pmSettings").click(function () {
   let pmId = $(this).data('id');
    getPModules({
        'id': pmId
    }).then(function (result) {
        if(result.status) {
            let pmData = result.pluginModule;
            $("#pmSettingsLabel").html(pmData.name);
            $("textarea[name='description']").val(pmData.description);
            $("select[name='plugin']").val(pmData.plugin);
            $("input[name='pmId']").val(pmData.id);
            $("input[name='server']").val(pmData.server_id);
            $("input[name='pmName']").val(pmData.name);
            $("input[name='dbHost']").val(pmData.db_host);
            $("input[name='dbPost']").val(pmData.db_port);
            $("input[name='dbUser']").val(pmData.db_username);
            $("input[name='dbPassword']").val(pmData.db_password);
            $("input[name='dbName']").val(pmData.db);
        }
    })
});

// Update plugin modules
$("#submitPmSetting").click(function () {
    let thisButton = $(this);
    $(thisButton).html(buttonPreloader+" Saving...");
    $(thisButton)[0].classList.add("disabled");
    sendPModules({
        "pmDataUpdate": $("#pmFormUpdate").serializeArray()
    }).then(function (result) {
        if(result.status) {
            $(thisButton).html(buttonSuccess+" Saved");
            setTimeout(function () {
                $(thisButton)[0].classList.remove('disabled');
                $(thisButton).remove();
            }, 1000)
        }
    });
});



function sendServers(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routeServersUpdate,
            // dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}

function getPModules(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routePModuleGet,
            //dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}

function sendPModules(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routePModuleUpdate,
            //dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}
