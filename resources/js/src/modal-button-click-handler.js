const pageBodyElement = document.body;
const bodyPaddingRightValue = window.innerWidth - document.querySelector('body').offsetWidth + 'px';

const buttonModalClickHandler = function(modalElement, evt) {
  pageBodyElement.style.paddingRight = bodyPaddingRightValue;
  modalElement.style.display = 'block';
  pageBodyElement.style.overflowY = 'hidden';
  pageBodyElement.style.overflow = 'hidden';
  modalElement.querySelector('.request-form').dataset.name = evt.target.dataset.name;
  const modalRequestClose = modalElement.querySelector('.modal-request__close-button');
  if(evt.target.dataset.name === 'Заказать книгу') {
    modalElement.querySelector('.request-form__button').innerHTML = 'Заказать';
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      modalElement.style.display = 'none';
      pageBodyElement.style.overflowY = 'visible';
      pageBodyElement.style.paddingRight = '0';
    }
  })

  window.onclick = function (event) {
    if (event.target === modalElement) {
      modalElement.style.display = 'none';
      pageBodyElement.style.overflowY = 'visible';
      pageBodyElement.style.paddingRight = '0';
    }
  }

  modalRequestClose.onclick = function () {
    modalElement.style.display = 'none';
    pageBodyElement.style.overflowY = 'visible';
    pageBodyElement.style.paddingRight = '0';
  }
}

export {buttonModalClickHandler};
