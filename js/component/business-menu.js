/**
 * スクロールで目次の色を変える実装（Intersection Observer API使用）
 * Easy Table of Contentsプラグイン対応版
 */
export const initializeBusinessMenu = () => {
  // Easy Table of Contentsプラグインの要素にクラスを追加（DOMContentLoaded時にまとめて処理）
  document.addEventListener("DOMContentLoaded", function () {
    // 目次のリスト項目にクラスを追加
    document.querySelectorAll(".ez-toc-page-1").forEach(function (el) {
      el.classList.add("js-business-menu-item");
    });

    // 目次のリンクにクラスを追加
    document.querySelectorAll(".ez-toc-link").forEach(function (el) {
      el.classList.add("js-business-menu-link");
    });

    // セクション検出：Easy Table of Contentsプラグイン対応
    // プラグインが生成する .ez-toc-section の親要素（見出しタグ）を対象にする
    document.querySelectorAll(".ez-toc-section").forEach(function (el) {
      // 親要素の見出しタグ（h1-h6）を取得してクラスを追加
      const headingElement = el.closest("h1, h2, h3, h4, h5, h6");
      if (headingElement) {
        headingElement.classList.add("js-business-section");
      }
    });

    // フォールバック：プラグインが無効な場合の対応
    // .ez-toc-section が存在しない場合は、通常の見出しタグを対象にする
    if (!document.querySelectorAll(".ez-toc-section").length) {
      document
        .querySelectorAll(".wp-block-heading, h1, h2, h3, h4, h5, h6")
        .forEach(function (el) {
          el.classList.add("js-business-section");
        });
    }

    // DOMContentLoaded内で要素取得を実行（タイミング問題を解決）
    // 目次の各項目を取得
    const menuItemsFinal = document.querySelectorAll(".js-business-menu-item");

    // 各セクションを取得
    const sectionsFinal = document.querySelectorAll(".js-business-section");

    // 必要な要素が存在しない場合は早期リターン
    if (!menuItemsFinal.length || !sectionsFinal.length) {
      return;
    }

    // IntersectionObserverの初期化をここで実行
    initializeIntersectionObserver(menuItemsFinal, sectionsFinal);

    // 目次クリック時の即座な色変更機能を追加
    initializeMenuClickHandler(menuItemsFinal);
  });

  // IntersectionObserverの初期化関数
  const initializeIntersectionObserver = (menuItems, sections) => {
    // IntersectionObserverのOption
    const observerOptions = {
      root: null,
      rootMargin: "-20% 0px -70% 0px", // 画面の中央付近で発火
      threshold: 0,
    };

    // 目次の色を変更する関数
    const updateMenuColors = (activeSectionId) => {
      menuItems.forEach((item) => {
        const link = item.querySelector(".js-business-menu-link");
        if (link && link.getAttribute("href") === `#${activeSectionId}`) {
          item.classList.add("is-active");
        } else {
          item.classList.remove("is-active");
        }
      });
    };

    // セクションの表示状態を監視
    const sectionVisibilityHandler = (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // h2要素内のez-toc-sectionからIDを取得
          let sectionId = entry.target.id;

          // h2要素自体にIDがない場合は、内部のez-toc-sectionから取得
          if (!sectionId) {
            const tocSection = entry.target.querySelector(".ez-toc-section");
            if (tocSection) {
              sectionId = tocSection.id;
            }
          }

          if (sectionId) {
            updateMenuColors(sectionId);
          }
        }
      });
    };

    const sectionObserver = new IntersectionObserver(
      sectionVisibilityHandler,
      observerOptions
    );

    // 各セクションを監視
    sections.forEach((section) => {
      sectionObserver.observe(section);
    });
  };

  // 目次クリック時の即座な色変更機能
  const initializeMenuClickHandler = (menuItems) => {
    menuItems.forEach((item) => {
      const link = item.querySelector(".js-business-menu-link");
      if (link) {
        link.addEventListener("click", function (e) {
          // クリックされたリンクのhrefからIDを取得
          const href = this.getAttribute("href");
          if (href && href.startsWith("#")) {
            const targetId = href.substring(1);

            // 即座に目次の色を更新
            updateMenuColorsForClick(menuItems, targetId);
          }
        });
      }
    });
  };

  // クリック時の目次色更新関数
  const updateMenuColorsForClick = (menuItems, activeSectionId) => {
    menuItems.forEach((item) => {
      const link = item.querySelector(".js-business-menu-link");
      if (link) {
        const linkHref = link.getAttribute("href");

        if (linkHref === `#${activeSectionId}`) {
          item.classList.add("is-active");
        } else {
          item.classList.remove("is-active");
        }
      }
    });
  };
};
