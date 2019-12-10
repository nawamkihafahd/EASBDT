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

var reportTransaksi = $('#id-report-transaksi').DataTable({
    order: [[ 1, "desc" ]],
    buttons: [
        'copy', 'excel', 'pdf'
    ]
});