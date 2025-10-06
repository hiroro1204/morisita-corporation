/**
 * 製品紹介スライダーの初期化
 */

export const initializeTopProductSplide = () => {
  const element = document.querySelector(".js-top-product-splide");

  if (!element) {
    return;
  }

  const splide = new Splide(".js-top-product-splide", {
    type: "loop",
    fixedWidth: "404rem",
    perMove: 1,
    padding: { right: "94rem" },
    gap: "32rem",
    rewind: true,
    autoplay: false,
    arrows: true,
    pagination: false,
    speed: 1500,
    easing: "cubic-bezier(0.25, 1, 0.5, 1)",
    breakpoints: {
      767: {
        fixedWidth: "300rem",
        gap: "24rem",
        padding: { left: "20rem", right: "60rem" },
        speed: 600,
      },
    },
  });

  splide.mount();
};
