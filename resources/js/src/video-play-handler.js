const videoPlayButtonHandler = function (e) {
  let $btn = e.target;
  let $video = $btn.previousElementSibling;

  $btn.setAttribute('style', 'display:none;')
  $video.setAttribute('controls', 'true');
  $video.setAttribute('style', 'object-fit: contain;');
  $video.play();
}

export {videoPlayButtonHandler};
