import {createElement} from "../src/utils.js";

export default class ErrorInputView {
  #element = null;
  #errorText = null;

  constructor(errorText = '') {
    this.#errorText = errorText;
  }

  get element() {
    if (!this.#element) {
      this.#element = createElement(createErrorInputTemplate(this.#errorText));
    }

    return this.#element;
  }

  static getElementClass() {
    return createElement(createErrorInputTemplate()).className;
  }
}

function createErrorInputTemplate(errorText) {
  return (`
     <span class="request-form__error">${errorText}</span>
        `);
}
