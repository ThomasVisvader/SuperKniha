const btn = document.querySelector('#detailZobrazitViac');

const obsahCast = document.querySelector('#detailObsahCast');
const obsahCely = document.querySelector('#detailObsahCely');

function showMore() {
    if (obsahCast.style.display === 'none'){
        obsahCast.style.display = 'flex';
        obsahCely.style.display = 'none';
    }
    else {
        obsahCast.style.display = 'none';
        obsahCely.style.display = 'flex';
    }
    if(btn.innerHTML === "Zobraziť viac") {
        btn.innerHTML = "Zobraziť menej";
    }
    else {
        btn.innerHTML = "Zobraziť viac";
    }
}




