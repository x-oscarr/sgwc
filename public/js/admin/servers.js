/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/admin/servers.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/admin/servers.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/************************* Servers ************************/
// Update servers
$("#saveServers").click(function () {
  var thisButton = $(this);
  $(thisButton).html(buttonPreloader + " Saving...");
  $(thisButton)[0].classList.add("disabled");
  sendServers({
    "serversData": $("#serversForm").serializeArray()
  }).then(function (result) {
    //console.log(result);
    if (result.status) {
      $("#saveServers").html(buttonSuccess + " Saved");
      setTimeout(function () {
        $(thisButton)[0].classList.remove('disabled');
        $(thisButton).html("Save changes");
      }, 1000);
    }
  });
}); // Add new server

$("#submitNewServer").click(function () {
  var thisButton = $(this);
  $(thisButton).html(buttonPreloader + " Saving...");
  $(thisButton)[0].classList.add("disabled");
  sendServers({
    "addServerData": $("#addServerForm").serializeArray()
  }).then(function (result) {
    if (result.status) {
      $(thisButton).html(buttonSuccess + " Saved");
      location.reload();
    }
  });
}); // Delete server

$(".server-delete").click(function () {
  var thisButton = $(this);
  $(thisButton).html(buttonPreloader + " Deleting...");
  $(thisButton)[0].classList.add("disabled");
  sendServers({
    "deleteServer": thisButton.data('id')
  }).then(function (result) {
    if (result.status) {
      $(thisButton).html(buttonSuccess + " Deleted");
      location.reload();
    }
  });
}); // Enable/Disable plugin module

$(".pmEnable").change(function () {
  var pmId = $(this).data('id');
  var pmEnable = $(this).prop('checked');
  sendPModules({
    pmEnable: {
      'id': pmId,
      'value': pmEnable ? 1 : 0
    }
  }).then(function (result) {
    if (result.status) {
      $('#pmStatus_' + pmId).html(pmEnable ? pmStatusEnable : pmStatusDisable);
    }
  });
}); //Get Plugin Modules Data

$(".pmSettings").click(function () {
  var pmId = $(this).data('id');
  getPModules({
    'id': pmId
  }).then(function (result) {
    if (result.status) {
      var pmData = result.pluginModule;
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
  });
}); // Update plugin modules

$("#submitPmSetting").click(function () {
  var thisButton = $(this);
  $(thisButton).html(buttonPreloader + " Saving...");
  $(thisButton)[0].classList.add("disabled");
  sendPModules({
    "pmDataUpdate": $("#pmFormUpdate").serializeArray()
  }).then(function (result) {
    if (result.status) {
      $(thisButton).html(buttonSuccess + " Saved");
      setTimeout(function () {
        $(thisButton)[0].classList.remove('disabled');
        $(thisButton).remove();
      }, 1000);
    }
  });
});

function sendServers(data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: routeServersUpdate,
      // dataType: 'json',
      data: data,
      success: resolve,
      error: reject
    });
  });
}

function getPModules(data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: routePModuleGet,
      //dataType: 'json',
      data: data,
      success: resolve,
      error: reject
    });
  });
}

function sendPModules(data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: routePModuleUpdate,
      //dataType: 'json',
      data: data,
      success: resolve,
      error: reject
    });
  });
}

/***/ }),

/***/ 2:
/*!***************************************************!*\
  !*** multi ./resources/js/pages/admin/servers.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/oscarr/Documents/sgwc/resources/js/pages/admin/servers.js */"./resources/js/pages/admin/servers.js");


/***/ })

/******/ });