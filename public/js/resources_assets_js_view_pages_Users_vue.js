"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_js_view_pages_Users_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _store_breadcrumbs_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../store/breadcrumbs.module */ "./resources/assets/js/store/breadcrumbs.module.js");
/* harmony import */ var _services_api_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/api.service */ "./resources/assets/js/services/api.service.js");
/* harmony import */ var _store_config_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../store/config.module */ "./resources/assets/js/store/config.module.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



var baseApi = 'api/v1/user/';
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "Users",
  data: function data() {
    return {
      users: []
    };
  },
  mounted: function mounted() {
    this.$store.dispatch(_store_breadcrumbs_module__WEBPACK_IMPORTED_MODULE_0__.SET_BREADCRUMB, [{
      title: this.$t('USERS.TITLE')
    }]);
    this.$store.dispatch(_store_config_module__WEBPACK_IMPORTED_MODULE_2__.SET_ACTION_BUTTON_CONFIG, {
      display: true,
      title: this.$t('MENU.NEW'),
      route: '/users/add'
    });
    this.index();
  },
  methods: {
    index: function index() {
      var _this = this;

      _services_api_service__WEBPACK_IMPORTED_MODULE_1__["default"].get(baseApi).then(function (_ref) {
        var data = _ref.data;
        return _this.users = data;
      });
    },
    destroy: function destroy(id) {
      var _this2 = this;

      _services_api_service__WEBPACK_IMPORTED_MODULE_1__["default"]["delete"](baseApi + id).then(function () {
        _this2.$toast.success(_this2.$t('USERS.API.RESPONSE.MESSAGE.DELETE'));

        _this2.index();
      });
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/view/pages/Users.vue":
/*!**************************************************!*\
  !*** ./resources/assets/js/view/pages/Users.vue ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Users.vue?vue&type=template&id=cadc6bb6&scoped=true& */ "./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true&");
/* harmony import */ var _Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Users.vue?vue&type=script&lang=js& */ "./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "cadc6bb6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/view/pages/Users.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Users.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Users_vue_vue_type_template_id_cadc6bb6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Users.vue?vue&type=template&id=cadc6bb6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/view/pages/Users.vue?vue&type=template&id=cadc6bb6&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "d-flex flex-column-fluid" }, [
    _c("div", { staticClass: "container" }, [
      _c(
        "div",
        { staticClass: "row" },
        _vm._l(_vm.users, function (user) {
          return _c(
            "div",
            { staticClass: "col-xl-3 col-lg-6 col-md-6 col-sm-6" },
            [
              _c(
                "div",
                { staticClass: "card card-custom gutter-b card-stretch" },
                [
                  _c("div", { staticClass: "card-body pt-4" }, [
                    _c("div", { staticClass: "d-flex align-items-end mb-3" }, [
                      _c("div", { staticClass: "d-flex align-items-center" }, [
                        _c(
                          "div",
                          { staticClass: "flex-shrink-0 mr-4 mt-lg-0 mt-3" },
                          [
                            _c(
                              "div",
                              {
                                staticClass:
                                  "symbol symbol-circle symbol-lg-75",
                              },
                              [
                                user.image
                                  ? _c("img", {
                                      attrs: {
                                        src: "../storage/" + user.image,
                                        alt: "image",
                                      },
                                    })
                                  : _c("img", {
                                      attrs: {
                                        src: "./media/users/default.jpg",
                                        alt: "image",
                                      },
                                    }),
                              ]
                            ),
                            _vm._v(" "),
                            _vm._m(0, true),
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "d-flex flex-column" },
                          [
                            _c(
                              "router-link",
                              {
                                staticClass:
                                  "text-dark font-weight-bold text-hover-primary font-size-h4 mb-0",
                                attrs: {
                                  to: {
                                    name: "show-user",
                                    params: { id: user.id },
                                  },
                                },
                              },
                              [
                                _vm._v(
                                  "\n                                            " +
                                    _vm._s(
                                      user.first_name + " " + user.last_name
                                    ) +
                                    "\n                                        "
                                ),
                              ]
                            ),
                            _vm._v(" "),
                            user.type == "teacher"
                              ? _c(
                                  "span",
                                  {
                                    staticClass: "text-muted font-weight-bold",
                                  },
                                  [
                                    _vm._v(
                                      _vm._s(_vm.$t("USERS.TYPES.TEACHER"))
                                    ),
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            user.type == "student"
                              ? _c(
                                  "span",
                                  {
                                    staticClass: "text-muted font-weight-bold",
                                  },
                                  [
                                    _vm._v(
                                      _vm._s(_vm.$t("USERS.TYPES.STUDENT"))
                                    ),
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            user.type == "parent"
                              ? _c(
                                  "span",
                                  {
                                    staticClass: "text-muted font-weight-bold",
                                  },
                                  [_vm._v(_vm._s(_vm.$t("USERS.TYPES.PARENT")))]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            user.type == "assistant"
                              ? _c(
                                  "span",
                                  {
                                    staticClass: "text-muted font-weight-bold",
                                  },
                                  [
                                    _vm._v(
                                      _vm._s(_vm.$t("USERS.TYPES.ASSISTANT"))
                                    ),
                                  ]
                                )
                              : _vm._e(),
                          ],
                          1
                        ),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "mb-7" }, [
                      _c(
                        "div",
                        {
                          staticClass:
                            "d-flex justify-content-center align-items-center",
                        },
                        [
                          _c("h5", { staticClass: "text-hover-primary mb-2" }, [
                            _vm._v(
                              _vm._s(
                                user.first_name +
                                  " " +
                                  user.middle_name +
                                  " " +
                                  user.last_name
                              )
                            ),
                          ]),
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "d-flex justify-content-between align-items-center",
                        },
                        [
                          _c(
                            "span",
                            {
                              staticClass:
                                "text-dark-75 font-weight-bolder mr-2",
                            },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.$t(
                                    "USERS.ADD.NAV.ADDRESS_INFO.FROM.ADDRESS"
                                  )
                                ) + ":"
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            { staticClass: "text-muted text-hover-primary" },
                            [_vm._v(_vm._s(user.address))]
                          ),
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "d-flex justify-content-between align-items-cente my-1",
                        },
                        [
                          _c(
                            "span",
                            {
                              staticClass:
                                "text-dark-75 font-weight-bolder mr-2",
                            },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.$t(
                                    "USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE"
                                  )
                                ) + ":"
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            { staticClass: "text-muted text-hover-primary" },
                            [_vm._v(_vm._s(user.mobile_number))]
                          ),
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "d-flex justify-content-between align-items-center",
                        },
                        [
                          _c(
                            "span",
                            {
                              staticClass:
                                "text-dark-75 font-weight-bolder mr-2",
                            },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.$t(
                                    "USERS.ADD.NAV.PERSONAL_INFO.FROM.ACADEMIC"
                                  )
                                ) + ":"
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            { staticClass: "text-muted text-hover-primary" },
                            [_vm._v(_vm._s(user.academic))]
                          ),
                        ]
                      ),
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "mt-9 text-center" },
                      [
                        _c(
                          "router-link",
                          {
                            staticClass:
                              "btn btn-md btn-icon btn-light-success btn-pill mx-2",
                            attrs: {
                              to: {
                                name: "show-user",
                                params: { id: user.id },
                              },
                            },
                          },
                          [_c("i", { staticClass: "flaticon-arrows" })]
                        ),
                        _vm._v(" "),
                        _c(
                          "router-link",
                          {
                            staticClass:
                              "btn btn-md btn-icon btn-light-warning btn-pill mx-2",
                            attrs: {
                              to: {
                                name: "show-user",
                                params: { id: user.id },
                              },
                            },
                          },
                          [_c("i", { staticClass: "flaticon-interface-1" })]
                        ),
                        _vm._v(" "),
                        _c(
                          "button",
                          {
                            staticClass:
                              "btn btn-md btn-icon btn-light-danger btn-pill mx-2",
                            on: {
                              click: function ($event) {
                                return _vm.destroy(user.id)
                              },
                            },
                          },
                          [_c("i", { staticClass: "flaticon-delete" })]
                        ),
                      ],
                      1
                    ),
                  ]),
                ]
              ),
            ]
          )
        }),
        0
      ),
      _vm._v(" "),
       false
        ? 0
        : _vm._e(),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "symbol symbol-lg-75 symbol-circle symbol-primary d-none",
      },
      [
        _c("span", { staticClass: "font-size-h3 font-weight-boldest" }, [
          _vm._v("JM"),
        ]),
      ]
    )
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-flex flex-wrap mr-3" }, [
      _c(
        "a",
        {
          staticClass: "btn btn-icon btn-sm btn-light-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_c("i", { staticClass: "ki ki-bold-double-arrow-back icon-xs" })]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass: "btn btn-icon btn-sm btn-light-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_c("i", { staticClass: "ki ki-bold-arrow-back icon-xs" })]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("...")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("23")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("24")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("25")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("26")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("27")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("28")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass:
            "btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_vm._v("...")]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass: "btn btn-icon btn-sm btn-light-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_c("i", { staticClass: "ki ki-bold-arrow-next icon-xs" })]
      ),
      _vm._v(" "),
      _c(
        "a",
        {
          staticClass: "btn btn-icon btn-sm btn-light-primary mr-2 my-1",
          attrs: { href: "#" },
        },
        [_c("i", { staticClass: "ki ki-bold-double-arrow-next icon-xs" })]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-flex align-items-center" }, [
      _c(
        "select",
        {
          staticClass:
            "form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary",
          staticStyle: { width: "75px" },
        },
        [
          _c("option", { attrs: { value: "10" } }, [_vm._v("10")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "20" } }, [_vm._v("20")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "30" } }, [_vm._v("30")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "50" } }, [_vm._v("50")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "100" } }, [_vm._v("100")]),
        ]
      ),
      _vm._v(" "),
      _c("span", { staticClass: "text-muted" }, [
        _vm._v("Displaying 10 of 230 records"),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);