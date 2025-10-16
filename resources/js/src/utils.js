/**
 * Функция для создания элемента на основе разметки
 * @param {string} template Разметка в виде строки
 * @returns {HTMLElement} Созданный элемент
 */
function createElement(template) {
    const newElement = document.createElement('div');
    newElement.innerHTML = template;

    return newElement.firstElementChild;
}

export {createElement};
