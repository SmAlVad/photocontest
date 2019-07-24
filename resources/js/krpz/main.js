const Inputmask = require('inputmask');

const fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
];

// Добавление фотографии
if (window.location.pathname === '/karapuzy/participate') {
    const input = document.querySelector('#files');
    const preview = document.querySelector('.preview');

    $(document).ready(function(){
        let mask = new Inputmask("+7-999-999-9999");
        mask.mask('#tel');
    });

    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {
        while(preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        let curFiles = input.files;

        if(curFiles.length === 0) {

            let para = document.createElement('p');
            para.textContent = 'Файлы для загрузки не выбраны';
            preview.appendChild(para);

        } else {

            let list = document.createElement('ol');
            preview.appendChild(list);

            let len = curFiles.length < 3 ? curFiles.length : 3;

            for(let i = 0; i < len; i++) {
                let listItem = document.createElement('li');
                let para = document.createElement('p');

                if(validSize(curFiles[i])) {

                    para.textContent = 'Имя файла ' + curFiles[i].name + ', размер ' + returnFileSize(curFiles[i].size) + '.';

                    let image = document.createElement('img');
                    image.src = window.URL.createObjectURL(curFiles[i]);

                    let inputDescription = document.createElement('input');
                    inputDescription.type = 'text';
                    inputDescription.placeholder = 'Добавьте небольшое описание фотографии';
                    inputDescription.className = 'uploaded-file-description';
                    inputDescription.name = curFiles[i].name.split('.').slice(0, -1).join('.');

                    listItem.appendChild(image);
                    listItem.appendChild(para);
                    listItem.appendChild(inputDescription);

                } else {
                    para.textContent = 'Имя файла ' + curFiles[i].name + ': Загружаемое изображение больше 5MB';
                    listItem.appendChild(para);
                }

                list.appendChild(listItem);
            }
        }
    }
}

// Голосование за фотографию
$('.like-image').on('click', function () {

    // Про геолокацию https://developers.google.com/web/fundamentals/native-hardware/user-location/?hl=ru

});

function validFileType(file) {
    for(let i = 0; i < fileTypes.length; i++) {
        if(file.type === fileTypes[i]) {
            return true;
        }
    }

    return false;
}

function validSize(file) {
    return file.size < 5242880;
}

function returnFileSize(number) {
    if(number < 1024) {
        return number + 'bytes';
    } else if(number >= 1024 && number < 1048576) {
        return (number/1024).toFixed(1) + 'KB';
    } else if(number >= 1048576) {
        return (number/1048576).toFixed(1) + 'MB';
    }
}
