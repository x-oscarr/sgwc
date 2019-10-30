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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/settings.js":
/*!****************************************!*\
  !*** ./resources/js/admin/settings.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Inputs
$("input[name='pTitle'], input[name='gTitle'], input[name='projectName']").change(function () {
  //console.log(this.value);
  sendSettings({
    "settingsData": $(this).serializeArray()
  }).then(function (result) {
    if (result.status) {}
  });
}); // Display menu item form

$(".task").click(function () {
  $('#menuItemText').hide();
  $('#updateItemForm').hide();
  $('#menuItemLoader').show();
  var menuItemId = $(this).data("id");
  $.ajax({
    type: "POST",
    url: routeGetMenuItem,
    // dataType: 'json',
    data: {
      id: menuItemId
    },
    success: function success(response) {
      var menuItem = response.menuItem;
      var childItem = response.childMenuItem; // parent Item

      $("#menuItemForm select[name='siteModule']").val(menuItem.site_module_id);
      $("#menuItemForm select[name='access']").val(menuItem.access);
      $("input[name='itemId']").val(menuItem.id);
      $("input[name='text']").val(menuItem.text);
      $("input[name='accessParams']").val(menuItem.access_params);
      $("input[name='route']").val(menuItem.route);
      $("input[name='routeParams']").val(menuItem.route_params); //child Item

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
    error: function error(response) {
      console.log(response);
    }
  });
}); // Save item

$("#saveItem").click(function () {
  var thisButton = $(this);
  $(thisButton).html(buttonPreloader + " Saving..."); //console.log($(this));

  $(thisButton)[0].classList.add("disabled");
  var itemsPosition = updatePositionItems();
  sendItemData({
    "itemData": $("#menuItemForm").serializeArray(),
    "itemsPosition": itemsPosition
  }).then(function (result) {
    if (result.status) {
      $("#saveItem").html(buttonSuccess + " Saved");
      setTimeout(function () {
        $(thisButton)[0].classList.remove('disabled');
        $(thisButton).html("Save changes");
      }, 1000); //location.reload();
    }
  });
}); // Add item

$("#submitItem").click(function () {
  $('#submitItem').hide();
  var itemForm = $("#addItemForm").serializeArray();
  $('#modalAddItemBody').html(modalPreloader);
  sendItemData({
    "newItemData": itemForm
  }).then(function (result) {
    if (result.status) {
      $('#modalAddItemBody').html(modalCreateItemText);
      setTimeout(function () {
        location.reload();
      }, 1500);
    }
  });
}); // Add Child Item

$("#submitChildItem").click(function () {
  $('#submitChildItem').hide();
  var itemChildForm = $("#addChildItemForm").serializeArray();
  $('#modalAddChildItemBody').html(modalPreloader);
  sendItemData({
    "itemChildData": itemChildForm
  }).then(function (result) {
    if (result.status) {
      $('#modalAddChildItemBody').html(modalCreateItemText);
      setTimeout(function () {
        location.reload();
      }, 1500);
    }
  });
}); // Delete Item

$("#menuItemDelete").click(function () {
  sendItemData({
    "itemDelete": $("#menuItemForm").serializeArray()
  }).then(function (result) {
    if (result.status) {
      location.reload();
    }
  });
}); // Delete child

$("#childItemDelete").click(function () {
  sendItemData({
    "childItemDelete": $("#menuItemForm").serializeArray()
  }).then(function (result) {
    if (result.status) {
      location.reload();
    }
  });
});

function sendItemData(data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: routeUpdateMenuItem,
      // dataType: 'json',
      data: data,
      success: resolve,
      error: reject
    });
  });
}

function updatePositionItems() {
  var menuItem = $('.task');
  menuItemsPosition = [];

  for (var i = 0; i < menuItem.length; i++) {
    //console.log('position = '+i+'; id = '+$(menuItem[i-1]).data('id'));
    menuItemsPosition.push({
      "id": $(menuItem[i]).data('id'),
      "position": i + 1
    });
  }

  return menuItemsPosition;
}

function sendSettings(data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: routeUpdateSettings,
      // dataType: 'json',
      data: data,
      success: resolve,
      error: reject
    });
  });
}

/***/ }),

/***/ "./resources/sass/animations.scss":
/*!****************************************!*\
  !*** ./resources/sass/animations.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*******************************************************************************!*\
  !*** multi ./resources/js/admin/settings.js ./resources/sass/animations.scss ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/oscarr/Documents/sgwc/resources/js/admin/settings.js */"./resources/js/admin/settings.js");
module.exports = __webpack_require__(/*! /Users/oscarr/Documents/sgwc/resources/sass/animations.scss */"./resources/sass/animations.scss");


/***/ })

/******/ });