var $countRow = 0;
$('#btn').on('click', function () {
    $('tbody tr').each(function () {
        var row = {fields: []};

        $(this).find('td').each(function () {
                var $tdHtml = $(this).html();
                row.fields.push($tdHtml);
            }
        );
        $.ajax({
            url: '/parse',
            method: 'POST',
            data: row,
            beforeSend: function () {
                console.log($countRow);
            },
            success: function (res) {
                // $('#ajax-text').append(res);
                // console.log($countRow++);
            },
            error: function (error) {
                alert('Error!!!');
                console.log(row);
            }
        });

    });
});
