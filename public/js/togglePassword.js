const oko = document.querySelector('#registraciaOko');
const heslo = document.querySelector('#password');
const otvorene = document.querySelector('#okoOtvorene');
const zatvorene = document.querySelector('#okoZatvorene');
oko.addEventListener('click', function (e) {

    if (heslo.getAttribute('type') === 'password') {
        heslo.setAttribute('type', 'text');
        zatvorene.setAttribute('class', 'bi bi-eye-slash d-none');
        otvorene.setAttribute('class', 'bi bi-eye d-flex');
    }
    else {
        heslo.setAttribute('type', 'password');
        otvorene.setAttribute('class', 'bi bi-eye d-none');
        zatvorene.setAttribute('class', 'bi bi-eye-slash d-flex');
    }
});
