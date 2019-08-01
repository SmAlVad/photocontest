const Inputmask = require('inputmask');

const POTOCONTEST_ID = 1;

const fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
];

//TODO: Переписать без jquery

// Добавление фотографии
if (window.location.pathname === '/karapuzy/participate') {
    const input = document.querySelector('#files');
    const preview = document.querySelector('.preview');

    $(document).ready(function () {
        let mask = new Inputmask("+7-999-999-9999");
        mask.mask('#tel');
    });

    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        let curFiles = input.files;

        if (curFiles.length === 0) {

            let para = document.createElement('p');
            para.textContent = 'Файлы для загрузки не выбраны';
            preview.appendChild(para);

        } else {

            let list = document.createElement('ol');
            preview.appendChild(list);

            let len = curFiles.length < 3 ? curFiles.length : 3;

            for (let i = 0; i < len; i++) {
                let listItem = document.createElement('li');
                let para = document.createElement('p');

                if (validSize(curFiles[i])) {

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


//TODO: Надо переписать без jquery

// Голосование за фотографию
$('.like-image').on('click', function () {
    // Была идея запрашивать геолокацию
    // Про геолокацию https://developers.google.com/web/fundamentals/native-hardware/user-location/?hl=ru

    // ID фотографии в БД
    let imageId = $(this).data('id');

    let ip = false;

    // Проверяем IP голосующего
    $.ajax({
        url: '/api/get-ip',
        //async: true,
        dataType: 'JSON',
        type: "GET",
        data: '',
        beforeSend: function () {
            $('#loader-wrapper').show();
            $('#like-loader-box').show();
        },
        success: function (data) {

            if (data.status === 'success') {
                if (data.country === 'Russia') {
                    // Отправляем запрос на добавление голоса
                    like(imageId);
                } else {
                    showErrorMessage('В голосовании могут принимать участие только люди находящиеся на территории России', 3000);
                }
            } else {
                showErrorMessage('Невозможно определить откуда вы пришли', 3000);
            }
        },
        error: function () {
            showErrorMessage('Невозможно определить откуда вы пришли', 2000);
        }
    });
});

// AJAX запрос на добавление голоса в БД
function like(imageId) {
    $.ajax({
        url: '/api/like-photo',
        // async: true,
        type: "POST",
        data: `imageId=${imageId}&photocontestId=${POTOCONTEST_ID}`,
        success: function (data) {
            if (data.success === true) {
                // Посетителю разрешили проголосовать
                if (data.canLike === true) {
                    showSuccessMessage('Ваш голос принят! Золотой Грамофон!', 2000);
                    $('#like-counter-' + imageId).text(data.like);
                } else {
                    let msg = `Вы голосовали ${data.lastHit}! Приходите завтра!`;
                    showErrorMessage(msg, 5000)
                }
            } else {
                showErrorMessage(data.error);
            }
        },
        error: function () {
            showErrorMessage('Произошла ошибка при проверки пользователя', 3000);
        }
    });
}

function validFileType(file) {
    for (let i = 0; i < fileTypes.length; i++) {
        if (file.type === fileTypes[i]) {
            return true;
        }
    }

    return false;
}

function validSize(file) {
    return file.size < 5242880;
}

function returnFileSize(number) {
    if (number < 1024) {
        return number + 'bytes';
    } else if (number >= 1024 && number < 1048576) {
        return (number / 1024).toFixed(1) + 'KB';
    } else if (number >= 1048576) {
        return (number / 1048576).toFixed(1) + 'MB';
    }
}

function showSuccessMessage(text, timeOut) {
    $('#like-loader-box').hide();
    $('#like-success').text(text).fadeIn(300);

    setTimeout(function () {
        $('#like-success').fadeOut(300);
        $('#loader-wrapper').fadeOut(400);
    }, timeOut)
}

function showErrorMessage(text, timeOut) {
    $('#like-loader-box').hide();
    $('#like-error').text(text).fadeIn(300);

    setTimeout(function () {
        $('#like-error').fadeOut(300);
        $('#loader-wrapper').fadeOut(400);
    }, timeOut)
}


