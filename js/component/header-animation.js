/**
 * ヘッダーのスクロール制御（Intersection Observer API使用）
 * ヘッダーは通常position: absoluteで固定、スクロールイベントでposition: fixedに変更し、スライドダウンで表示
 */
export const initializeHeaderAnimation = () => {
  const headerElement = document.querySelector(".js-header");
  const scrollTargetElement = document.querySelector(".js-scrollTarget");
  const headerFixedClass = "is-fixed";

  // 必要な要素が存在しない場合は早期リターン
  if (!headerElement || !scrollTargetElement) {
    return;
  }

  // IntersectionObserverのOption
  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0,
  };

  // ヘッダーを表示するアニメーション
  const slideDownKeyframes = {
    transform: "translateY(88rem)",
  };

  // ヘッダーを隠すアニメーション
  const slideUpKeyframes = {
    transform: "translateY(0)",
  };

  // アニメーションのOption
  const animationOptions = {
    duration: 250,
    easing: "ease-in-out",
    fill: "forwards",
  };

  // headerを表示
  const showHeader = () => {
    headerElement.classList.add(headerFixedClass);
    headerElement.animate(slideDownKeyframes, animationOptions);
  };

  // headerを隠す
  const hideHeader = () => {
    const closingAnimation = headerElement.animate(
      slideUpKeyframes,
      animationOptions
    );

    // アニメーション終了後
    closingAnimation.onfinish = () => {
      headerElement.classList.remove(headerFixedClass);
    };
  };

  // ヘッダーの表示状態を監視
  const headerVisibilityHandler = (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        hideHeader();
      } else {
        showHeader();
      }
    });
  };

  const scrollObserver = new IntersectionObserver(
    headerVisibilityHandler,
    observerOptions
  );
  scrollObserver.observe(scrollTargetElement);
};
