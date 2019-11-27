// Enable/Disable plugin module
$(".smEnable").change(function() {
    let pmId = $(this).data('id');
    let smEnable = $(this).prop('checked');
    sendSModules({
        smEnable: {'id': pmId, 'value': smEnable ? 1:0}
    }).then(function (result) {
        if(result.status) {
            $('#pmStatus_'+pmId).html(smEnable ? smStatusEnable : smStatusDisable)
        }
    })
});

function sendSModules(data) {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: routeSModuleUpdate,
            //dataType: 'json',
            data: data,
            success: resolve,
            error: reject,
        });
    }));
}
