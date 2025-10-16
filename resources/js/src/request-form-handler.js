import ErrorInputView from "../view/error-input-view.js";
import PopupView from "../view/popup-view.js";

async function handleFormSubmit(event) {
  event.preventDefault();
  const form = event.target;
  const url = form.action;
  const formButton = form.querySelector('button[type="submit"]');
  formButton.setAttribute('disabled', '')
  if(form.place) {
    form.place.value = form.dataset.name;
  }
  const errorElementClass = '.' + ErrorInputView.getElementClass();
  const errorElements = form.querySelectorAll(errorElementClass);

  try {
    const formData = new FormData(form);
    const responseData = await postFormDataAsJson({ url, formData });

    if ('error' in responseData) {

      formButton.removeAttribute('disabled');
      delete responseData['error'];

      //очищаю каждый раз сообщения с ошибками, правильно ли это? по другому не пропадали ошибки которых не было в повторной неправильной валидации
      errorElements.forEach(element => element.remove());

      Object.entries(responseData).forEach((entry) => {
        const [key, value] = entry;
        const errorElement = new ErrorInputView(value).element;
        form[key].parentElement.appendChild(errorElement).textContent = value;
      });
    }

    if ('baseError' in responseData || 'telegramError' in responseData || 'dashaMainError' in responseData) {
      formButton.removeAttribute('disabled');
      showPopupMessage(false);
    }

    if ('success' in responseData) {
      formButton.removeAttribute('disabled');
      if (errorElements.length > 0) {
        errorElements.forEach(element => element.remove());
      }
      showPopupMessage();
    }

  } catch (error) {
    showPopupMessage(false);
  }
}

function showPopupMessage (isSuccess = true) {
  const pageBodyElement = document.body;
  const popupElement = new PopupView(isSuccess).element;
  pageBodyElement.insertAdjacentElement('beforeend', popupElement);

  const escKeyDownHandler = (evt) => {
    if (evt.key === 'Escape' || evt.key === 'Esc') {
      evt.preventDefault();
      popupElement.remove();
      document.removeEventListener('keydown', escKeyDownHandler);
    }
  };

  document.addEventListener('keydown', escKeyDownHandler);

  popupElement.querySelector('.popup__button').addEventListener('click', () => {
    popupElement.remove();
    document.removeEventListener('keydown', escKeyDownHandler);
  });
}

async function postFormDataAsJson({ url, formData }) {
  const plainFormData = Object.fromEntries(formData.entries());
  const formDataJsonString = JSON.stringify(plainFormData);

  const fetchOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
    },
    body: formDataJsonString,
  };
  const response = await fetch(url, fetchOptions);

  if (!response.ok) {
    const errorMessage = await response.text();
    throw new Error(errorMessage);
  }

  return response.json();
}

export {handleFormSubmit}
