import {createElement} from "../src/utils.js";

export default class MobileMenuView {
    #element = null;

    get element() {
        if (!this.#element) {
            this.#element = createElement(createMobileMenuTemplate());
        }

        return this.#element;
    }
}

function createMobileMenuTemplate() {
    return (`
    <div class="main-header__mobile-menu">
        <div class="main-header__mobile-menu-container">
            <ul class="navigation__menu navigation__menu--mobile">
            
            </ul>
            <a class="telephone" href="tel:+79022027148">+7 (902) 202-71-48</a>
            <ul class="footer__social-list">
        <li class="footer__social-item">
          <a href="https://vk.com/a5chess" class="footer__social-link" target="_blank">
            <svg class="footer__social-icon" width="24" height="24">
              <use href="images/icons/sprite/sprite.svg#vk-icon"></use>
            </svg>
              <span class="visually-hidden">Vkontakte.</span>
          </a>
        </li>
        <li class="footer__social-item">
          <a href="https://t.me/a5chess" class="footer__social-link" target="_blank">
            <svg class="footer__social-icon" width="24" height="24">
              <use href="images/icons/sprite/sprite.svg#telegram-icon"></use>
            </svg>
            <span class="visually-hidden">Telegram.</span>
          </a>
        </li>
        <li class="footer__social-item">
          <a href="https://www.youtube.com/channel/UCIynB-_wplU5zbWVVtXyyXw" class="footer__social-link" target="_blank">
            <svg class="footer__social-icon" width="24" height="24">
              <use href="images/icons/sprite/sprite.svg#youtube-icon"></use>
            </svg>
            <span class="visually-hidden">Youtube.</span>
          </a>
        </li>
      </ul>
        </div>
    </div>
        `);
}
