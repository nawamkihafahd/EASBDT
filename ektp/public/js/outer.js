var graphPeakHour = null;

$(document).ready(function(){
    let month = $('meta[id="month"]').attr('content');
    let year = $('meta[id="year"]').attr('content');
    let date = $('meta[id="date"]').attr('content');
    searchGraphPeakHour();
})

function searchGraphPeakHour(){
    let hari = $('#select-peak-hour').val();
    $.ajax({ 
        type: 'GET', 
        url: '/outer/ajax/graphPeakHour', 
        data: {
            hari:hari
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphPeakHour(msg.data,msg.options);
        }else{
            alert(msg);
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
}

function refreshGraphPeakHour(data,options){
    
    if(graphPeakHour==null){
        graphPeakHour = new Chart('graphPeakHour', {
            type: 'bar',
            data: data,
            options: options
        });
    }else{
        graphPeakHour.data=data;
        graphPeakHour.update();
    }
    
}