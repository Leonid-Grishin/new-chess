import {createElement} from "../src/utils.js";

export default class PopupView {
  #element = null;
  isSuccess;

  constructor(isSuccess = true) {
    this.isSuccess = isSuccess;
  }

  get element() {
    if (!this.#element) {
      this.#element = createElement(createPopupViewTemplate(this.isSuccess));
    }

    return this.#element;
  }
}

function createPopupViewTemplate(isSuccess) {
  return (`
    <div class="popup popup--${isSuccess ? 'success' : 'error' }">
      <p class="popup__title">${isSuccess ? 'Спасибо!' : 'Ошибка!' }</p>
      <p class="popup__description">${isSuccess ? 'Ваша заявка принята. <br>Мы свяжемся с вами в ближайшее время!' : `Что-то пошло не так. Лучше позвоните нам по телефону <a class="popup__telephone" href="tel:+79022027148">+7 (902) 202-71-48</a>` }</p>
      <button class="popup__button button button--primary" type="button">Хорошо</button>
    </div>
        `);
}
