const IDRV = value => currency(value, { symbol: 'Rp ', separator: '.' ,precision:0}).format(true);
const IDRR = value => currency(value, { symbol: 'Rp ', separator: '.' ,precision:0}).value;
var rekapHarian=null;
var reportBulanan=null;
var reportKeuntungan=null;
var reportTransaksi = null;
$(document).ready(function () {

    $('.harga').each(function (){
        $(this).html(IDRV($(this).html()));
    });
    $('#filter-penjual-rekap').select2({
        placeholder: "Pilih penjual",
        theme: "bootstrap"
    });    
    $('#filter-penjual-rekap').val(null).trigger('change');
    rekapHarian = $('#id-rekap-harian').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
    reportBulanan=$('#id-report-bulanan').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
    reportKeuntungan=$('#id-report-keuntungan').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
    reportTransaksi = $('#id-report-transaksi').DataTable({
        order: [[ 1, "desc" ]],
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
    var dp=$("#date-bulanan")
    dp.datepicker( {
        format: "mm-yyyy",
        viewMode: 1, 
        minViewMode: 1
    })
    dp.on('changeDate', function (ev) {
        let month=ev.date.getMonth()+1;
        let year=ev.date.getFullYear();
        searchReportBulanan(month,year);
    });
    var dh1=$("#date-report-keuntungan");
    dh1.datepicker( {
        format: "mm-yyyy",
        viewMode: 1, 
        minViewMode: 1
    })
    dh1.on('changeDate', function (ev) {
        let month=ev.date.getMonth()+1;
        let year=ev.date.getFullYear();
        searchReportKeuntungan(month,year);
    });
    resetNumber();
});

function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.print();
    // printWindow.addEventListener('load', function(){
    //     printWindow.print();
    //     printWindow.close();
    // }, true);
}

function refreshReportTable(msg){
    let data=msg.msg;
    reportTransaksi.destroy();
    $('#list-report').empty();
    for(let i=0;i<data.length;i++){
        let usedData = data[i];
        let details="";
        for (let j=0;j<usedData.details.length;j++){
            let det = usedData.details[j]
            details += "<p>"+ det.nama_menu +" ("+det.jumlah+")</p>";
        }
        let insertHtml = `
        <tr>
            <td>
                `+usedData.id_transaksi+`
            </td>
            <td>
                `+yearFormat(usedData.created_at)+`
            </td>
            <td>
                `+usedData.handled_by.name+`
            </td>
            <td>
                `+usedData.customer+`
            </td>
            <td>
                `+details+`
            </td>
            <td class="harga">
                `+usedData.harga_total+`
            </td>
            <td class="harga">
                `+usedData.bayar+`
            </td>
            <td class="harga">
                `+usedData.kembalian+`
            </td>
            <td>
                `+usedData.jenis_pembayaran+`
            </td>
            <td align="center" width="30px">
                <a href="/penjualan/`+usedData.id_transaksi+`/edit" class="btn btn-secondary btn-sm" role="button"><i class="fa fa-edit"></i> Edit</a>
            </td>
        </tr>

    `;
    $('#list-report').append(insertHtml);
    }
    $('#list-report .harga').each(function (){
        $(this).html(IDRV($(this).html()));
    });
    $('#sum-total').html(IDRV(msg.sumTotal));
    $('#sum-total-cash').html(IDRV(msg.sumTotalCash));
    $('#sum-total-non-cash').html(IDRV(msg.sumTotalNonCash));
    
    $('#sum-transaksi').html(data.length);
    reportTransaksi=$('#id-report-transaksi').DataTable({
        order: [[ 1, "desc" ]],
        buttons: [
            'copy', 'excel', 'pdf'
        ] 
    });
}

function searchReport(){
    let tanggal = $('#filter-tanggal-report').val();
    $.ajax({ 
        type: 'GET', 
        url: '/ajaxReport', 
        data: {
            tanggal:tanggal
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshReportTable(msg);
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



function resetNumber(){
    $('.number').each(function (i){
        $(this).html(i+1);
    });
    $('.numberKeuntungan').each(function (i){
        $(this).html(i+1);
    });
}

function yearFormat(string){
    let splitted = string.split("-");
    let year = splitted[0];
    let month = splitted[1];
    let day = splitted[2].split(" ");
    let time = day[1];
    day = day[0];
    return day+"-"+month+"-"+year+" "+time
}

function refreshReportBulananTable(data){
    reportBulanan.destroy();
    $('#list-report-bulanan').empty();
    for(let i=0;i<data.length;i++){
        let usedData = data[i];
        let insertHtml = `
        <tr>
            <td class="number">
                
            </td>
            <td>
                `+yearFormatBulanan(usedData.tanggal)+`
            </td>
            <td>
                `+usedData.penjual+`
            </td>
            <td class="harga">
                `+usedData.total_harga_penjual+`
            </td>
            <td class="harga">
                `+usedData.total_harga+`
            </td>
            <td class="harga">
                `+usedData.keuntungan+`
            </td>
        </tr>

    `;
    $('#list-report-bulanan').append(insertHtml);
    }
    $('#list-report-bulanan .harga').each(function (){
        $(this).html(IDRV($(this).html()));
    });
    reportBulanan=$('#id-report-bulanan').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ] 
    });
    resetNumber();
}


function refreshRekapTable(data,hargaPenjual,keuntungan){
    rekapHarian.destroy();
    $('#list-rekap').empty();
    for(let i=0;i<data.length;i++){
        let usedData = data[i];
        let insertHtml = `
        <tr>
            <td>
                `+usedData.nama_penjual+`
            </td>
            <td>
                `+usedData.nama_menu+`
            </td>
            <td>
                `+usedData.jumlah+`
            </td>
            <td class="harga">
                `+usedData.harga_penjual+`
            </td>
            <td class="harga">
                `+usedData.harga_jual+`
            </td>
            <td class="harga">
                `+usedData.harga_penjual * usedData.jumlah+`
            </td>
            <td class="harga">
                `+usedData.sub_total+`
            </td>
            <td class="harga">
                `+usedData.keuntungbulananan+`
            </td>
        </tr>
    `;
    $('#list-rekap').append(insertHtml);
    }
    $('#list-rekap .harga').each(function (){
        $(this).html(IDRV($(this).html()));
    });
    $('#sum-harga-penjual').html(IDRV(hargaPenjual));
    $('#sum-keuntungan').html(IDRV(keuntungan));
    rekapHarian=$('#id-rekap-harian').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ] 
    });
}

function refreshReportKeuntunganTable(data,keuntungan){
    reportKeuntungan.destroy();
    $('#list-report-keuntungan').empty();
    for(let i=0;i<data.length;i++){
        let usedData = data[i];
        let insertHtml = `
        <tr>
            <td class="number">
                
            </td>
            <td>
                `+yearFormatBulanan(usedData.tanggal)+`
            </td>
            <td class="harga">
                `+usedData.keuntungan+`
            </td>
        </tr>

    `;
    $('#list-report-keuntungan').append(insertHtml);
    }
    $('#list-report-keuntungan .harga').each(function (){
        $(this).html(IDRV($(this).html()));
    });
    $('#sum-report-keuntungan').html(IDRV(keuntungan));
    reportKeuntungan=$('#id-report-keuntungan').DataTable({
        buttons: [
            'copy', 'excel', 'pdf'
        ] 
    });
    resetNumber();
}

function yearFormatBulanan(string){
    let splitted = string.split("-");
    let year = splitted[0];
    let month = splitted[1];
    let day = splitted[2].split(" ");
    day = day[0];
    return day+"-"+month+"-"+year
}


function searchRekap(){
    let tanggal = $('#filter-tanggal-rekap').val();
    let penjual = $('#filter-penjual-rekap').val();
    if(penjual==null){
        return false;
    }
    $.ajax({ 
        type: 'GET', 
        url: '/ajaxRekap', 
        data: {
            tanggal:tanggal,
            penjual:penjual
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshRekapTable(msg.msg,msg.hargaPenjual,msg.keuntungan);
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

function searchReportBulanan(month,year){
    $.ajax({ 
        type: 'GET', 
        url: '/ajaxReportBulanan', 
        data: {
            month:month,
            year:year
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshReportBulananTable(msg.msg);
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

function searchReportKeuntungan(month,year){
    $.ajax({ 
        type: 'GET', 
        url: '/ajaxReportKeuntungan', 
        data: {
            month:month,
            year:year
        },
    }).done(function (msg){
        if(msg.status==200){
            refreshReportKeuntunganTable(msg.msg,msg.keuntungan);
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