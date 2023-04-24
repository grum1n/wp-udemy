/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./src/blocks/recipe-summary/frontend.js ***!
  \***********************************************/
document.addEventListener('DOMContentLoaded', () => {
  const block = document.querySelector('#recipe-rating');
  const postID = parseInt(block.dataset.postId);
  const avgRating = parseFloat(block.dataset.avgRating);
  const loggedIn = !!block.dataset.loggedIn;
  console.log(postID, avgRating, loggedIn);
});
/******/ })()
;
//# sourceMappingURL=frontend.js.map