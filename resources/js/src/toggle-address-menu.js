const pageBodyElement = document.body;
const modalAddress = document.querySelector('.navigation__addresses');
const hamburger = document.querySelector('#hamburger-menu');
const mainHeaderElement = document.querySelector('.main-header');

const toggleAddressMenu = function () {
  const mobileMenu = mainHeaderElement.querySelector('.main-header__mobile-menu');

  if (mobileMenu){
    mobileMenu.remove();
    pageBodyElement.classList.remove('hide-overflow');
    hamburger.classList.remove('hamburger-menu--active');
  }

  modalAddress.classList.toggle('navigation__addresses--active');
}

export {toggleAddressMenu};
