window["admin"] =
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "../../../../../admin-dev/themes/new-theme/js/components/country-state-selection-toggler.js":
/*!*****************************************************************************************************!*\
  !*** /opt/lampp/htdocs/admin-dev/themes/new-theme/js/components/country-state-selection-toggler.js ***!
  \*****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var $ = window.$;
/**
 * Displays, fills or hides State selection block depending on selected country.
 *
 * Usage:
 *
 * <!-- Country select must have unique identifier & url for states API -->
 * <select name="id_country" id="id_country" states-url="path/to/states/api">
 *   ...
 * </select>
 *
 * <!-- If selected country does not have states, then this block will be hidden -->
 * <div class="js-state-selection-block">
 *   <select name="id_state">
 *     ...
 *   </select>
 * </div>
 *
 * In JS:
 *
 * new CountryStateSelectionToggler('#id_country', '#id_state', '.js-state-selection-block');
 */

var CountryStateSelectionToggler = /*#__PURE__*/function () {
  function CountryStateSelectionToggler(countryInputSelector, countryStateSelector, stateSelectionBlockSelector) {
    var _this2 = this;

    _classCallCheck(this, CountryStateSelectionToggler);

    this.$stateSelectionBlock = $(stateSelectionBlockSelector);
    this.$countryStateSelector = $(countryStateSelector);
    this.$countryInput = $(countryInputSelector);
    this.$countryInput.on('change', function () {
      return _this2._toggle();
    }); // toggle on page load

    this._toggle(true);

    return {};
  }
  /**
   * Toggles State selection
   *
   * @private
   */


  _createClass(CountryStateSelectionToggler, [{
    key: "_toggle",
    value: function _toggle() {
      var _this3 = this;

      var isFirstToggle = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      $.ajax({
        url: this.$countryInput.data('states-url'),
        method: 'GET',
        dataType: 'json',
        data: {
          id_country: this.$countryInput.val()
        }
      }).then(function (response) {
        if (response.states.length === 0) {
          _this3.$stateSelectionBlock.fadeOut();

          return;
        }

        _this3.$stateSelectionBlock.fadeIn();

        if (isFirstToggle === false) {
          _this3.$countryStateSelector.empty();

          var _this = _this3;
          $.each(response.states, function (index, value) {
            _this.$countryStateSelector.append($('<option></option>').attr('value', value).text(index));
          });
        }
      })["catch"](function (response) {
        if (typeof response.responseJSON !== 'undefined') {
          showErrorMessage(response.responseJSON.message);
        }
      });
    }
  }]);

  return CountryStateSelectionToggler;
}();

exports["default"] = CountryStateSelectionToggler;

/***/ }),

/***/ "../../../../../admin-dev/themes/new-theme/js/components/grid/extension/action/row/submit-row-action-extension.js":
/*!***************************************************************************************************************************!*\
  !*** /opt/lampp/htdocs/admin-dev/themes/new-theme/js/components/grid/extension/action/row/submit-row-action-extension.js ***!
  \***************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var $ = window.$;
/**
 * Class SubmitRowActionExtension handles submitting of row action
 */

var SubmitRowActionExtension = /*#__PURE__*/function () {
  function SubmitRowActionExtension() {
    _classCallCheck(this, SubmitRowActionExtension);
  }

  _createClass(SubmitRowActionExtension, [{
    key: "extend",
    value:
    /**
     * Extend grid
     *
     * @param {Grid} grid
     */
    function extend(grid) {
      grid.getContainer().on('click', '.js-submit-row-action', function (event) {
        event.preventDefault();
        var $button = $(event.currentTarget);
        var confirmMessage = $button.data('confirm-message');

        if (confirmMessage.length && !confirm(confirmMessage)) {
          return;
        }

        var method = $button.data('method');
        var isGetOrPostMethod = ['GET', 'POST'].includes(method);
        var $form = $('<form>', {
          'action': $button.data('url'),
          'method': isGetOrPostMethod ? method : 'POST'
        }).appendTo('body');

        if (!isGetOrPostMethod) {
          $form.append($('<input>', {
            'type': '_hidden',
            'name': '_method',
            'value': method
          }));
        }

        $form.submit();
      });
    }
  }]);

  return SubmitRowActionExtension;
}();

exports["default"] = SubmitRowActionExtension;

/***/ }),

/***/ "../../../../../admin-dev/themes/new-theme/js/components/grid/extension/link-row-action-extension.js":
/*!**************************************************************************************************************!*\
  !*** /opt/lampp/htdocs/admin-dev/themes/new-theme/js/components/grid/extension/link-row-action-extension.js ***!
  \**************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var $ = window.$;
/**
 * Class LinkRowActionExtension handles link row actions
 */

var LinkRowActionExtension = /*#__PURE__*/function () {
  function LinkRowActionExtension() {
    _classCallCheck(this, LinkRowActionExtension);
  }

  _createClass(LinkRowActionExtension, [{
    key: "extend",
    value:
    /**
     * Extend grid
     *
     * @param {Grid} grid
     */
    function extend(grid) {
      this.initRowLinks(grid);
      this.initConfirmableActions(grid);
    }
    /**
     * Extend grid
     *
     * @param {Grid} grid
     */

  }, {
    key: "initConfirmableActions",
    value: function initConfirmableActions(grid) {
      grid.getContainer().on('click', '.js-link-row-action', function (event) {
        var confirmMessage = $(event.currentTarget).data('confirm-message');

        if (confirmMessage.length && !confirm(confirmMessage)) {
          event.preventDefault();
        }
      });
    }
    /**
     * Add a click event on rows that matches the first link action (if present)
     *
     * @param {Grid} grid
     */

  }, {
    key: "initRowLinks",
    value: function initRowLinks(grid) {
      $('tr', grid.getContainer()).each(function initEachRow() {
        var $parentRow = $(this);
        $('.js-link-row-action[data-clickable-row=1]:first', $parentRow).each(function propagateFirstLinkAction() {
          var $rowAction = $(this);
          var $parentCell = $rowAction.closest('td');
          /*
           * Only search for cells with non clickable contents to avoid conflicts with
           * previous cell behaviour (action, toggle, ...)
           */

          var clickableCells = $('td.data-type, td.identifier-type:not(:has(input)), td.badge-type, td.position-type', $parentRow).not($parentCell);
          clickableCells.addClass('cursor-pointer').click(function () {
            var confirmMessage = $rowAction.data('confirm-message');

            if (!confirmMessage.length || confirm(confirmMessage)) {
              document.location = $rowAction.attr('href');
            }
          });
        });
      });
    }
  }]);

  return LinkRowActionExtension;
}();

exports["default"] = LinkRowActionExtension;

/***/ }),

/***/ "../../../../../admin-dev/themes/new-theme/js/components/grid/grid.js":
/*!*******************************************************************************!*\
  !*** /opt/lampp/htdocs/admin-dev/themes/new-theme/js/components/grid/grid.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var $ = window.$;
/**
 * Class is responsible for handling Grid events
 */

var Grid = /*#__PURE__*/function () {
  /**
   * Grid id
   *
   * @param {string} id
   */
  function Grid(id) {
    _classCallCheck(this, Grid);

    this.id = id;
    this.$container = $('#' + this.id + '_grid');
  }
  /**
   * Get grid id
   *
   * @returns {string}
   */


  _createClass(Grid, [{
    key: "getId",
    value: function getId() {
      return this.id;
    }
    /**
     * Get grid container
     *
     * @returns {jQuery}
     */

  }, {
    key: "getContainer",
    value: function getContainer() {
      return this.$container;
    }
    /**
     * Get grid header container
     *
     * @returns {jQuery}
     */

  }, {
    key: "getHeaderContainer",
    value: function getHeaderContainer() {
      return this.$container.closest('.js-grid-panel').find('.js-grid-header');
    }
    /**
     * Extend grid with external extensions
     *
     * @param {object} extension
     */

  }, {
    key: "addExtension",
    value: function addExtension(extension) {
      extension.extend(this);
    }
  }]);

  return Grid;
}();

exports["default"] = Grid;

/***/ }),

/***/ "./admin/grid.js":
/*!***********************!*\
  !*** ./admin/grid.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _grid = _interopRequireDefault(__webpack_require__(/*! ../../../../../../admin-dev/themes/new-theme/js/components/grid/grid */ "../../../../../admin-dev/themes/new-theme/js/components/grid/grid.js"));

var _linkRowActionExtension = _interopRequireDefault(__webpack_require__(/*! ../../../../../../admin-dev/themes/new-theme/js/components/grid/extension/link-row-action-extension */ "../../../../../admin-dev/themes/new-theme/js/components/grid/extension/link-row-action-extension.js"));

var _submitRowActionExtension = _interopRequireDefault(__webpack_require__(/*! ../../../../../../admin-dev/themes/new-theme/js/components/grid/extension/action/row/submit-row-action-extension */ "../../../../../admin-dev/themes/new-theme/js/components/grid/extension/action/row/submit-row-action-extension.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var $ = window.$;
$(function () {
  var gridDivs = Array.from(document.querySelectorAll('.js-grid'));
  gridDivs.forEach(function (gridDiv) {
    var grid = new _grid["default"](gridDiv.dataset.gridId);
    grid.addExtension(new _linkRowActionExtension["default"]());
    grid.addExtension(new _submitRowActionExtension["default"]());
  });
});

/***/ }),

/***/ "./admin/retailer-form.js":
/*!********************************!*\
  !*** ./admin/retailer-form.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _countryStateSelectionToggler = _interopRequireDefault(__webpack_require__(/*! ../../../../../../admin-dev/themes/new-theme/js/components/country-state-selection-toggler */ "../../../../../admin-dev/themes/new-theme/js/components/country-state-selection-toggler.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var $ = window.$;
$(document).ready(function () {
  new _countryStateSelectionToggler["default"]('#retailer_id_country', '#retailer_id_state', '.js-retailer-state');
});

/***/ }),

/***/ 0:
/*!************************************************!*\
  !*** multi ./admin/grid ./admin/retailer-form ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./admin/grid */"./admin/grid.js");
module.exports = __webpack_require__(/*! ./admin/retailer-form */"./admin/retailer-form.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9bbmFtZV0vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vW25hbWVdLy9vcHQvbGFtcHAvaHRkb2NzL2FkbWluLWRldi90aGVtZXMvbmV3LXRoZW1lL2pzL2NvbXBvbmVudHMvY291bnRyeS1zdGF0ZS1zZWxlY3Rpb24tdG9nZ2xlci5qcyIsIndlYnBhY2s6Ly9bbmFtZV0vL29wdC9sYW1wcC9odGRvY3MvYWRtaW4tZGV2L3RoZW1lcy9uZXctdGhlbWUvanMvY29tcG9uZW50cy9ncmlkL2V4dGVuc2lvbi9hY3Rpb24vcm93L3N1Ym1pdC1yb3ctYWN0aW9uLWV4dGVuc2lvbi5qcyIsIndlYnBhY2s6Ly9bbmFtZV0vL29wdC9sYW1wcC9odGRvY3MvYWRtaW4tZGV2L3RoZW1lcy9uZXctdGhlbWUvanMvY29tcG9uZW50cy9ncmlkL2V4dGVuc2lvbi9saW5rLXJvdy1hY3Rpb24tZXh0ZW5zaW9uLmpzIiwid2VicGFjazovL1tuYW1lXS8vb3B0L2xhbXBwL2h0ZG9jcy9hZG1pbi1kZXYvdGhlbWVzL25ldy10aGVtZS9qcy9jb21wb25lbnRzL2dyaWQvZ3JpZC5qcyIsIndlYnBhY2s6Ly9bbmFtZV0vLi9hZG1pbi9ncmlkLmpzIiwid2VicGFjazovL1tuYW1lXS8uL2FkbWluL3JldGFpbGVyLWZvcm0uanMiXSwibmFtZXMiOlsiJCIsIndpbmRvdyIsIkNvdW50cnlTdGF0ZVNlbGVjdGlvblRvZ2dsZXIiLCJjb3VudHJ5SW5wdXRTZWxlY3RvciIsImNvdW50cnlTdGF0ZVNlbGVjdG9yIiwic3RhdGVTZWxlY3Rpb25CbG9ja1NlbGVjdG9yIiwiJHN0YXRlU2VsZWN0aW9uQmxvY2siLCIkY291bnRyeVN0YXRlU2VsZWN0b3IiLCIkY291bnRyeUlucHV0Iiwib24iLCJfdG9nZ2xlIiwiaXNGaXJzdFRvZ2dsZSIsImFqYXgiLCJ1cmwiLCJkYXRhIiwibWV0aG9kIiwiZGF0YVR5cGUiLCJpZF9jb3VudHJ5IiwidmFsIiwidGhlbiIsInJlc3BvbnNlIiwic3RhdGVzIiwibGVuZ3RoIiwiZmFkZU91dCIsImZhZGVJbiIsImVtcHR5IiwiX3RoaXMiLCJlYWNoIiwiaW5kZXgiLCJ2YWx1ZSIsImFwcGVuZCIsImF0dHIiLCJ0ZXh0IiwicmVzcG9uc2VKU09OIiwic2hvd0Vycm9yTWVzc2FnZSIsIm1lc3NhZ2UiLCJTdWJtaXRSb3dBY3Rpb25FeHRlbnNpb24iLCJncmlkIiwiZ2V0Q29udGFpbmVyIiwiZXZlbnQiLCJwcmV2ZW50RGVmYXVsdCIsIiRidXR0b24iLCJjdXJyZW50VGFyZ2V0IiwiY29uZmlybU1lc3NhZ2UiLCJjb25maXJtIiwiaXNHZXRPclBvc3RNZXRob2QiLCJpbmNsdWRlcyIsIiRmb3JtIiwiYXBwZW5kVG8iLCJzdWJtaXQiLCJMaW5rUm93QWN0aW9uRXh0ZW5zaW9uIiwiaW5pdFJvd0xpbmtzIiwiaW5pdENvbmZpcm1hYmxlQWN0aW9ucyIsImluaXRFYWNoUm93IiwiJHBhcmVudFJvdyIsInByb3BhZ2F0ZUZpcnN0TGlua0FjdGlvbiIsIiRyb3dBY3Rpb24iLCIkcGFyZW50Q2VsbCIsImNsb3Nlc3QiLCJjbGlja2FibGVDZWxscyIsIm5vdCIsImFkZENsYXNzIiwiY2xpY2siLCJkb2N1bWVudCIsImxvY2F0aW9uIiwiR3JpZCIsImlkIiwiJGNvbnRhaW5lciIsImZpbmQiLCJleHRlbnNpb24iLCJleHRlbmQiLCJncmlkRGl2cyIsIkFycmF5IiwiZnJvbSIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJmb3JFYWNoIiwiZ3JpZERpdiIsImRhdGFzZXQiLCJncmlkSWQiLCJhZGRFeHRlbnNpb24iLCJyZWFkeSJdLCJtYXBwaW5ncyI6Ijs7UUFBQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTs7O1FBR0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLDBDQUEwQyxnQ0FBZ0M7UUFDMUU7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MUIsUUFBTXZDLElBQUksR0FBRyxJQUFJNEIsZ0JBQUosQ0FBU1csT0FBTyxDQUFDQyxPQUFSLENBQWdCQyxNQUF6QixDQUFiO0FBQ0F6QyxRQUFJLENBQUMwQyxZQUFMLENBQWtCLElBQUk3QixrQ0FBSixFQUFsQjtBQUNBYixRQUFJLENBQUMwQyxZQUFMLENBQWtCLElBQUkzQyxvQ0FBSixFQUFsQjtBQUNELEdBSkQ7QUFLRCxDQVBBLENBQUQsQzs7Ozs7Ozs7Ozs7Ozs7QUNOQTs7OztBQUVBLElBQU1wQyxDQUFDLEdBQUdDLE1BQU0sQ0FBQ0QsQ0FBakI7QUFFQUEsQ0FBQyxDQUFDK0QsUUFBRCxDQUFELENBQVlpQixLQUFaLENBQWtCLFlBQVk7QUFDNUIsTUFBSTlFLHdDQUFKLENBQWlDLHNCQUFqQyxFQUF5RCxvQkFBekQsRUFBK0Usb0JBQS9FO0FBQ0QsQ0FGRCxFIiwiZmlsZSI6ImFkbWluLmJ1bmRsZS5qcyIsInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiXCI7XG5cblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSAwKTtcbiIsIi8qKlxuICogMjAwNy0yMDE5IFByZXN0YVNob3AgYW5kIENvbnRyaWJ1dG9yc1xuICpcbiAqIE5PVElDRSBPRiBMSUNFTlNFXG4gKlxuICogVGhpcyBzb3VyY2UgZmlsZSBpcyBzdWJqZWN0IHRvIHRoZSBPcGVuIFNvZnR3YXJlIExpY2Vuc2UgKE9TTCAzLjApXG4gKiB0aGF0IGlzIGJ1bmRsZWQgd2l0aCB0aGlzIHBhY2thZ2UgaW4gdGhlIGZpbGUgTElDRU5TRS50eHQuXG4gKiBJdCBpcyBhbHNvIGF2YWlsYWJsZSB0aHJvdWdoIHRoZSB3b3JsZC13aWRlLXdlYiBhdCB0aGlzIFVSTDpcbiAqIGh0dHBzOi8vb3BlbnNvdXJjZS5vcmcvbGljZW5zZXMvT1NMLTMuMFxuICogSWYgeW91IGRpZCBub3QgcmVjZWl2ZSBhIGNvcHkgb2YgdGhlIGxpY2Vuc2UgYW5kIGFyZSB1bmFibGUgdG9cbiAqIG9idGFpbiBpdCB0aHJvdWdoIHRoZSB3b3JsZC13aWRlLXdlYiwgcGxlYXNlIHNlbmQgYW4gZW1haWxcbiAqIHRvIGxpY2Vuc2VAcHJlc3Rhc2hvcC5jb20gc28gd2UgY2FuIHNlbmQgeW91IGEgY29weSBpbW1lZGlhdGVseS5cbiAqXG4gKiBESVNDTEFJTUVSXG4gKlxuICogRG8gbm90IGVkaXQgb3IgYWRkIHRvIHRoaXMgZmlsZSBpZiB5b3Ugd2lzaCB0byB1cGdyYWRlIFByZXN0YVNob3AgdG8gbmV3ZXJcbiAqIHZlcnNpb25zIGluIHRoZSBmdXR1cmUuIElmIHlvdSB3aXNoIHRvIGN1c3RvbWl6ZSBQcmVzdGFTaG9wIGZvciB5b3VyXG4gKiBuZWVkcyBwbGVhc2UgcmVmZXIgdG8gaHR0cHM6Ly93d3cucHJlc3Rhc2hvcC5jb20gZm9yIG1vcmUgaW5mb3JtYXRpb24uXG4gKlxuICogQGF1dGhvciAgICBQcmVzdGFTaG9wIFNBIDxjb250YWN0QHByZXN0YXNob3AuY29tPlxuICogQGNvcHlyaWdodCAyMDA3LTIwMTkgUHJlc3RhU2hvcCBTQSBhbmQgQ29udHJpYnV0b3JzXG4gKiBAbGljZW5zZSAgIGh0dHBzOi8vb3BlbnNvdXJjZS5vcmcvbGljZW5zZXMvT1NMLTMuMCBPcGVuIFNvZnR3YXJlIExpY2Vuc2UgKE9TTCAzLjApXG4gKiBJbnRlcm5hdGlvbmFsIFJlZ2lzdGVyZWQgVHJhZGVtYXJrICYgUHJvcGVydHkgb2YgUHJlc3RhU2hvcCBTQVxuICovXG5cbmNvbnN0ICQgPSB3aW5kb3cuJDtcblxuLyoqXG4gKiBEaXNwbGF5cywgZmlsbHMgb3IgaGlkZXMgU3RhdGUgc2VsZWN0aW9uIGJsb2NrIGRlcGVuZGluZyBvbiBzZWxlY3RlZCBjb3VudHJ5LlxuICpcbiAqIFVzYWdlOlxuICpcbiAqIDwhLS0gQ291bnRyeSBzZWxlY3QgbXVzdCBoYXZlIHVuaXF1ZSBpZGVudGlmaWVyICYgdXJsIGZvciBzdGF0ZXMgQVBJIC0tPlxuICogPHNlbGVjdCBuYW1lPVwiaWRfY291bnRyeVwiIGlkPVwiaWRfY291bnRyeVwiIHN0YXRlcy11cmw9XCJwYXRoL3RvL3N0YXRlcy9hcGlcIj5cbiAqICAgLi4uXG4gKiA8L3NlbGVjdD5cbiAqXG4gKiA8IS0tIElmIHNlbGVjdGVkIGNvdW50cnkgZG9lcyBub3QgaGF2ZSBzdGF0ZXMsIHRoZW4gdGhpcyBibG9jayB3aWxsIGJlIGhpZGRlbiAtLT5cbiAqIDxkaXYgY2xhc3M9XCJqcy1zdGF0ZS1zZWxlY3Rpb24tYmxvY2tcIj5cbiAqICAgPHNlbGVjdCBuYW1lPVwiaWRfc3RhdGVcIj5cbiAqICAgICAuLi5cbiAqICAgPC9zZWxlY3Q+XG4gKiA8L2Rpdj5cbiAqXG4gKiBJbiBKUzpcbiAqXG4gKiBuZXcgQ291bnRyeVN0YXRlU2VsZWN0aW9uVG9nZ2xlcignI2lkX2NvdW50cnknLCAnI2lkX3N0YXRlJywgJy5qcy1zdGF0ZS1zZWxlY3Rpb24tYmxvY2snKTtcbiAqL1xuZXhwb3J0IGRlZmF1bHQgY2xhc3MgQ291bnRyeVN0YXRlU2VsZWN0aW9uVG9nZ2xlciB7XG4gIGNvbnN0cnVjdG9yKGNvdW50cnlJbnB1dFNlbGVjdG9yLCBjb3VudHJ5U3RhdGVTZWxlY3Rvciwgc3RhdGVTZWxlY3Rpb25CbG9ja1NlbGVjdG9yKSB7XG4gICAgdGhpcy4kc3RhdGVTZWxlY3Rpb25CbG9jayA9ICQoc3RhdGVTZWxlY3Rpb25CbG9ja1NlbGVjdG9yKTtcbiAgICB0aGlzLiRjb3VudHJ5U3RhdGVTZWxlY3RvciA9ICQoY291bnRyeVN0YXRlU2VsZWN0b3IpO1xuICAgIHRoaXMuJGNvdW50cnlJbnB1dCA9ICQoY291bnRyeUlucHV0U2VsZWN0b3IpO1xuXG4gICAgdGhpcy4kY291bnRyeUlucHV0Lm9uKCdjaGFuZ2UnLCAoKSA9PiB0aGlzLl90b2dnbGUoKSk7XG5cbiAgICAvLyB0b2dnbGUgb24gcGFnZSBsb2FkXG4gICAgdGhpcy5fdG9nZ2xlKHRydWUpO1xuXG4gICAgcmV0dXJuIHt9O1xuICB9XG5cbiAgLyoqXG4gICAqIFRvZ2dsZXMgU3RhdGUgc2VsZWN0aW9uXG4gICAqXG4gICAqIEBwcml2YXRlXG4gICAqL1xuICBfdG9nZ2xlKGlzRmlyc3RUb2dnbGUgPSBmYWxzZSkge1xuICAgICQuYWpheCh7XG4gICAgICB1cmw6IHRoaXMuJGNvdW50cnlJbnB1dC5kYXRhKCdzdGF0ZXMtdXJsJyksXG4gICAgICBtZXRob2Q6ICdHRVQnLFxuICAgICAgZGF0YVR5cGU6ICdqc29uJyxcbiAgICAgIGRhdGE6IHtcbiAgICAgICAgaWRfY291bnRyeTogdGhpcy4kY291bnRyeUlucHV0LnZhbCgpLFxuICAgICAgfVxuICAgIH0pLnRoZW4oKHJlc3BvbnNlKSA9PiB7XG4gICAgICBpZiAocmVzcG9uc2Uuc3RhdGVzLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICB0aGlzLiRzdGF0ZVNlbGVjdGlvbkJsb2NrLmZhZGVPdXQoKTtcblxuICAgICAgICByZXR1cm47XG4gICAgICB9XG5cbiAgICAgIHRoaXMuJHN0YXRlU2VsZWN0aW9uQmxvY2suZmFkZUluKCk7XG5cbiAgICAgIGlmIChpc0ZpcnN0VG9nZ2xlID09PSBmYWxzZSkge1xuICAgICAgICB0aGlzLiRjb3VudHJ5U3RhdGVTZWxlY3Rvci5lbXB0eSgpO1xuICAgICAgICB2YXIgX3RoaXMgPSB0aGlzO1xuICAgICAgICAkLmVhY2gocmVzcG9uc2Uuc3RhdGVzLCBmdW5jdGlvbiAoaW5kZXgsIHZhbHVlKSB7XG4gICAgICAgICAgX3RoaXMuJGNvdW50cnlTdGF0ZVNlbGVjdG9yLmFwcGVuZCgkKCc8b3B0aW9uPjwvb3B0aW9uPicpLmF0dHIoJ3ZhbHVlJywgdmFsdWUpLnRleHQoaW5kZXgpKTtcbiAgICAgICAgfSlcbiAgICAgIH1cbiAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcbiAgICAgIGlmICh0eXBlb2YgcmVzcG9uc2UucmVzcG9uc2VKU09OICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICBzaG93RXJyb3JNZXNzYWdlKHJlc3BvbnNlLnJlc3BvbnNlSlNPTi5tZXNzYWdlKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfVxufVxuIiwiLyoqXG4gKiAyMDA3LTIwMTkgUHJlc3RhU2hvcCBhbmQgQ29udHJpYnV0b3JzXG4gKlxuICogTk9USUNFIE9GIExJQ0VOU0VcbiAqXG4gKiBUaGlzIHNvdXJjZSBmaWxlIGlzIHN1YmplY3QgdG8gdGhlIE9wZW4gU29mdHdhcmUgTGljZW5zZSAoT1NMIDMuMClcbiAqIHRoYXQgaXMgYnVuZGxlZCB3aXRoIHRoaXMgcGFja2FnZSBpbiB0aGUgZmlsZSBMSUNFTlNFLnR4dC5cbiAqIEl0IGlzIGFsc28gYXZhaWxhYmxlIHRocm91Z2ggdGhlIHdvcmxkLXdpZGUtd2ViIGF0IHRoaXMgVVJMOlxuICogaHR0cHM6Ly9vcGVuc291cmNlLm9yZy9saWNlbnNlcy9PU0wtMy4wXG4gKiBJZiB5b3UgZGlkIG5vdCByZWNlaXZlIGEgY29weSBvZiB0aGUgbGljZW5zZSBhbmQgYXJlIHVuYWJsZSB0b1xuICogb2J0YWluIGl0IHRocm91Z2ggdGhlIHdvcmxkLXdpZGUtd2ViLCBwbGVhc2Ugc2VuZCBhbiBlbWFpbFxuICogdG8gbGljZW5zZUBwcmVzdGFzaG9wLmNvbSBzbyB3ZSBjYW4gc2VuZCB5b3UgYSBjb3B5IGltbWVkaWF0ZWx5LlxuICpcbiAqIERJU0NMQUlNRVJcbiAqXG4gKiBEbyBub3QgZWRpdCBvciBhZGQgdG8gdGhpcyBmaWxlIGlmIHlvdSB3aXNoIHRvIHVwZ3JhZGUgUHJlc3RhU2hvcCB0byBuZXdlclxuICogdmVyc2lvbnMgaW4gdGhlIGZ1dHVyZS4gSWYgeW91IHdpc2ggdG8gY3VzdG9taXplIFByZXN0YVNob3AgZm9yIHlvdXJcbiAqIG5lZWRzIHBsZWFzZSByZWZlciB0byBodHRwczovL3d3dy5wcmVzdGFzaG9wLmNvbSBmb3IgbW9yZSBpbmZvcm1hdGlvbi5cbiAqXG4gKiBAYXV0aG9yICAgIFByZXN0YVNob3AgU0EgPGNvbnRhY3RAcHJlc3Rhc2hvcC5jb20+XG4gKiBAY29weXJpZ2h0IDIwMDctMjAxOSBQcmVzdGFTaG9wIFNBIGFuZCBDb250cmlidXRvcnNcbiAqIEBsaWNlbnNlICAgaHR0cHM6Ly9vcGVuc291cmNlLm9yZy9saWNlbnNlcy9PU0wtMy4wIE9wZW4gU29mdHdhcmUgTGljZW5zZSAoT1NMIDMuMClcbiAqIEludGVybmF0aW9uYWwgUmVnaXN0ZXJlZCBUcmFkZW1hcmsgJiBQcm9wZXJ0eSBvZiBQcmVzdGFTaG9wIFNBXG4gKi9cblxuY29uc3QgJCA9IHdpbmRvdy4kO1xuXG4vKipcbiAqIENsYXNzIFN1Ym1pdFJvd0FjdGlvbkV4dGVuc2lvbiBoYW5kbGVzIHN1Ym1pdHRpbmcgb2Ygcm93IGFjdGlvblxuICovXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBTdWJtaXRSb3dBY3Rpb25FeHRlbnNpb24ge1xuICAvKipcbiAgICogRXh0ZW5kIGdyaWRcbiAgICpcbiAgICogQHBhcmFtIHtHcmlkfSBncmlkXG4gICAqL1xuICBleHRlbmQoZ3JpZCkge1xuICAgIGdyaWQuZ2V0Q29udGFpbmVyKCkub24oJ2NsaWNrJywgJy5qcy1zdWJtaXQtcm93LWFjdGlvbicsIChldmVudCkgPT4ge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgY29uc3QgJGJ1dHRvbiA9ICQoZXZlbnQuY3VycmVudFRhcmdldCk7XG4gICAgICBjb25zdCBjb25maXJtTWVzc2FnZSA9ICRidXR0b24uZGF0YSgnY29uZmlybS1tZXNzYWdlJyk7XG5cbiAgICAgIGlmIChjb25maXJtTWVzc2FnZS5sZW5ndGggJiYgIWNvbmZpcm0oY29uZmlybU1lc3NhZ2UpKSB7XG4gICAgICAgIHJldHVybjtcbiAgICAgIH1cblxuICAgICAgY29uc3QgbWV0aG9kID0gJGJ1dHRvbi5kYXRhKCdtZXRob2QnKTtcbiAgICAgIGNvbnN0IGlzR2V0T3JQb3N0TWV0aG9kID0gWydHRVQnLCAnUE9TVCddLmluY2x1ZGVzKG1ldGhvZCk7XG5cbiAgICAgIGNvbnN0ICRmb3JtID0gJCgnPGZvcm0+Jywge1xuICAgICAgICAnYWN0aW9uJzogJGJ1dHRvbi5kYXRhKCd1cmwnKSxcbiAgICAgICAgJ21ldGhvZCc6IGlzR2V0T3JQb3N0TWV0aG9kID8gbWV0aG9kIDogJ1BPU1QnLFxuICAgICAgfSkuYXBwZW5kVG8oJ2JvZHknKTtcblxuICAgICAgaWYgKCFpc0dldE9yUG9zdE1ldGhvZCkge1xuICAgICAgICAkZm9ybS5hcHBlbmQoJCgnPGlucHV0PicsIHtcbiAgICAgICAgICAndHlwZSc6ICdfaGlkZGVuJyxcbiAgICAgICAgICAnbmFtZSc6ICdfbWV0aG9kJyxcbiAgICAgICAgICAndmFsdWUnOiBtZXRob2RcbiAgICAgICAgfSkpO1xuICAgICAgfVxuXG4gICAgICAkZm9ybS5zdWJtaXQoKTtcbiAgICB9KTtcbiAgfVxufVxuIiwiLyoqXG4gKiAyMDA3LTIwMTkgUHJlc3RhU2hvcCBhbmQgQ29udHJpYnV0b3JzXG4gKlxuICogTk9USUNFIE9GIExJQ0VOU0VcbiAqXG4gKiBUaGlzIHNvdXJjZSBmaWxlIGlzIHN1YmplY3QgdG8gdGhlIE9wZW4gU29mdHdhcmUgTGljZW5zZSAoT1NMIDMuMClcbiAqIHRoYXQgaXMgYnVuZGxlZCB3aXRoIHRoaXMgcGFja2FnZSBpbiB0aGUgZmlsZSBMSUNFTlNFLnR4dC5cbiAqIEl0IGlzIGFsc28gYXZhaWxhYmxlIHRocm91Z2ggdGhlIHdvcmxkLXdpZGUtd2ViIGF0IHRoaXMgVVJMOlxuICogaHR0cHM6Ly9vcGVuc291cmNlLm9yZy9saWNlbnNlcy9PU0wtMy4wXG4gKiBJZiB5b3UgZGlkIG5vdCByZWNlaXZlIGEgY29weSBvZiB0aGUgbGljZW5zZSBhbmQgYXJlIHVuYWJsZSB0b1xuICogb2J0YWluIGl0IHRocm91Z2ggdGhlIHdvcmxkLXdpZGUtd2ViLCBwbGVhc2Ugc2VuZCBhbiBlbWFpbFxuICogdG8gbGljZW5zZUBwcmVzdGFzaG9wLmNvbSBzbyB3ZSBjYW4gc2VuZCB5b3UgYSBjb3B5IGltbWVkaWF0ZWx5LlxuICpcbiAqIERJU0NMQUlNRVJcbiAqXG4gKiBEbyBub3QgZWRpdCBvciBhZGQgdG8gdGhpcyBmaWxlIGlmIHlvdSB3aXNoIHRvIHVwZ3JhZGUgUHJlc3RhU2hvcCB0byBuZXdlclxuICogdmVyc2lvbnMgaW4gdGhlIGZ1dHVyZS4gSWYgeW91IHdpc2ggdG8gY3VzdG9taXplIFByZXN0YVNob3AgZm9yIHlvdXJcbiAqIG5lZWRzIHBsZWFzZSByZWZlciB0byBodHRwczovL3d3dy5wcmVzdGFzaG9wLmNvbSBmb3IgbW9yZSBpbmZvcm1hdGlvbi5cbiAqXG4gKiBAYXV0aG9yICAgIFByZXN0YVNob3AgU0EgPGNvbnRhY3RAcHJlc3Rhc2hvcC5jb20+XG4gKiBAY29weXJpZ2h0IDIwMDctMjAxOSBQcmVzdGFTaG9wIFNBIGFuZCBDb250cmlidXRvcnNcbiAqIEBsaWNlbnNlICAgaHR0cHM6Ly9vcGVuc291cmNlLm9yZy9saWNlbnNlcy9PU0wtMy4wIE9wZW4gU29mdHdhcmUgTGljZW5zZSAoT1NMIDMuMClcbiAqIEludGVybmF0aW9uYWwgUmVnaXN0ZXJlZCBUcmFkZW1hcmsgJiBQcm9wZXJ0eSBvZiBQcmVzdGFTaG9wIFNBXG4gKi9cblxuY29uc3QgJCA9IHdpbmRvdy4kO1xuXG4vKipcbiAqIENsYXNzIExpbmtSb3dBY3Rpb25FeHRlbnNpb24gaGFuZGxlcyBsaW5rIHJvdyBhY3Rpb25zXG4gKi9cbmV4cG9ydCBkZWZhdWx0IGNsYXNzIExpbmtSb3dBY3Rpb25FeHRlbnNpb24ge1xuICAvKipcbiAgICogRXh0ZW5kIGdyaWRcbiAgICpcbiAgICogQHBhcmFtIHtHcmlkfSBncmlkXG4gICAqL1xuICBleHRlbmQoZ3JpZCkge1xuICAgIHRoaXMuaW5pdFJvd0xpbmtzKGdyaWQpO1xuICAgIHRoaXMuaW5pdENvbmZpcm1hYmxlQWN0aW9ucyhncmlkKTtcbiAgfVxuXG4gIC8qKlxuICAgKiBFeHRlbmQgZ3JpZFxuICAgKlxuICAgKiBAcGFyYW0ge0dyaWR9IGdyaWRcbiAgICovXG4gIGluaXRDb25maXJtYWJsZUFjdGlvbnMoZ3JpZCkge1xuICAgIGdyaWQuZ2V0Q29udGFpbmVyKCkub24oJ2NsaWNrJywgJy5qcy1saW5rLXJvdy1hY3Rpb24nLCAoZXZlbnQpID0+IHtcbiAgICAgIGNvbnN0IGNvbmZpcm1NZXNzYWdlID0gJChldmVudC5jdXJyZW50VGFyZ2V0KS5kYXRhKCdjb25maXJtLW1lc3NhZ2UnKTtcblxuICAgICAgaWYgKGNvbmZpcm1NZXNzYWdlLmxlbmd0aCAmJiAhY29uZmlybShjb25maXJtTWVzc2FnZSkpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfVxuXG4gIC8qKlxuICAgKiBBZGQgYSBjbGljayBldmVudCBvbiByb3dzIHRoYXQgbWF0Y2hlcyB0aGUgZmlyc3QgbGluayBhY3Rpb24gKGlmIHByZXNlbnQpXG4gICAqXG4gICAqIEBwYXJhbSB7R3JpZH0gZ3JpZFxuICAgKi9cbiAgaW5pdFJvd0xpbmtzKGdyaWQpIHtcbiAgICAkKCd0cicsIGdyaWQuZ2V0Q29udGFpbmVyKCkpLmVhY2goZnVuY3Rpb24gaW5pdEVhY2hSb3coKSB7XG4gICAgICBjb25zdCAkcGFyZW50Um93ID0gJCh0aGlzKTtcblxuICAgICAgJCgnLmpzLWxpbmstcm93LWFjdGlvbltkYXRhLWNsaWNrYWJsZS1yb3c9MV06Zmlyc3QnLCAkcGFyZW50Um93KS5lYWNoKGZ1bmN0aW9uIHByb3BhZ2F0ZUZpcnN0TGlua0FjdGlvbigpIHtcbiAgICAgICAgY29uc3QgJHJvd0FjdGlvbiA9ICQodGhpcyk7XG4gICAgICAgIGNvbnN0ICRwYXJlbnRDZWxsID0gJHJvd0FjdGlvbi5jbG9zZXN0KCd0ZCcpO1xuXG4gICAgICAgIC8qXG4gICAgICAgICAqIE9ubHkgc2VhcmNoIGZvciBjZWxscyB3aXRoIG5vbiBjbGlja2FibGUgY29udGVudHMgdG8gYXZvaWQgY29uZmxpY3RzIHdpdGhcbiAgICAgICAgICogcHJldmlvdXMgY2VsbCBiZWhhdmlvdXIgKGFjdGlvbiwgdG9nZ2xlLCAuLi4pXG4gICAgICAgICAqL1xuICAgICAgICBjb25zdCBjbGlja2FibGVDZWxscyA9ICQoJ3RkLmRhdGEtdHlwZSwgdGQuaWRlbnRpZmllci10eXBlOm5vdCg6aGFzKGlucHV0KSksIHRkLmJhZGdlLXR5cGUsIHRkLnBvc2l0aW9uLXR5cGUnLCAkcGFyZW50Um93KVxuICAgICAgICAgIC5ub3QoJHBhcmVudENlbGwpXG4gICAgICAgIDtcblxuICAgICAgICBjbGlja2FibGVDZWxscy5hZGRDbGFzcygnY3Vyc29yLXBvaW50ZXInKS5jbGljaygoKSA9PiB7XG4gICAgICAgICAgY29uc3QgY29uZmlybU1lc3NhZ2UgPSAkcm93QWN0aW9uLmRhdGEoJ2NvbmZpcm0tbWVzc2FnZScpO1xuXG4gICAgICAgICAgaWYgKCFjb25maXJtTWVzc2FnZS5sZW5ndGggfHwgY29uZmlybShjb25maXJtTWVzc2FnZSkpIHtcbiAgICAgICAgICAgIGRvY3VtZW50LmxvY2F0aW9uID0gJHJvd0FjdGlvbi5hdHRyKCdocmVmJyk7XG4gICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgIH0pO1xuICAgIH0pO1xuICB9XG59XG4iLCIvKipcbiAqIDIwMDctMjAxOSBQcmVzdGFTaG9wIGFuZCBDb250cmlidXRvcnNcbiAqXG4gKiBOT1RJQ0UgT0YgTElDRU5TRVxuICpcbiAqIFRoaXMgc291cmNlIGZpbGUgaXMgc3ViamVjdCB0byB0aGUgT3BlbiBTb2Z0d2FyZSBMaWNlbnNlIChPU0wgMy4wKVxuICogdGhhdCBpcyBidW5kbGVkIHdpdGggdGhpcyBwYWNrYWdlIGluIHRoZSBmaWxlIExJQ0VOU0UudHh0LlxuICogSXQgaXMgYWxzbyBhdmFpbGFibGUgdGhyb3VnaCB0aGUgd29ybGQtd2lkZS13ZWIgYXQgdGhpcyBVUkw6XG4gKiBodHRwczovL29wZW5zb3VyY2Uub3JnL2xpY2Vuc2VzL09TTC0zLjBcbiAqIElmIHlvdSBkaWQgbm90IHJlY2VpdmUgYSBjb3B5IG9mIHRoZSBsaWNlbnNlIGFuZCBhcmUgdW5hYmxlIHRvXG4gKiBvYnRhaW4gaXQgdGhyb3VnaCB0aGUgd29ybGQtd2lkZS13ZWIsIHBsZWFzZSBzZW5kIGFuIGVtYWlsXG4gKiB0byBsaWNlbnNlQHByZXN0YXNob3AuY29tIHNvIHdlIGNhbiBzZW5kIHlvdSBhIGNvcHkgaW1tZWRpYXRlbHkuXG4gKlxuICogRElTQ0xBSU1FUlxuICpcbiAqIERvIG5vdCBlZGl0IG9yIGFkZCB0byB0aGlzIGZpbGUgaWYgeW91IHdpc2ggdG8gdXBncmFkZSBQcmVzdGFTaG9wIHRvIG5ld2VyXG4gKiB2ZXJzaW9ucyBpbiB0aGUgZnV0dXJlLiBJZiB5b3Ugd2lzaCB0byBjdXN0b21pemUgUHJlc3RhU2hvcCBmb3IgeW91clxuICogbmVlZHMgcGxlYXNlIHJlZmVyIHRvIGh0dHBzOi8vd3d3LnByZXN0YXNob3AuY29tIGZvciBtb3JlIGluZm9ybWF0aW9uLlxuICpcbiAqIEBhdXRob3IgICAgUHJlc3RhU2hvcCBTQSA8Y29udGFjdEBwcmVzdGFzaG9wLmNvbT5cbiAqIEBjb3B5cmlnaHQgMjAwNy0yMDE5IFByZXN0YVNob3AgU0EgYW5kIENvbnRyaWJ1dG9yc1xuICogQGxpY2Vuc2UgICBodHRwczovL29wZW5zb3VyY2Uub3JnL2xpY2Vuc2VzL09TTC0zLjAgT3BlbiBTb2Z0d2FyZSBMaWNlbnNlIChPU0wgMy4wKVxuICogSW50ZXJuYXRpb25hbCBSZWdpc3RlcmVkIFRyYWRlbWFyayAmIFByb3BlcnR5IG9mIFByZXN0YVNob3AgU0FcbiAqL1xuXG5jb25zdCAkID0gd2luZG93LiQ7XG5cbi8qKlxuICogQ2xhc3MgaXMgcmVzcG9uc2libGUgZm9yIGhhbmRsaW5nIEdyaWQgZXZlbnRzXG4gKi9cbmV4cG9ydCBkZWZhdWx0IGNsYXNzIEdyaWQge1xuICAvKipcbiAgICogR3JpZCBpZFxuICAgKlxuICAgKiBAcGFyYW0ge3N0cmluZ30gaWRcbiAgICovXG4gIGNvbnN0cnVjdG9yKGlkKSB7XG4gICAgdGhpcy5pZCA9IGlkO1xuICAgIHRoaXMuJGNvbnRhaW5lciA9ICQoJyMnICsgdGhpcy5pZCArICdfZ3JpZCcpO1xuICB9XG5cbiAgLyoqXG4gICAqIEdldCBncmlkIGlkXG4gICAqXG4gICAqIEByZXR1cm5zIHtzdHJpbmd9XG4gICAqL1xuICBnZXRJZCgpIHtcbiAgICByZXR1cm4gdGhpcy5pZDtcbiAgfVxuXG4gIC8qKlxuICAgKiBHZXQgZ3JpZCBjb250YWluZXJcbiAgICpcbiAgICogQHJldHVybnMge2pRdWVyeX1cbiAgICovXG4gIGdldENvbnRhaW5lcigpIHtcbiAgICByZXR1cm4gdGhpcy4kY29udGFpbmVyO1xuICB9XG5cbiAgLyoqXG4gICAqIEdldCBncmlkIGhlYWRlciBjb250YWluZXJcbiAgICpcbiAgICogQHJldHVybnMge2pRdWVyeX1cbiAgICovXG4gIGdldEhlYWRlckNvbnRhaW5lcigpIHtcbiAgICByZXR1cm4gdGhpcy4kY29udGFpbmVyLmNsb3Nlc3QoJy5qcy1ncmlkLXBhbmVsJykuZmluZCgnLmpzLWdyaWQtaGVhZGVyJyk7XG4gIH1cblxuICAvKipcbiAgICogRXh0ZW5kIGdyaWQgd2l0aCBleHRlcm5hbCBleHRlbnNpb25zXG4gICAqXG4gICAqIEBwYXJhbSB7b2JqZWN0fSBleHRlbnNpb25cbiAgICovXG4gIGFkZEV4dGVuc2lvbihleHRlbnNpb24pIHtcbiAgICBleHRlbnNpb24uZXh0ZW5kKHRoaXMpO1xuICB9XG59XG4iLCJpbXBvcnQgR3JpZCBmcm9tICcuLi8uLi8uLi8uLi8uLi8uLi9hZG1pbi1kZXYvdGhlbWVzL25ldy10aGVtZS9qcy9jb21wb25lbnRzL2dyaWQvZ3JpZCc7XG5pbXBvcnQgTGlua1Jvd0FjdGlvbkV4dGVuc2lvbiBmcm9tICcuLi8uLi8uLi8uLi8uLi8uLi9hZG1pbi1kZXYvdGhlbWVzL25ldy10aGVtZS9qcy9jb21wb25lbnRzL2dyaWQvZXh0ZW5zaW9uL2xpbmstcm93LWFjdGlvbi1leHRlbnNpb24nO1xuaW1wb3J0IFN1Ym1pdFJvd0FjdGlvbkV4dGVuc2lvbiBmcm9tICcuLi8uLi8uLi8uLi8uLi8uLi9hZG1pbi1kZXYvdGhlbWVzL25ldy10aGVtZS9qcy9jb21wb25lbnRzL2dyaWQvZXh0ZW5zaW9uL2FjdGlvbi9yb3cvc3VibWl0LXJvdy1hY3Rpb24tZXh0ZW5zaW9uJztcbiAgXG5jb25zdCAkID0gd2luZG93LiQ7XG4gIFxuJCgoKSA9PiB7XG4gIGNvbnN0IGdyaWREaXZzID0gQXJyYXkuZnJvbShkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuanMtZ3JpZCcpKTtcbiAgZ3JpZERpdnMuZm9yRWFjaChncmlkRGl2ID0+IHtcbiAgICBjb25zdCBncmlkID0gbmV3IEdyaWQoZ3JpZERpdi5kYXRhc2V0LmdyaWRJZCk7XG4gICAgZ3JpZC5hZGRFeHRlbnNpb24obmV3IExpbmtSb3dBY3Rpb25FeHRlbnNpb24oKSk7XG4gICAgZ3JpZC5hZGRFeHRlbnNpb24obmV3IFN1Ym1pdFJvd0FjdGlvbkV4dGVuc2lvbigpKTtcbiAgfSk7XG59KTtcbiIsImltcG9ydCBDb3VudHJ5U3RhdGVTZWxlY3Rpb25Ub2dnbGVyIGZyb20gJy4uLy4uLy4uLy4uLy4uLy4uL2FkbWluLWRldi90aGVtZXMvbmV3LXRoZW1lL2pzL2NvbXBvbmVudHMvY291bnRyeS1zdGF0ZS1zZWxlY3Rpb24tdG9nZ2xlcic7XG5cbmNvbnN0ICQgPSB3aW5kb3cuJDtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICBuZXcgQ291bnRyeVN0YXRlU2VsZWN0aW9uVG9nZ2xlcignI3JldGFpbGVyX2lkX2NvdW50cnknLCAnI3JldGFpbGVyX2lkX3N0YXRlJywgJy5qcy1yZXRhaWxlci1zdGF0ZScpO1xufSk7XG4iXSwic291cmNlUm9vdCI6IiJ9