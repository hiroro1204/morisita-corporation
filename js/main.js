import { initializeDropdownMenu } from "./component/dropdownmenu.js";
import { initializeHamburgerMenu } from "./component/hamburgermenu.js";
import { switchViewport } from "./utility/switch-viewport.js";
import { initializeHeaderAnimation } from "./component/header-animation.js";
import { initializeTopKvSplide } from "./component/top-kv-splide.js";
import { initializeTopProductSplide } from "./component/top-product-splide.js";
import { initializeScrollTop } from "./component/scrolltop.js";
import { initializeBusinessMenu } from "./component/business-menu.js";
import { initializeSingleProductThumbnails } from "./component/single-product-thumbnails.js";

// 画面の幅に応じてビューポートの設定を切り替え
switchViewport();
window.addEventListener("resize", switchViewport);

// 各機能の初期化
initializeDropdownMenu();
initializeHamburgerMenu();

// スライダーの初期化
initializeTopKvSplide();
initializeTopProductSplide();

// 共通の機能を初期化
initializeHeaderAnimation();
initializeScrollTop();

// ビジネスページの機能を初期化
initializeBusinessMenu();

// 商品ページの機能を初期化
initializeSingleProductThumbnails();
