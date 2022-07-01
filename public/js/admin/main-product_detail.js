const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
let itemarr = $$(".item-choose");
let contentarr = $$(".item-choose-content");
let App = {
    idvisbility: [true, false],
    render: function () {
        let i = 0;
        for (i = 0; i < contentarr.length; i++) {
            if (this.idvisbility[i] == true) {
                contentarr[i].style.display = "block";
            } else {
                contentarr[i].style.display = "none";
            }
        }
    },
    onClickEvent: function (indexitem) {},
    handleEvent: function () {
        itemarr.forEach((item, indexitem) => {
            item.onclick = (e) => {
                contentarr.forEach((item, indexcontent) => {
                    if (e.target.id == indexcontent) {
                        this.idvisbility[indexcontent] = true;
                        this.render();
                    } else {
                        this.idvisbility[indexcontent] = false;
                        this.render();
                    }
                });
            };
        });
    },
    start: function () {
        this.render();
        this.handleEvent();
        this.onClickEvent();
    },
};
App.start();
let slideIndex = 0;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides((slideIndex = n));
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
