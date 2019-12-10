var graphPeakHour = null;
var graphTotalPenjualanHarian = null;
var graphTotalPenjualanBulanan = null;
var graphJumlahTransaksiHarian = null;
var graphJumlahTransaksiBulanan = null;
var graphJumlahKeuntunganHarian = null;
var graphJumlahKeuntunganBulanan = null;
var graphTotalHargaPenjualHarian = null;
var graphTotalHargaPenjualBulanan = null;
var graphRankingMenuHarian = null;
var graphRankingMenuBulanan = null;


$(document).ready(function(){
    let month = $('meta[id="month"]').attr('content');
    let year = $('meta[id="year"]').attr('content');
    let date = $('meta[id="date"]').attr('content');
    searchGraphPeakHour();

/*    

    TOTAL PENJUALAN

*/

    searchGraphTotalPenjualan(date,year,'harian');
    searchGraphTotalPenjualan(0,year,'bulanan');

    var dh1=$("#date-total-penjualan-harian");
    dh1.on('change', function () {
        date=dh1.val();
        searchGraphTotalPenjualan(date,0,'harian');
    });

    var db1=$("#date-total-penjualan-bulanan")
    db1.datepicker( {
        format: " yyyy",
        viewMode: 'years', 
        minViewMode: 'years'
    })
    db1.on('changeDate', function (ev) {
        let year=ev.date.getFullYear();
        searchGraphTotalPenjualan(0,year,'bulanan');
    });


/*    

    TOTAL KEUNTUNGAN

*/

    searchGraphJumlahKeuntungan(date,year,'harian');
    searchGraphJumlahKeuntungan(0,year,'bulanan');

    var dh9=$("#date-jumlah-keuntungan-harian");
    dh9.on('change', function () {
        date=dh9.val();
        searchGraphJumlahKeuntungan(date,0,'harian');
    });

    var db9=$("#date-jumlah-keuntungan-bulanan")
    db9.datepicker( {
        format: " yyyy",
        viewMode: 'years', 
        minViewMode: 'years'
    })
    db9.on('changeDate', function (ev) {
        let year=ev.date.getFullYear();
        searchGraphJumlahKeuntungan(0,year,'bulanan');
    });


/*    

    JUMLAH TRANSAKSI

*/

    searchGraphJumlahTransaksi(date,year,'harian');
    searchGraphJumlahTransaksi(0,year,'bulanan');

    var dh2=$("#date-jumlah-transaksi-harian");
    dh2.on('change', function () {
        date=dh2.val();
        searchGraphJumlahTransaksi(date,0,'harian');
    });

    var db2=$("#date-jumlah-transaksi-bulanan")
    db2.datepicker( {
        format: " yyyy",
        viewMode: 'years', 
        minViewMode: 'years'
    })
    db2.on('changeDate', function (ev) {
        let year=ev.date.getFullYear();
        searchGraphJumlahTransaksi(0,year,'bulanan');
    });

/*    

    TOTAL HARGA PENJUAL

*/

    searchGraphTotalHargaPenjual(date,month,year,'bulanan');
    searchGraphTotalHargaPenjual(date,0,0,'harian');

    var dh3=$("#date-total-harga-penjual-harian");
    dh3.on('change', function () {
        date=dh3.val();
        searchGraphTotalHargaPenjual(date,0,0,'harian');
    });


    var db3=$("#date-total-harga-penjual-bulanan")
    db3.datepicker( {
        format: "mm-yyyy",
        viewMode: 1, 
        minViewMode: 1
    })
    db3.on('changeDate', function (ev) {
        let month=ev.date.getMonth()+1;
        let year=ev.date.getFullYear();
        searchGraphTotalHargaPenjual(0,month,year,'bulanan');
    });

/*    

    Ranking Menu

*/

    searchGraphRankingMenu(date,month,year,'bulanan');
    searchGraphRankingMenu(date,0,0,'harian');

    var dh4=$("#date-ranking-menu-harian");
    dh4.on('change', function () {
        date=dh4.val();
        searchGraphRankingMenu(date,0,0,'harian');
    });

    var db4=$("#date-ranking-menu-bulanan")
    db4.datepicker( {
        format: "mm-yyyy",
        viewMode: 1, 
        minViewMode: 1
    })
    db4.on('changeDate', function (ev) {
        let month=ev.date.getMonth()+1;
        let year=ev.date.getFullYear();
        searchGraphRankingMenu(0,month,year,'bulanan');
    });

})


function searchGraphPeakHour(){
    let hari = $('#select-peak-hour').val();
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphPeakHour', 
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

/*    

    TOTAL PENJUALAN

*/

function searchGraphTotalPenjualan(date,year,type){
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphTotalPenjualan', 
        data: {
            date:date,
            year:year,
            type:type
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphTotalPenjualan(msg.data,msg.options,msg.type);
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

function refreshGraphTotalPenjualan(data,options,type){
    if(type=='harian'){
        if(graphTotalPenjualanHarian==null){
            graphTotalPenjualanHarian = new Chart('graphTotalPenjualanHarian', {
                type: 'line',
                data: data,
                options: options
            });
        }else{
            graphTotalPenjualanHarian.data=data;
            graphTotalPenjualanHarian.update();
        }
    }else{
        if(graphTotalPenjualanBulanan==null){
            graphTotalPenjualanBulanan = new Chart('graphTotalPenjualanBulanan', {
                type: 'line',
                data: data,
                options: options
            });
        }else{
            graphTotalPenjualanBulanan.data=data;
            graphTotalPenjualanBulanan.update();
        }
    }
}

/*    

    JUMLAH TRANSAKSI

*/

function searchGraphJumlahTransaksi(date,year,type){
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphJumlahTransaksi', 
        data: {
            date:date,
            year:year,
            type:type
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphJumlahTransaksi(msg.data,msg.options,msg.type);
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

function refreshGraphJumlahTransaksi(data,options,type){
    if(type=='harian'){
        if(graphJumlahTransaksiHarian==null){
            graphJumlahTransaksiHarian = new Chart('graphJumlahTransaksiHarian', {
                type: 'bar',
                data: data,
                options: options
            });
        }else{
            graphJumlahTransaksiHarian.data=data;
            graphJumlahTransaksiHarian.update();
        }
    }else{
        if(graphJumlahTransaksiBulanan==null){
            graphJumlahTransaksiBulanan = new Chart('graphJumlahTransaksiBulanan', {
                type: 'bar',
                data: data,
                options: options
            });
        }else{
            graphJumlahTransaksiBulanan.data=data;
            graphJumlahTransaksiBulanan.update();
        }
    }
}


/*    

    TOTAL KEUNTUNGAN

*/

function searchGraphJumlahKeuntungan(date,year,type){
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphJumlahKeuntungan', 
        data: {
            date:date,
            year:year,
            type:type
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphJumlahKeuntungan(msg.data,msg.options,msg.type);
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

function refreshGraphJumlahKeuntungan(data,options,type){
    if(type=='harian'){
        if(graphJumlahKeuntunganHarian==null){
            graphJumlahKeuntunganHarian = new Chart('graphJumlahKeuntunganHarian', {
                type: 'bar',
                data: data,
                options: options
            });
        }else{
            graphJumlahKeuntunganHarian.data=data;
            graphJumlahKeuntunganHarian.update();
        }
    }else{
        if(graphJumlahKeuntunganBulanan==null){
            graphJumlahKeuntunganBulanan = new Chart('graphJumlahKeuntunganBulanan', {
                type: 'bar',
                data: data,
                options: options
            });
        }else{
            graphJumlahKeuntunganBulanan.data=data;
            graphJumlahKeuntunganBulanan.update();
        }
    }
}

/*    

    TOTAL HARGA PENJUAL

*/

function searchGraphTotalHargaPenjual(date,month,year,type){
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphTotalHargaPenjual', 
        data: {
            date:date,
            month:month,
            year:year,
            type:type
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphTotalHargaPenjual(msg.data,msg.options,msg.type);
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

function refreshGraphTotalHargaPenjual(data,options,type){
    if(type=='harian'){
        if(graphTotalHargaPenjualHarian==null){
            graphTotalHargaPenjualHarian = new Chart('graphTotalHargaPenjualHarian', {
                type: 'horizontalBar',
                data: data,
                options: options
            });
        }else{
            graphTotalHargaPenjualHarian.data=data;
            graphTotalHargaPenjualHarian.update();
        }
    }else{
        if(graphTotalHargaPenjualBulanan==null){
            graphTotalHargaPenjualBulanan = new Chart('graphTotalHargaPenjualBulanan', {
                type: 'horizontalBar',
                data: data,
                options: options
            });
        }else{
            graphTotalHargaPenjualBulanan.data=data;
            graphTotalHargaPenjualBulanan.update();
        }
    }
}

/*    

    RANKING MENU
*/

function searchGraphRankingMenu(date,month,year,type){
    $.ajax({ 
        type: 'GET', 
        url: '/dashboard/ajax/graphRankingMenu', 
        data: {
            date:date,
            month:month,
            year:year,
            type:type
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshGraphRankingMenu(msg.data,msg.options,msg.type);
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

function refreshGraphRankingMenu(data,options,type){
    if(type=='harian'){
        if(graphRankingMenuHarian==null){
            graphRankingMenuHarian = new Chart('graphRankingMenuHarian', {
                type: 'horizontalBar',
                data: data,
                options: options
            });
        }else{
            graphRankingMenuHarian.data=data;
            graphRankingMenuHarian.update();
        }
    }else{
        if(graphRankingMenuBulanan==null){
            graphRankingMenuBulanan = new Chart('graphRankingMenuBulanan', {
                type: 'horizontalBar',
                data: data,
                options: options
            });
        }else{
            graphRankingMenuBulanan.data=data;
            graphRankingMenuBulanan.update();
        }
    }
}