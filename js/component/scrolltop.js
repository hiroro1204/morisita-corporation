/**
 * トップに戻るボタンのスムーススクロール機能
 */

export const initializeScrollTop = () => {
  // 要素を取得
  const button = document.querySelector(".js-scrolltop-button");

  // 要素が存在しない場合は早期リターン
  if (!button) {
    return;
  }

  // クリックイベント
  button.addEventListener("click", (e) => {
    e.preventDefault();

    // ページ上部へスムーススクロール
    window.scroll({
      top: 0,
      behavior: "smooth",
    });
  });
};
