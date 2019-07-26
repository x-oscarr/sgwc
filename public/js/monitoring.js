function Monitor_DoRequest(address, port, timeout, engine, type, when)
{
	return $.ajax({
		async:    true,
		cache:    false,
		success:  when,
		method:   'GET',
		timeout:  5000,
		url:      MONITOR_BASE_URL,
		data: {
			address:  address,
			port:     port,
			timeout:  timeout,
			engine:   engine,
			type:     type
		}
	});
}

function Monitor_GetInfo(address, port, timeout, engine, when)
{
	return Monitor_DoRequest(address, port, timeout, engine, 0, when);
}

function Monitor_GetPlayers(address, port, timeout, engine, when)
{
	return Monitor_DoRequest(address, port, timeout, engine, 1, when);
}

function Monitor_GetRules(address, port, timeout, engine, when)
{
	return Monitor_DoRequest(address, port, timeout, engine, 2, when);
}

Monitor_GetInfo(MONITOR_SERVER_ADDERS, MONITOR_SERVER_PORT, 1, MONITOR_SERVER_ENGINE, function(data, textStatus, jqXHR)
{
	if (data.success)
	{
		$('#_serverOnline')[0].innerHTML = data.data.Players + "<i>/</i>" + data.data.MaxPlayers;
	}

	else
	{
		$('#_serverOnline')[0].innerHTML = "Неизвестно";
	}
});