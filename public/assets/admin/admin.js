$('.nav-sidebar a').each(function(){
  let location = window.location.protocol + '//' + window.location.host + '/admin/' + window.location.pathname.split("/")[2];
  let locationMain = window.location.protocol + '//' + window.location.host +  window.location.pathname;
  let link = this.href;
  if(link == location || link == locationMain){
    $(this).addClass('active');
  }
});

const inputDate = document.querySelector('input[type=date]');
const inputImage = document.querySelector('#inputImage');
const inputVideo = document.querySelector('#inputVideo');
const inputVideoBig = document.querySelector('#inputVideoBig');

let uploadedImage = "";
let uploadedCampImage = "";
let uploadedVideo = "";
let uploadedVideoBig = "";

//инициализируем выпадающий календарь
if(inputDate) {
  flatpickr(inputDate, {});
}

//добавляем превью к загрузке фотографий
if (inputImage) {
  inputImage.addEventListener('change', function () {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      uploadedImage = reader.result;
      document.querySelector('#uploadedImage').src = uploadedImage;
    });
    reader.readAsDataURL(this.files[0]);
  })
}

//Добавляем превью фото тренера для лагеря
const inputCampImage = document.querySelector('#inputCampImage');
if (inputCampImage) {
  inputCampImage.addEventListener('change', function () {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      uploadedCampImage = reader.result;
      document.querySelector('#uploadedCampImage').src = uploadedCampImage;
    });
    reader.readAsDataURL(this.files[0]);
  })
}

//добавляем превью к загрузке видео
if (inputVideo) {
  inputVideo.addEventListener('change', function () {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      uploadedVideo = reader.result;
      document.querySelector('#uploadedVideo').src = uploadedVideo;
    });
    reader.readAsDataURL(this.files[0]);
  })
}

//добавляем превью к загрузке большое видео
if (inputVideoBig) {
  inputVideoBig.addEventListener('change', function () {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      uploadedVideoBig = reader.result;
      document.querySelector('#uploadedVideoBig').src = uploadedVideoBig;
    });
    reader.readAsDataURL(this.files[0]);
  })
}

//Удаляем на 2 уровня вверх родительский эллемент
const DeleteButtons = document.querySelectorAll('.button-delete__second-level');
if (DeleteButtons.length > 0) {
  DeleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    })
  })
}

//Лагерь -> Добавляем новый ценник
const addCampPriceCardButton = document.querySelector('.camp-add-price-card-button');
if (addCampPriceCardButton) {

  addCampPriceCardButton.addEventListener('click', () => {
    let countCampPriceCards = document.querySelectorAll('.camp-price-card-list').length;
    let template = document.querySelector('.camp-price-card-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    })

    template.querySelector('.camp-price__h3').innerHTML = 'Ценник № ' + (countCampPriceCards + 1);
    template.querySelector('.camp-price__id__input').name = "campPrices[" + (countCampPriceCards) + "][id]";
    template.querySelector('.camp-price__is-discount__input').name = "campPrices[" + (countCampPriceCards) + "][is_discount]";
    template.querySelector('.camp-price__order__input').name = "campPrices[" + (countCampPriceCards) + "][order]";
    template.querySelector('.camp-price__title__input').name = "campPrices[" + (countCampPriceCards) + "][title]";
    template.querySelector('.camp-price__amount__input').name = "campPrices[" + (countCampPriceCards) + "][amount]";
    template.querySelector('.camp-price__description__input').name = "campPrices[" + (countCampPriceCards) + "][description]";
    template.querySelector('.camp-price__second_amount__input').name = "campPrices[" + (countCampPriceCards) + "][second_amount]";
    template.querySelector('.camp-price__second_description__input').name = "campPrices[" + (countCampPriceCards) + "][second_description]";

    document.querySelector('.camp-price-card-container').appendChild(template);
  });

}

//Лагерь -> Добавляем плашку что включено в цену
const addCampPriceIncludeButton = document.querySelector('.camp-add-price-include-button');

if(addCampPriceIncludeButton) {
  addCampPriceIncludeButton.addEventListener('click', () => {
    let countCampPriceIncludes = document.querySelectorAll('.camp-price-include-item').length;
    let template = document.querySelector('.camp-price-include-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.camp-price-include__id__input').name = "campPriceIncludes[" + (countCampPriceIncludes) + "][id]";
    template.querySelector('.camp-price-include__is-discount__input').name = "campPriceIncludes[" + (countCampPriceIncludes) + "][is_discount]";
    template.querySelector('.camp-price-include__order__input').name = "campPriceIncludes[" + (countCampPriceIncludes) + "][order]";
    template.querySelector('.camp-price-include__description__input').name = "campPriceIncludes[" + (countCampPriceIncludes) + "][description]";

    document.querySelector('.camp-price-include-container').appendChild(template);
  })
}

//Тренеры -> Добавляем достижения
const addTeacherAchievementButton = document.querySelector('.add-teacher-achievement-button');
if(addTeacherAchievementButton) {
  addTeacherAchievementButton.addEventListener('click', () => {

    let countTeacherAchievements = document.querySelectorAll('.achievement-container').length;
    let template = document.querySelector('.teacher-achievement-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.teacher-achievement-id-input').name = "achievement[" + (countTeacherAchievements) + "][id]";
    template.querySelector('.teacher-achievement-title-input').name = "achievement[" + (countTeacherAchievements) + "][title]";
    template.querySelector('.teacher-achievement-order-input').name = "achievement[" + (countTeacherAchievements) + "][order]";
    template.querySelector('.teacher-achievement-is-camp-input').name = "achievement[" + (countTeacherAchievements) + "][is_camp_achievement]";

    document.querySelector('.achievements-wrapper').appendChild(template);
  })
}

//Расписание -> Обучение
const addScheduleEducationButton = document.querySelector('.camp-add-education');
if (addScheduleEducationButton) {
  addScheduleEducationButton.addEventListener('click', () => {
    let countScheduleEducations = document.querySelectorAll('.camp-education-item').length;
    let template = document.querySelector('.camp-schedule-education-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.camp-education__id__input').name = "campEducations[" + (countScheduleEducations) + "][id]";
    template.querySelector('.camp-education__order__input').name = "campEducations[" + (countScheduleEducations) + "][order]";
    template.querySelector('.camp-education__time__input').name = "campEducations[" + (countScheduleEducations) + "][time]";
    template.querySelector('.camp-education__title__input').name = "campEducations[" + (countScheduleEducations) + "][title]";
    template.querySelector('.camp-education__description__input').name = "campEducations[" + (countScheduleEducations) + "][description]";

    document.querySelector('.camp-education-container').appendChild(template);
  })
}

//Расписание -> Еда
const addScheduleMealsButton = document.querySelector('.camp-add-meals');
if (addScheduleMealsButton) {
  addScheduleMealsButton.addEventListener('click', () => {
    let countScheduleMeals = document.querySelectorAll('.camp-meals-item').length;

    let template = document.querySelector('.camp-schedule-meals-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.camp-meals__id__input').name = "campMeals[" + (countScheduleMeals) + "][id]";
    template.querySelector('.camp-meals__order__input').name = "campMeals[" + (countScheduleMeals) + "][order]";
    template.querySelector('.camp-meals__time__input').name = "campMeals[" + (countScheduleMeals) + "][time]";
    template.querySelector('.camp-meals__title__input').name = "campMeals[" + (countScheduleMeals) + "][title]";
    template.querySelector('.camp-meals__description__input').name = "campMeals[" + (countScheduleMeals) + "][description]";

    document.querySelector('.camp-meals-container').appendChild(template);
  })
}

//Расписание -> Активности
const addScheduleActivityButton = document.querySelector('.camp-add-activity');
if (addScheduleActivityButton) {
  addScheduleActivityButton.addEventListener('click', () => {
    let countScheduleActivities = document.querySelectorAll('.camp-activity-item').length;
    let template = document.querySelector('.camp-schedule-activity-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.camp-activity__id__input').name = "campActivities[" + (countScheduleActivities) + "][id]";
    template.querySelector('.camp-activity__order__input').name = "campActivities[" + (countScheduleActivities) + "][order]";
    template.querySelector('.camp-activity__time__input').name = "campActivities[" + (countScheduleActivities) + "][time]";
    template.querySelector('.camp-activity__title__input').name = "campActivities[" + (countScheduleActivities) + "][title]";
    template.querySelector('.camp-activity__description__input').name = "campActivities[" + (countScheduleActivities) + "][description]";

    document.querySelector('.camp-activity-container').appendChild(template);
  })
}

//Добавляем фотографии для блока о Лагере
const campFeaturesItems = document.querySelectorAll('.camp-features-item');

if (campFeaturesItems.length > 0) {

  campFeaturesItems.forEach((campFeaturesItem) => {
    let input = campFeaturesItem.querySelector('.custom-file-input');
    let uploadedCampAboutImage = '';

    input.addEventListener('change', function (uploadedCampAboutImage) {

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        uploadedCampAboutImage = reader.result;

        campFeaturesItem.querySelector('.camp-features__image').src = uploadedCampAboutImage;
      });
      reader.readAsDataURL(this.files[0]);
    })

  })

}

//О лагере -> Плашки на фотографиях

function AddCampFeatureItemsTemplate(e) {
  let itemTemplate = document.querySelector('.camp-feature-item-template').content.cloneNode(true);
  itemTemplate.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
    event.target.parentElement.parentElement.remove();
  });

  let countCampFeatureItems = e.target.parentElement.querySelectorAll('.camp-feature-items-wrapper').length;
  let numberFeature = e.target.parentElement.parentElement.querySelector('.camp-feature-item-number').dataset.campfeaturenumber;

  itemTemplate.querySelector('.camp-feature-item__id__input').name = "campFeatures[" + (numberFeature) + "][items][" + (countCampFeatureItems) + "][id]";
  itemTemplate.querySelector('.camp-feature-item__order__input').name = "campFeatures[" + (numberFeature) + "][items][" + (countCampFeatureItems) + "][order]";
  itemTemplate.querySelector('.camp-feature-item__title__input').name = "campFeatures[" + (numberFeature) + "][items][" + (countCampFeatureItems) + "][title]";

  e.target.parentElement.appendChild(itemTemplate);
}

let addCampFeatureItemButtons = document.querySelectorAll('.camp-add-feature-items');
if (addCampFeatureItemButtons.length > 0) {
  addCampFeatureItemButtons.forEach((button) => {
    button.addEventListener('click', AddCampFeatureItemsTemplate);
  })
}

//О лагере -> Блоки
const addCampFeatureButton = document.querySelector('.camp-add-features');
if (addCampFeatureButton) {
  addCampFeatureButton.addEventListener('click', () => {
    let countCampFeatures = document.querySelectorAll('.camp-features-item').length;
    let template = document.querySelector('.camp-feature-template').content.cloneNode(true);
    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.camp-feature-item-number').dataset.campfeaturenumber = countCampFeatures;
    template.querySelector('.camp-features__id__input').name = "campFeatures[" + (countCampFeatures) + "][id]";
    template.querySelector('.camp-features__order__input').name = "campFeatures[" + (countCampFeatures) + "][order]";
    template.querySelector('.camp-features__title__input').name = "campFeatures[" + (countCampFeatures) + "][title]";
    template.querySelector('.camp-features__description__input').name = "campFeatures[" + (countCampFeatures) + "][description]";
    template.querySelector('.camp-features__image__input').name = "campFeatures[" + (countCampFeatures) + "][features_image]";
    let input = template.querySelector('.custom-file-input');
    let uploadedImageCamp = '';

    input.addEventListener('change', function (uploadedCampAboutImage) {

      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        uploadedCampAboutImage = reader.result;

        input.parentElement.parentElement.parentElement.querySelector('.camp-features__image').src = uploadedCampAboutImage;
      });
      reader.readAsDataURL(this.files[0]);
    })

    document.querySelector('.camp-features-container-wrapper').appendChild(template);

    let addCampFeatureItemButtons = document.querySelectorAll('.camp-add-feature-items');

    if (addCampFeatureItemButtons.length > 0) {
      addCampFeatureItemButtons.forEach((button) => {
        button.removeEventListener('click', AddCampFeatureItemsTemplate);
      })
    }

    if (addCampFeatureItemButtons.length > 0) {
      addCampFeatureItemButtons.forEach((button) => {
        button.addEventListener('click', AddCampFeatureItemsTemplate);
      })
    }
  })
}


//Слайдеры Локации -> Добавляем слайдер
const addSliderLocationButton = document.querySelector('.camp-add-location-slider-button');
if(addSliderLocationButton) {
  addSliderLocationButton.addEventListener('click', () => {

    let countSliders = document.querySelectorAll('.location-slider__wrapper').length;
    let template = document.querySelector('.location-slider__template').content.cloneNode(true);

    template.querySelector('.button-delete__second-level').addEventListener('click', (event)=>{
      event.target.parentElement.parentElement.remove();
    });

    template.querySelector('.location-slider__input-id').name = "slider[" + (countSliders) + "][id]";
    template.querySelector('.location-slider__input-order').name = "slider[" + (countSliders) + "][order]";
    template.querySelector('.location-slider__input-image_prev').name = "slider[" + (countSliders) + "][image_prev]";

    let input = template.querySelector('.location-slider__input-image_prev');
    input.addEventListener('change', function (image) {


      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        image = reader.result;

        input.parentElement.parentElement.querySelector('#uploadedImage').src = image;
      });
      reader.readAsDataURL(this.files[0]);
    })

    document.querySelector('.card-body').appendChild(template);
  })
}

//Слайдеры Галлереи -> Добавляем фото превью в инпут

const campGallerySlidersElements = document.querySelectorAll('.camp-gallery-slider__container');

if(campGallerySlidersElements.length > 0){
  campGallerySlidersElements.forEach((element) => {
    let inputPrev = element.querySelector('.camp-gallery-slider__input-image_prev');
    inputPrev.addEventListener('change', function (image){
      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        image = reader.result;

        element.querySelector('.uploadedImagePrev').src = image;
      });
      reader.readAsDataURL(this.files[0]);
    });

    let inputBig = element.querySelector('.camp-gallery-slider__input-image_big');
    inputBig.addEventListener('change', function (image) {
      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        image = reader.result;

        element.querySelector('.uploadedImageBig').src = image;
      });
      reader.readAsDataURL(this.files[0]);
    })
  })
}

//Слайдеры Галлереи -> Скрытые слайды
const addCampHiddenSliderButton = document.querySelector('.camp-hidden-slider-add-button');
if(addCampHiddenSliderButton) {
  addCampHiddenSliderButton.addEventListener('click', () => {
    let countHiddenSliders = document.querySelectorAll('.camp-hidden-slider__wrapper').length;
    let template = document.querySelector('.camp-hidden-slider__template').content.cloneNode(true);

    template.querySelector('.camp-hidden-slider__input-id').name = "hiddenSliders[" + (countHiddenSliders) + "][id]";
    template.querySelector('.camp-hidden-slider__input-order').name = "hiddenSliders[" + (countHiddenSliders) + "][order]";
    template.querySelector('.camp-hidden-slider__input-image_big').name = "hiddenSliders[" + (countHiddenSliders) + "][image_big]";

    let input = template.querySelector('.camp-hidden-slider__input-image_big');
    input.addEventListener('change', function (image) {


      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        image = reader.result;

        input.parentElement.parentElement.querySelector('.uploadedImageBig').src = image;
      });
      reader.readAsDataURL(this.files[0]);
    })

    document.querySelector('.camp-hidden-sliders').appendChild(template);
  })
}

const campHiddenGallerySliders = document.querySelectorAll('.camp-hidden-slider__wrapper');
if (campHiddenGallerySliders.length > 0) {
  campHiddenGallerySliders.forEach((element) => {
    let inputBig = element.querySelector('.camp-hidden-slider__input-image_big');
    inputBig.addEventListener('change', function (image) {
      const reader = new FileReader();
      reader.addEventListener('load', (evt) => {
        image = reader.result;

        element.querySelector('.uploadedImageBig').src = image;
      });
      reader.readAsDataURL(this.files[0]);
    })
  })
}
