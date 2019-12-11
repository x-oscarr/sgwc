slider('.slides');

$(document).ready(function () {
    monitoringCharts = setMonitoring();
    updateMonitoring(monitoringServers, monitoringCharts);

});

function setMonitoring() {
    let serverBlocks = $(".server-block");
    let monitoringCharts = [];

    serverBlocks.each(function () {
        serverId = $(this).data('id');
        if(serverId) {
            monitoringCharts[serverId] = new DonutChart(`.server-block[data-id='${serverId}']`, `#server-info${serverId}`);
            monitoringCharts[serverId].builder($(this).data('description'));
        }
    });
    return monitoringCharts;
}

function updateMonitoring(monitoringServers, monitoringCharts) {
    monitoringServers.forEach((server) => {
        const { id, info } = server;
        if(info) {
            monitoringCharts[id].update(info);
        }
        else {
            monitoringCharts[id].update(false);
        }
    });
}

function updateMonitoringAjax(monitoringCharts) {
    getMonitoringData().then(function (result) {
        let monitoringServers = result.monitoringServers;
        if(result.status) {
            updateMonitoring(monitoringServers, monitoringCharts);
        }
    });
}

function getMonitoringData() {
    return (new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: monitoringURL,
            success: resolve,
            error: reject,
        });
    }));
}
