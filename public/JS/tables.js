$('#Search').on('keyup', function() {
    $("#noData").remove();
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#Data').find('tr').each(function() {
        counter++;
        if (!($(this).find('td').text().search(patt) >= 0)) {
            $(this).not('#header').hide();
            sw++;
        } else if (($(this).find('td').text().search(patt) >= 0)) {
            $(this).show();
        }
    });
    if (sw == counter) {
        $("#Data").append(`<tr id="noData">
        <td  class="red-text" colspan="2">Sorry no Data found</td>
      </tr>`);
    } else {
        $("#noData").remove();
    }
});