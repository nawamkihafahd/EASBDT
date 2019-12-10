const IDRV = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).format(true);
const IDRR = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).value;

var currentMenu=null
var arrayMenu=null

$(document).ready(function() {
    currentMenu=getCurrentMenu()
    arrayMenu = new Array(currentMenu.length).fill(false)
    var run= setInterval(function() {
        $.ajax({
            type : "GET",
            url : "/live/refresh",
        }).done(function (msg){
            if(msg.status!=200){
                alert(msg.msg);
            }else{
                updateAll(msg.msg);
            }
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
    }, 15 * 1000);
    $('.harga').each(function (){
        let temp = $(this).html();
        $(this).html(IDRV(temp));
    });
})

function refreshWindow(){
    $('#notif').append(`
    <div class="alert alert-warning" role="alert">
        List menu berubah, merefresh halaman dalam 3 detik
    </div>
    `)
    setTimeout(function() {window.location.reload();}, 3000)
}


function updateAll(data){
    if(currentMenu.length!=data.length){
        refreshWindow()
        return false
    }

    for (let i=0;i<data.length;i++){
        let eachData=data[i]
        if(currentMenu.includes(eachData.id_menu)){
            let terjual=$('#'+eachData.id_menu+' .terjual');
            terjual.html(eachData.terjual);
            arrayMenu[i]=true
        }else{
            refreshWindow()
            return false;
        }
    }
    if($.inArray(false,arrayMenu)!=-1){
        refreshWindow()
        return false;
    }else{
        arrayMenu=new Array(currentMenu.length).fill(false)
    }
}

function getCurrentMenu(){
    let allMenu=[]
    let menu=$('.live-menu');
    for (let i=0;i<menu.length;i++){
        let eachMenu=menu[i];
        allMenu.push(parseInt(eachMenu.id));
    }
    return allMenu;
}