import MobileMenuView from "../view/mobile-menu-view.js";
const pageBodyElement = document.body;

const toggleHamburgerMenu = function() {
  const mainHeaderElement = document.querySelector('.main-header');
  const mobileMenuElement = mainHeaderElement.querySelector('.main-header__mobile-menu');
  const menuItemElements = mainHeaderElement.querySelectorAll('.navigation__menu-item');

  if(!mobileMenuElement) {
    window.scrollTo(0, 0)
    const mobileMenuComponent = new MobileMenuView();
    pageBodyElement.classList.add('hide-overflow');
    mainHeaderElement.insertAdjacentElement('beforeend', mobileMenuComponent.element);
    menuItemElements.forEach((item) => {

      let newItem = item.cloneNode(true)
      mobileMenuComponent.element.querySelector('.navigation__menu--mobile').appendChild(newItem);
      newItem.addEventListener('click', () => {
        mainHeaderElement.querySelector('.main-header__mobile-menu').remove();
        pageBodyElement.classList.remove('hide-overflow');
      })
    } )
  } else {
    mobileMenuElement.remove();
    pageBodyElement.classList.remove('hide-overflow');
  }
}

/*const toggleHamburgerMenu = function() {
    const mobileMenuElement = mainHeaderElement.querySelector('.main-header__mobile-menu');

    if(!mobileMenuElement) {
        window.scrollTo(0, 0);
        hamburger.classList.add('hamburger-menu--active');
        document.querySelector('.page__body').classList.add('hide-overflow');
        mainHeaderElement.insertAdjacentHTML('beforeend',
            `
            <div class="main-header__mobile-menu">
                <div class="main-header__mobile-menu-container">
                    <ul class="navigation__menu navigation__menu--mobile">

                    </ul>
                </div>
            </div>
            `);
        menuItemElements.forEach((item) => {

            let newItem = item.cloneNode(true)
            mainHeaderElement.querySelector('.navigation__menu--mobile').appendChild(newItem);
            newItem.addEventListener('click', () => {
                mainHeaderElement.querySelector('.main-header__mobile-menu').remove();
                pageBodyElement.classList.remove('hide-overflow');
            })
        } )
    } else {
        mobileMenuElement.remove();
        pageBodyElement.classList.remove('hide-overflow');
        hamburger.classList.remove('hamburger-menu--active');
    }
}*/

export {toggleHamburgerMenu}
