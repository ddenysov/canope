(self["webpackChunkhost"] = self["webpackChunkhost"] || []).push([["index"],{

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

async function getComponent() {
  const element = document.createElement('div');
  const { default: _ } = await __webpack_require__.e(/*! import() */ "vendors-node_modules_lodash_lodash_js").then(__webpack_require__.t.bind(__webpack_require__, /*! lodash */ "./node_modules/lodash/lodash.js", 23));

  element.innerHTML = _.join(['Hello', 'webpack'], ' ');

  return element;
}

getComponent().then((component) => {
  document.body.appendChild(component);
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./src/index.js"));
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiaW5kZXguYnVuZGxlLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBLFVBQVUsYUFBYSxRQUFRLHlMQUFnQjs7QUFFL0M7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0EsQ0FBQyxFIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vaG9zdC8uL3NyYy9pbmRleC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJhc3luYyBmdW5jdGlvbiBnZXRDb21wb25lbnQoKSB7XG4gIGNvbnN0IGVsZW1lbnQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcbiAgY29uc3QgeyBkZWZhdWx0OiBfIH0gPSBhd2FpdCBpbXBvcnQoJ2xvZGFzaCcpO1xuXG4gIGVsZW1lbnQuaW5uZXJIVE1MID0gXy5qb2luKFsnSGVsbG8nLCAnd2VicGFjayddLCAnICcpO1xuXG4gIHJldHVybiBlbGVtZW50O1xufVxuXG5nZXRDb21wb25lbnQoKS50aGVuKChjb21wb25lbnQpID0+IHtcbiAgZG9jdW1lbnQuYm9keS5hcHBlbmRDaGlsZChjb21wb25lbnQpO1xufSk7Il0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9