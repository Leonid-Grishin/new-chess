import {createElement} from "../src/utils.js";

export default class ScheduleView {
    /** @type {HTMLElement|null} Элемент представления */
    #element = null;

    /**
     * Геттер для получения элемента
     * @returns {HTMLElement} Элемент представления
     */
    get element() {
        if (!this.#element) {
            this.#element = createElement(createScheduleTemplate());
        }

        return this.#element;
    }
}

function createScheduleTemplate() {
    return (`
        <button class="button button--primary">Кнопка</button>
        `);
}
