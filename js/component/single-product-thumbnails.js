/**
 * single-product-thumbnails.js
 * @description サムネイルをクリックしたらメイン画像を変更する
 */

export const initializeSingleProductThumbnails = () => {
  document.addEventListener("DOMContentLoaded", function () {
    const mainImage = document.querySelector(".js-main-image");
    const thumbs = document.querySelectorAll(".js-thumbnail");

    thumbs.forEach((thumb) => {
      thumb.addEventListener("click", function () {
        const newImage = this.getAttribute("data-image-url");
        const newAlt = this.getAttribute("data-alt");

        mainImage.setAttribute("src", newImage);
        mainImage.setAttribute("alt", newAlt);

        // activeクラス切り替え
        thumbs.forEach((t) => t.classList.remove("is-active"));
        this.classList.add("is-active");
      });
    });
  });
};
