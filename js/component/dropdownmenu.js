/**
 * ドロップダウンメニュー（PCのみ作動）
 */

export const initializeDropdownMenu = () => {
  let dropdownButton, dropdownMenu, isOpen;
  let isInitialized = false;

  // 初期化関数
  const initialize = () => {
    const isMobile = window.matchMedia("(max-width: 767px)").matches;

    // SPの場合は初期化しない
    if (isMobile) {
      if (isInitialized) {
        // 既に初期化済みの場合はクリーンアップ
        cleanup();
      }
      return;
    }

    // PCの場合は初期化
    if (!isInitialized) {
      setupDropdownMenu();
      isInitialized = true;
    }
  };

  // クリーンアップ関数
  const cleanup = () => {
    if (dropdownButton) {
      dropdownButton.removeEventListener("click", handleClick);
      dropdownButton.removeEventListener("keydown", handleKeydown);
    }
    document.removeEventListener("click", handleDocumentClick);
    document.removeEventListener("keydown", handleKeydown);

    // メニューの状態もリセット
    if (dropdownMenu) {
      dropdownMenu.classList.remove("is-open");

      // 実行中のアニメーションを停止・リセット
      const animations = dropdownMenu.getAnimations();
      animations.forEach((animation) => {
        animation.cancel(); // アニメーションを停止
      });

      // inlineスタイルを完全に除去
      dropdownMenu.removeAttribute("style");
    }

    isInitialized = false;
  };

  // ドロップダウンメニューの設定
  const setupDropdownMenu = () => {
    dropdownButton = document.querySelector(".js-dropdown-button");
    dropdownMenu = document.querySelector(".js-dropdown-menu");
    isOpen = "is-open";

    if (!dropdownButton || !dropdownMenu) return;

    // イベントリスナーを設定
    dropdownButton.addEventListener("click", handleClick);
    document.addEventListener("click", handleDocumentClick);
    document.addEventListener("keydown", handleKeydown);
  };

  // イベントハンドラー
  const handleClick = (event) => {
    event.stopPropagation();
    if (isMenuOpen()) {
      closeMenu();
    } else {
      openMenu();
    }
  };

  const handleDocumentClick = () => {
    if (isMenuOpen()) {
      closeMenu();
    }
  };

  const handleKeydown = (event) => {
    if (event.key === "Escape" && isMenuOpen()) {
      closeMenu();
    }
  };

  // 既存のアニメーション関数
  const isMenuOpen = () => dropdownMenu.classList.contains(isOpen);

  const openMenu = () => {
    dropdownMenu.classList.add(isOpen);
    dropdownMenu.animate(openingKeyframes, options);
  };

  const closeMenu = () => {
    const closingAnim = dropdownMenu.animate(closingKeyframes, options);
    closingAnim.onfinish = () => {
      dropdownMenu.classList.remove(isOpen);
    };
  };

  // アニメーション設定
  const openingKeyframes = {
    opacity: [0, 1],
    transform: ["scale(0.95)", "scale(1)"],
  };

  const closingKeyframes = {
    opacity: [1, 0],
    transform: ["scale(1)", "scale(0.95)"],
  };

  const options = {
    duration: 150,
    easing: "ease-out",
    fill: "forwards",
  };

  // 初期化実行
  initialize();

  // リサイズ時に再初期化
  window.addEventListener("resize", initialize);
};
