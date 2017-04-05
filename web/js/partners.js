$('#btn').on('click', function () {
    $.ajax({
        url: '/partners/search',
        method:'POST',
        data: {name: 'Artem', age: '28'},
        dataType:'html',
        beforeSend:function(){
            alert('Отправка...');
        },
        success: function (res) {
            console.log('ok');
            $('#ajax-text').html(res);
        },
        error: function () {
            alert('Error!!!');
        }
    });
});
