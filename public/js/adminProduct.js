const series = document.querySelector('#seriesDiv');
const volume = document.querySelector('#volumeDiv');
const quantity = document.querySelector('#quantityDiv');
const format = document.querySelector('#formatDiv');
const publisher = document.querySelector('#publisherDiv');
const page_count = document.querySelector('#pageCountDiv');
const length = document.querySelector('#lengthDiv');
const isbn = document.querySelector('#isbnDiv');

const authorLabel = document.querySelector('#authorLabel');

function addInput(input, count){
    var filename = input.value;
    var filetype = filename.substr(filename.lastIndexOf(".")+1);
    const allowed = ['jpg', 'jpeg', 'png'];
    if (!allowed.includes(filetype)) {
        input.value = '';
        alert("Súbor musí byť typu .jpg, .jpeg alebo .png");
        return;
    }
    var parent = input.parentElement;
    var sibling = parent.nextElementSibling;
    if (input.value === '') {
        removeInput(input);
        return;
    }
    if (sibling === null) {
        count++;
        const newdiv = document.createElement('div');
        newdiv.innerHTML = "<label for=\"obrazok" + count + "\" class=\"form-label\" >Vyberte obrázok " + count + "</label>\n " +
            "<input class=\"form-control pridatObrazok\" type=\"file\" id=\"obrazok" + count + "\" name=\"obrazok" + count + "\" " +
            "accept=\".png,.jpeg, .jpg\" onchange=\"addInput(this, " + count + ")\"/>";
        document.getElementById('zoznamObrazkov').appendChild(newdiv);
    }
}

function removeInput(btn){
    var count = 1;
    btn.parentNode.remove();
    var list = document.querySelector("#zoznamObrazkovOld");
    if (list !== null) {
        var divs = list.querySelectorAll("div");
        for (let i = 0; i < divs.length; i++) {
            var figcaption = divs.item(i).childNodes.item(1).childNodes.item(1);
            figcaption.innerHTML = "Obrázok " + (i + 1);
            var input = divs.item(i).childNodes.item(3);
            input.name = "obrazok" + (i + 1);
            count++;
        }
    }

    var newimages = document.querySelector("#zoznamObrazkov");
    var newdivs = newimages.querySelectorAll("div");
    var label;
    var image;
    console.log(newdivs.item(0).children);
    for (let i = 0; i < newdivs.length; i++) {
        label = newdivs.item(i).children.item(0);
        label.htmlFor = "obrazok" + count;
        image = newdivs.item(i).children.item(1);
        image.name = "obrazok" + count;
        image.id = "obrazok" + count;
        var newImage = document.querySelector("#obrazok" + count);
        newImage.setAttribute('onchange', "addInput(this, " + count + ")");
        if (count === 1) {
            label.innerHTML = "Vyberte obrázok 1<span class=\"poleRequired\" data-toggle='tooltip' title=\"Povinné pole\">*</span>";
            newImage.required = true;
        }
        else {
            label.innerHTML = "Vyberte obrázok " + count;
        }
        count++;
    }


}

function hideInputs(types) {
    switch(types.value) {
        case 'kniha':
            series.style.display = 'block';

            volume.style.display = 'block';

            quantity.style.display = 'block';
            quantity.required = true;

            format.style.display = 'block';

            publisher.style.display = 'block';

            page_count.style.display = 'block';

            length.style.display = 'none';

            isbn.style.display = 'block';

            authorLabel.innerHTML = 'Meno autora';
            break;
        case 'audiokniha':
            series.style.display = 'block';

            volume.style.display = 'block';

            quantity.style.display = 'none';
            quantity.required = false;

            format.style.display = 'none';

            publisher.style.display = 'block';

            page_count.style.display = 'none';

            length.style.display = 'block';

            isbn.style.display = 'none';

            authorLabel.innerHTML = 'Meno autora';
            break;
        case 'ekniha':
            series.style.display = 'block';

            volume.style.display = 'block';

            quantity.style.display = 'none';
            quantity.required = false;

            format.style.display = 'none';

            publisher.style.display = 'block';

            page_count.style.display = 'block';

            length.style.display = 'none';

            isbn.style.display = 'block';

            authorLabel.innerHTML = 'Meno autora';
            break;
        case 'film':
            series.style.display = 'block';

            volume.style.display = 'block';

            quantity.style.display = 'block';
            quantity.required = true;

            format.style.display = 'none';

            publisher.style.display = 'none';

            page_count.style.display = 'none';

            length.style.display = 'block';

            isbn.style.display = 'none';

            authorLabel.innerHTML = "Meno režiséra";
            break;
        case 'hudba':
            series.style.display = 'none';

            volume.style.display = 'none';

            quantity.style.display = 'block';
            quantity.required = true;

            format.style.display = 'none';

            publisher.style.display = 'none';

            page_count.style.display = 'none';

            length.style.display = 'block';

            isbn.style.display = 'none';

            authorLabel.innerHTML = 'Meno interpreta';
            break;
    }
}
