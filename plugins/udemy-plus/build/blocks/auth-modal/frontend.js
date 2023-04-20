/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./src/blocks/auth-modal/frontend.js ***!
  \*******************************************/
document.addEventListener('DOMContentLoaded', () => {
  //select class open-modal
  const openModalBtn = document.querySelectorAll('.open-modal');
  //select class wp-block-udemy-plus-auth-modal
  const modalEl = document.querySelector('.wp-block-udemy-plus-auth-modal');
  const modalCloseEl = document.querySelectorAll('.modal-overlay, .modal-btn-close');

  // lopping through every element to listen for a click event
  openModalBtn.forEach(el => {
    el.addEventListener('click', event => {
      event.preventDefault();
      // we opened the modal by adding a class that modifies the display property
      modalEl.classList.add('modal-show');
    });
  });
  modalCloseEl.forEach(el => {
    el.addEventListener('click', event => {
      event.preventDefault();
      // we remove class
      modalEl.classList.remove('modal-show');
    });
  });
});
/******/ })()
;
//# sourceMappingURL=frontend.js.map