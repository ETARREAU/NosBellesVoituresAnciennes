/*####################################
    Carousel de la page d'acceuil
#####################################*/

var slideIndex = 1;
showSlides(slideIndex);

// Controle avant / arrière.
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Numérotation des images
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}


/*#########################################
     Le titre de la page constructeur
#########################################*/


// transforme la chaine de charachtère en tableau pour chaque lettre
const createLetterArray = string => {
  return string.split('');
};

// créer les span pour entourer chaque lettre
const createLetterLayers = array => {
  return array.map(letter => {
    let layer = '';
    //specifie les types de conteneur entre les lettre et les espaces
    for (let i = 1; i <= 2; i++) {if (letter == ' ') {
        layer += '<span class="space"></span>';
      } else {
        layer += '<span class="letter-' + i + '">' + letter + '</span>';
      }
    };
    return layer;
  });
};

// entour chaque lettre d'une div
const createLetterContainers = array => {
  return array.map(item => {
    let container = '';
    container += '<div class="wrapper">' + item + '</div>';
    return container;
  });
};

// Ajuste la largeur et la hauteur des lettres
const spans = Array.prototype.slice.call(document.getElementsByTagName('span'));
outputLayers.then(() => {
  return spans.map(span => {
    setTimeout(() => {
      span.parentElement.style.width = span.offsetWidth + 'px';
      span.parentElement.style.height = span.offsetHeight + 'px';
    }, 250);
  });
}).then(() => {
  // then slide letters into view one at a time
  let time = 250;
  return spans.map(span => {
    time += 75;
    setTimeout(() => {
      span.parentElement.style.top = '0px';
    }, time);
  });
});
