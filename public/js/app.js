audio = document.getElementById("player");
cardImage = document.getElementById("imgCard");
container = document.getElementById("disc");
title = document.querySelector(".song-title");

var swiper = new Swiper(".swiper-container", {
  pagination: ".swiper-pagination",
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflow: {
    rotate: 20,
    stretch: 0,
    depth: 200,
    modifier: 1,
    slideshadow: true,
  },

  on: {
    slideChange: () => {
      const currentSlide =
        swiper.slides[swiper.activeIndex].getAttribute("data-audio");
      audio.src = currentSlide;
      audio.load();
      cardImage.src =
        swiper.slides[swiper.activeIndex].getAttribute("data-image");
      container.style.display = "none";
      title.innerHTML = audio.src;
    },
  },
});

const currentSlide =
  swiper.slides[swiper.activeIndex].getAttribute("data-audio");
audio.src = currentSlide;
console.log(audio.src);
audio.load();
cardImage.src = swiper.slides[swiper.activeIndex].getAttribute("data-image");

audio.addEventListener("play", () => {
  container.style.display = "block";
});

audio.addEventListener("pause", () => {
  container.style.display = "none";
});
