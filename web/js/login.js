var
    $form = $('form'),
    $userInput = $('.form-group').find('input'),
    $error = $('.alert-danger'),
// $remember = $('input[name=remember]'),
    $butAut = $('#but-aut');

// $form.validator();
$butAut.on('click', function () {
    var inputOnServer = $userInput.serializeArray();
    $.ajax({
        url: 'authorization.php',
        type: 'POST',
        data: inputOnServer,
        dataType: 'json',
        success: function (json_data) {
            localStorage.clear();
            for (var key in json_data) {
                localStorage.setItem(key, json_data[key]);
                // if ($remember.prop('checked')) {
                //     localStorage.setItem('company',$('input[name=company]').val());
                //     localStorage.setItem('password',$('input[name=password]').val());
                // }
                location.replace('partners.php?NICK=' + localStorage.partnersId);
            }
        },
        error: function () {
            $error.removeClass('hidden');
        }
    });
    return false;
});


