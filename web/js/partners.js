$('#btn').on('click', function () {
    $('tbody tr').each(function () {
        var row = [];
        $(this).find('td').each(function () {
                var
                    $site = $(this).find('a'),
                    $href=$site.attr('href'),
                    $td=$(this).html();
                if ($href) {
                    row.push({"href":$href,"title":$site.text()});
                }
                row.push({"fields":$td})
            }
        );
        // console.log(row);
        $.ajax({
            url: '/partners/search',
            method: 'POST',
            data: row,
            dataType: 'html',
            beforeSend: function () {

            },
            success: function (res) {

                $('#ajax-text').html(res);
            },
            error: function () {
                alert('Error!!!');
            }
        });
    });
});
