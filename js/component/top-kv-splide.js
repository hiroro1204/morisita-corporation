/**
 * トップKVスライダーの初期化
 */

export const initializeTopKvSplide = () => {
  const element = document.querySelector(".js-top-kv-splide");

  if (!element) {
    return;
  }

  const splide = new Splide(".js-top-kv-splide", {
    type: "fade",
    rewind: true,
    autoplay: true,
    height: "100vh",
    interval: 5000, // 1スライドの表示時間
    pauseOnHover: true,
    pauseOnFocus: true,
    arrows: false,
    pagination: false,
    speed: 800,
    easing: "cubic-bezier(0.4, 0, 0.2, 1)",
  });

  const progress = document.querySelector(".js-top-kv-progress");
  const numberEl = progress?.querySelector(".js-top-kv-progress-number");

  // 番号を 01, 02, … 形式で表示
  function setNumber(index) {
    if (!numberEl) return;
    numberEl.textContent = String(index + 1).padStart(2, "0");
  }

  // 初期化時
  splide.on("mounted", (splide) => {
    if (splide && typeof splide.index !== "undefined") {
      setNumber(splide.index);
      progress?.style.setProperty("--progress", "0");
    }
  });

  // スライド切替時に番号更新＆リングリセット
  splide.on("move", (newIndex) => {
    if (typeof newIndex === "number") {
      setNumber(newIndex);
      progress?.style.setProperty("--progress", "0");
    }
  });

  // Autoplayの進捗 (0→1) をCSS変数に反映
  splide.on("autoplay:playing", (rate) => {
    progress?.style.setProperty("--progress", String(rate));
  });

  splide.mount();
};
