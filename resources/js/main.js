import {handleFormSubmit} from "./src/request-form-handler.js";
import {toggleAddressMenu} from "./src/toggle-address-menu.js";
import {toggleHamburgerMenu} from "./src/toggle-hamburger-menu.js";
import {videoPlayButtonHandler} from "./src/video-play-handler.js";
import {buttonModalClickHandler} from "./src/modal-button-click-handler.js";

document.addEventListener('DOMContentLoaded', function () {
    const requestButtons = document.querySelectorAll('.index-intro__primary-button, .lessons-price__button, .online-lessons__primary-button, .school-intro__button, .school-promo__button, .trial-class__button, .request-button, .book__button',);
    const modalRequest = document.querySelector('.modal-request--request');
    const requestForms = document.querySelectorAll('.request-form--request');
    const addressPin = document.querySelector('.navigation__address-button');
    const hamburger = document.querySelector('#hamburger-menu');
    const ratingRapidButton = document.querySelector('.block-rating__toggle-rapid');
    const ratingClassicButton = document.querySelector('.block-rating__toggle-classic');
    const ratingList = document.querySelectorAll('.block-rating__item');
    const videoButtonReviews = document.querySelectorAll('.index-reviews__video-button');
    const subscribeButtons = document.querySelectorAll('.index-intro__secondary-button, .school-intro__secondary-button, .education-level__button');
    const modalSubscribe = document.querySelector('.modal-request--subscribe');
    const subscriptionForms = document.querySelectorAll('.request-form--subscribe');
    const registerForm = document.querySelector('.register-form')

    //Добавляем обработчик кнопок для передачи в модальную форму расположения кнопки вызова.

        //Модальное окно "Заявка"
    if (modalRequest) {
        if (requestButtons.length > 0) {
            requestButtons.forEach((button) => {
                button.addEventListener('click', (evt) => buttonModalClickHandler(modalRequest, evt))
            })
        }
    }
        //Модальное окно "Подписка"
    if (modalSubscribe) {
        if (subscribeButtons.length > 0) {
            subscribeButtons.forEach((button) => {
                button.addEventListener('click', (evt) => buttonModalClickHandler(modalSubscribe, evt))
            })
        }
    }

    //Отправка формы "Заявка"
    if(requestForms.length > 0) {
        requestForms.forEach(requestForm => {
            requestForm.addEventListener('submit', handleFormSubmit);
        })
    }

    //Форма "Подписка"
    if(subscriptionForms.length > 0) {
        subscriptionForms.forEach(subscriptionForm => {
            subscriptionForm.addEventListener('submit', handleFormSubmit);
        })
    }

    //Форма "Регистрация Пользователя"
/*    if(registerForm) {
        registerForm.addEventListener('submit', handleFormSubmit);
    }*/

    //Модальное меню
    if (hamburger) {
        hamburger.addEventListener('click', e => {
            toggleHamburgerMenu();
        });
    }

    //Модальное окно адресов
    if (addressPin) {
        addressPin.addEventListener('click', () => {
            toggleAddressMenu();
        });
    }

    //Смена рейтинга
    if (ratingRapidButton) {
        ratingRapidButton.addEventListener('click', function () {
            if (ratingList[0].style.display === 'none') {
                ratingList[0].style.display = 'grid';
                ratingList[1].style.display = 'none';
                ratingClassicButton.classList.remove('block-rating__toggle-classic--active');
                ratingRapidButton.classList.add('block-rating__toggle-rapid--active');
            }
        });
    }
    if (ratingClassicButton) {
        ratingClassicButton.addEventListener('click', function () {
            if (ratingList[1].style.display === 'none') {
                ratingList[1].style.display = 'grid';
                ratingList[0].style.display = 'none';
                ratingRapidButton.classList.remove('block-rating__toggle-rapid--active');
                ratingClassicButton.classList.add('block-rating__toggle-classic--active');
            }
        });
    }

    //Видео отзывы
    if (videoButtonReviews.length > 0) {
        videoButtonReviews.forEach((button) => {
            button.addEventListener('click', videoPlayButtonHandler)
        })
    }

    //Лейзи Видео
    var lazyVideos = [].slice.call(document.querySelectorAll(".index-video__videofile.lazy, .camp-intro__video-videofile.lazy"));
    if ("IntersectionObserver" in window) {
        var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(video) {
                if (video.isIntersecting) {
                    for (var source in video.target.children) {
                        var videoSource = video.target.children[source];
                        if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                            videoSource.src = videoSource.dataset.src;
                        }
                    }

                    video.target.load();
                    video.target.play();
                    video.target.classList.remove("lazy");
                    lazyVideoObserver.unobserve(video.target);
                }
            });
        });

        lazyVideos.forEach(function(lazyVideo) {
            lazyVideoObserver.observe(lazyVideo);
        });
    }
});

$(document).ready(function () {

    //Слайдер Лагерь > Локация
    $('.camp-location__slider').slick({
        slidesToShow: 1,
        variableWidth: true,
        dots: true,
        arrows: false,
        touchThreshold: 15,
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode:  true,
    });

    //Слайдер фото "Что такое шахматный клуб"
    $('.index-about__slider').slick({
        slidesToShow: 1,
        variableWidth: true,
        dots: true,
        arrows: true,
        touchThreshold: 15,
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode:  true,
        responsive: [
            {
                breakpoint: 1700,
                settings: {
                    arrows: false,
                }
            },
        ]
    });

    //Слайдер "Отзывы"
    $('.index-reviews__list').slick({
        slidesToShow: 1,
        touchThreshold: 15,
        initialSlide: 0,
        infinite: true,
        centerMode:  true,
        variableWidth: true,
        mobileFirst: true,
        dots: true,
        arrows: false,

        responsive:[
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    dots: false,
                    arrows: true,
                }
            },
            {
                breakpoint: 1700,
                settings: {
                    slidesToShow: 2,
                    centerMode: false,
                    dots: false,
                    arrows: true,
                }
            },
        ],
    });

    //Слайдер Акции
    $('.school-promo__list').slick({
        arrows: false,
        dots: true,
        slidesToShow: 1,
        variableWidth: true,
        touchThreshold: 15,
        infinite: false,
        centerMode: true,
        mobileFirst: true,

        responsive:[
            {
                breakpoint: 800,
                settings: {
                    arrows: true,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    arrows: true,
                    centerMode: false,
                    //variableWidth: true,
                    slidesToShow: 2,
                }
            },
        ],
    });

    //Слайдер Школа > О тренере
    $('.school-teacher__list').slick({
        arrows: false,
        dots: true,
        slidesToShow: 1,
        variableWidth: true,
        touchThreshold: 15,
        infinite: false,
        centerMode: true,
        mobileFirst: true,

        responsive:[
            {
                breakpoint: 639,
                settings: {
                    arrows: true,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    arrows: true,
                    variableWidth: true,
                    centerMode: true,
                }
            },
        ],
    });

    //Слайдер Галерея
    $('.gallery__list').slick({
        arrows: false,
        dots: true,
        slidesToShow: 1,
        variableWidth: true,
        touchThreshold: 15,
        infinite: true,
        centerMode: true,
        mobileFirst: true,

        responsive:[
            {
                breakpoint: 639,
                settings: {
                    arrows: true,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    arrows: true,
                    variableWidth: true,
                    centerMode: true,
                }
            },
        ],
    });

    if (window.innerWidth <=  1199) {
        //Слайдер Школа - Фичи
        $('.school-intro__features-list').slick({
            arrows: false,
            dots: true,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: true,
            centerMode: true,
            mobileFirst: true,

            responsive:[
                {
                    breakpoint: 640,
                    settings: {
                        arrows: true,
                    }
                },
            ],
        });

        // Слайдер "Цены"
        let lessonList = $('.lessons-price__list');
        lessonList.slick({
            infinite: false,
            slidesToShow: 1,
            initialSlide: 0,
            variableWidth: true,
            dots: true,
            touchThreshold: 15,
            arrows: false,
            mobileFirst: true,
            centerMode: true,

            responsive:[
                {
                    breakpoint: 810,
                    infinite: false,
                    settings: {
                        arrows: true,
                    }
                },
            ],
        });

        lessonList.on('afterChange', function(event, slick, currentSlide, nextSlide){
            $('.slider-number__wrapper').text(currentSlide+1)
        });

        // Слайдер "О Павле"
        $('.about-coach__list').slick({
            arrows: false,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: true,
            centerMode: true,
            mobileFirst: true,
            dots: true,

            responsive:[
                {
                    breakpoint: 640,
                    settings: {
                        arrows: true,
                        dots: false,
                    }
                },
            ]
        });

        //Слайдер "Новости"
        $('.index-news__list').slick({
            arrows: false,
            dots: true,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: true,
            centerMode: true,
        });

        //Слайдер адресса
        $('.index-location__features-list').slick({
            arrows: false,
            dots: true,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: true,
            centerMode: true,
            mobileFirst: true,

            responsive:[
                {
                    breakpoint: 640,
                    settings: {
                        arrows: true,
                    }
                },
            ],
        });

    }

    if (window.innerWidth <= 639) {
        //Слайдер Школа - группы
        $('.school-groups__list').slick({
            arrows: false,
            dots: true,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: false,
            centerMode: true,
        });

        //Слайдер Уровни обучения
        let levelList = $('.education-level__list');
        levelList.slick({
            arrows: false,
            dots: true,
            slidesToShow: 1,
            variableWidth: true,
            touchThreshold: 15,
            infinite: false,
            centerMode: true,
        });

        levelList.on('afterChange', function(event, slick, currentSlide, nextSlide){
            $('.slider-number__wrapper').text(currentSlide+1)
        });
    }
});

setTimeout(function() {
    if(window.localStorage.getItem('isPolicy')!== 'undefined' &&  window.localStorage.getItem('isPolicy') !== 'false') {

        const popupPolicy = document.querySelector('.policy-popup');
        popupPolicy.style.display = "flex";
        const popupPolicyCloseButton = popupPolicy.querySelector('.policy-popup__button-close');

        popupPolicyCloseButton.addEventListener('click', (e)=>{
            e.target.parentElement.remove();
            window.localStorage.setItem('isPolicy', 'false');
        })
    }
}, (3000))


