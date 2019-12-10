const IDRV = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).format(true);
const IDRR = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).value;

$(document).ready(function() {
    $('.harga').each(function (){
        let temp = $(this).html();
        $(this).html(IDRV(temp));
    });
    $('input:radio').on('change',function(e){
        id=e.currentTarget.name.split("-");
        $.ajax({
            type : "GET",
            url : "ajaxStatusMenu/"+id[1]+"/",
        }).fail(function(x,e){
            if (x.status==0) {
                alert('You are offline!!\n Please Check Your Network.');
            } else if(x.status==404) {
                alert('Requested URL not found.');
            } else if(x.status==500) {
                alert('Internel Server Error.');
            } else if(e=='parsererror') {
                alert('Error.\nParsing JSON Request failed.');
            } else if(e=='timeout'){
                alert('Request Time out.');
            } else {
                alert('Unknow Error.\n'+x.responseText);
            }
        });
    });
    // console.log($('#table-menu'));
    $('#table-menu').DataTable();
}); 