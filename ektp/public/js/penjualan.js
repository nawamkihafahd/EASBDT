const IDRV = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).format(true);
const IDRR = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).value;

var globalCount = 0;

$(document).ready(function() {
    $('.harga').each(function (){
        let temp = $(this).html();
        $(this).html(IDRV(temp));
    });

    $('#menu-list').select2({
        placeholder: "Pilih menu",
        theme: "bootstrap"
    });
    globalCount=$('#list-pesanan').children().length - 1;
    $('#menu-list').val(null).trigger('change');
    $('#total').html(IDRV($('#total').html()));
    $('#kembalian').html(IDRV($('#kembalian').html()));
    $('#harga-satuan').html(IDRV(0));
    $('#sub-total').html(IDRV(0));
    $("input[name='metode_pembayaran']").change(function(){
        $(".radio").each(function (index){
            $(this).removeClass("fa fa-check");
            let className="#option"+index;
            if($(className)[0].checked==true){
                $(this).addClass("fa fa-check");
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


$('#menu-jumlah').on('keyup change paste',function(){
    updateHarga();
});

$('#bayar').on('keyup change paste',function(){
    let total = IDRR($('#total').html());
    let bayar = $('#bayar').val();
    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    let kembalian =parseInt(bayar)-parseInt(total);
    $('#kembalian').html(IDRV(kembalian));
});

function updateHarga(){
    let jumlah = $('#menu-jumlah').val();
    let satuan = $('#harga-satuan').html();
    satuan = IDRR(satuan);
    let newJumlah = jumlah * satuan;
    $('#sub-total').html(IDRV(newJumlah));
}

function openmodal(type,id){
    if(type=='new'){
        $('#modal-confirm-button').attr('onclick','addNewPesanan();').html('Tambah');
        $('#judul-modal').html('Tambah pesanan');
    }else{
        $('#modal-confirm-button').html('Edit');
        $('#judul-modal').html('Edit pesanan');
        editmodalvalue(id);
    }
    $('#modal').modal('show');
        
}

function menuselectchange(){
    let id = $('#menu-list').val();
    if(id==null){
        return false;
    }
    if(id=="none"){
        window.alert('Tidak ada menu yang terpilih');
        return false;
    }
    id = id.split(" ")[0];
    $.ajax({
        type : "GET",
        url : "/ajaxInfoMenu/"+id+"/",
        success : function(data){
            $('#harga-satuan').html(IDRV(data.harga_jual));
            let jumlah = $('#menu-jumlah').val();
            let satuan = data.harga_jual;
            satuan = IDRR(satuan);
            let newJumlah = jumlah * satuan;
            $('#sub-total').html(IDRV(newJumlah));
        }
    })
}

function resetNumber(){
    $('.number').each(function (i){
        $(this).html(i+1);
    });
}

function increaseModal(){
    let value=parseInt($('#menu-jumlah').val());
    $('#menu-jumlah').val(value+1);
    updateHarga();
}

function decreaseModal(){
    let value=parseInt($('#menu-jumlah').val());
    if(value!=0)
        $('#menu-jumlah').val(value-1);
        updateHarga();
}

function resetModal(){
    $('#menu-list').val(null).trigger('change');
    $('#menu-jumlah').val(1);
    $('#harga-satuan').html(IDRV(0));
    $('#sub-total').html(IDRV(0));
}

function addNewPesanan(){
    let selectedMenu = $('#menu-list').val();
    let jumlah = $('#menu-jumlah').val();
    if(selectedMenu=="none"){
        window.alert('Tidak ada menu yang terpilih');
        return false;
    }
    if(jumlah==0){
        window.alert('Jumlah tidak boleh 0');
        return false;
    }
    selectedMenu = selectedMenu.split(" ");
    let menuId = selectedMenu[0];
    let namaMenu = selectedMenu.slice(1,selectedMenu.length);
    namaMenu = namaMenu.join(" ");
    let hargaSatuan = $('#harga-satuan').html();
    let subTotal = $('#sub-total').html();
    $('#list-pesanan').append(`
    <tr id=pesanan`+globalCount+`>
        <input id="menu`+globalCount+`" type="hidden" value="`+menuId+`">
        <td class="number">
        </td>
        <td>
            `+namaMenu+`
        </td>
        <td>
            `+jumlah+`
        </td>
        <td>
            `+hargaSatuan+`
        </td>
        <td align="left">
            `+subTotal+`
        </td>
        <td colspan="2">
            <button type="button" href="#" role="button" onclick="openmodal('edit','`+globalCount+`')" class="btn btn-secondary mr-md-1">
            <i class="fa fa-edit"></i></a>
            <button type="button" href="#" role="button" onclick="deletedata('`+globalCount+`')" class="btn btn-danger">
            <i class="fa fa-trash"></i></a>
        </td>
        <input type="hidden" value="-">
    </tr>
    `);

    subTotal=IDRR(subTotal);
    let total = IDRR($('#total').html());
    
    total = parseInt(total) + parseInt(subTotal);

    let bayar = $('#bayar').val();

    let kembalian =parseInt(bayar)-parseInt(total);

    total=IDRV(total);
    $('#total').html(total);
    $('#modal').modal('hide');
    resetModal();
    globalCount += 1;
    resetNumber();
    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    $('#kembalian').html(IDRV(kembalian));

}

function editmodalvalue(id){
    let pesanan = $('#pesanan'+id);
    let children = pesanan.children();
    let menuId = children[0].value;
    let namaMenu = children[2].innerText;
    let jumlah = children[3].innerText;
    let hargaSatuan = children[4].innerText;
    let subTotal = children[5].innerText;
    $('#menu-list').val(menuId+" "+namaMenu).trigger('change');
    $('#menu-jumlah').val(jumlah);
    $('#harga-satuan').html(hargaSatuan);
    $('#sub-total').html(subTotal);

    $('#modal-confirm-button').attr('onclick','editPesanan('+id+','+IDRR(subTotal)+');')

}

function editPesanan(id,subTotal){
    // subTotal=IDRR(subTotal);
    let total = IDRR($('#total').html());
    
    total = total - subTotal;


    let selectedMenu = $('#menu-list').val();
    let jumlah = $('#menu-jumlah').val();
    if(selectedMenu=="none"){
        window.alert('Tidak ada menu yang terpilih');
        return false;
    }
    if(jumlah==0){
        window.alert('Jumlah tidak boleh 0');
        return false;
    }
    selectedMenu = selectedMenu.split(" ");
    let menuId = selectedMenu[0];
    let namaMenu = selectedMenu.slice(1,selectedMenu.length);
    namaMenu = namaMenu.join(" ");
    let hargaSatuan = $('#harga-satuan').html();
    subTotal = $('#sub-total').html();
    

    let pesanan = $('#pesanan'+id);
    let children = pesanan.children();
    children[0].value=menuId;
    children[2].innerHTML=namaMenu;
    children[3].innerHTML=jumlah;
    children[4].innerHTML=hargaSatuan;
    children[5].innerHTML=subTotal;

    subTotal=IDRR(subTotal);

    total = total + subTotal;
    

    let bayar = $('#bayar').val();

    let kembalian =parseInt(bayar)-total;
    
    

    total=IDRV(total);
    $('#total').html(total);
    $('#modal').modal('hide');
    resetModal();
    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    $('#kembalian').html(IDRV(kembalian));
}

function deletedata(id){
    let pesanan = $('#pesanan'+id);
    let children = pesanan.children();
    let subTotal = children[4].innerText;
    let total = IDRR($('#total').html());
    
    subTotal=IDRR(subTotal);
    total=parseInt(total)-parseInt(subTotal);
    let bayar = $('#bayar').val();

    let kembalian =parseInt(bayar)-parseInt(total);
    
    total=IDRV(total);
    $('#total').html(total);
    $('#pesanan'+id).remove();
    resetNumber();
    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    $('#kembalian').html(IDRV(kembalian));

}

function iterPesanan(eachPesanan){
    let children = eachPesanan.children;
    let menuId = children[0].value;
    let namaMenu = children[2].innerText;
    let jumlah = children[3].innerText;
    let hargaSatuan = IDRR(children[4].innerText);
    let subTotal = IDRR(children[5].innerText);
    let idDetails = children[7].value;
    return {
        'id_detail' : idDetails,
        'id_menu' : menuId,
        'nama_menu' : namaMenu,
        'jumlah' : jumlah,
        'hargaSatuan' : hargaSatuan,
        'subTotal' : subTotal
    };
}

function submitForm(){
    let r = window.confirm('Submit?\nMohon periksa kembali pesanan anda sebelum konfirmasi')
    if(r==false){
        return false
    }
    let metodePembayaran = $("input[name='metode_pembayaran']:checked").val();
    let customerName = $('#costumer').val();
    let waktu = $('#waktu').html();
    let total = IDRR($('#total').html());
    // let id = $('#id-transaksi').html();
    if(total==0){
        window.alert('Belum ada menu terpilih');
        return false;
    }

    let bayar = $('#bayar').val();
    if(bayar==""){
        bayar = 0
    }else{
        bayar=parseInt(bayar);
    }
    let kembalian = IDRR($('#kembalian').html());
    if((kembalian==0 && bayar==0) || kembalian<0){
        alert('Jumlah bayar < total, tolong masukkan nilai dengan benar');
        return false;
    }
    let pesanan = $('#list-pesanan').children();
    let pesananMapped = []
    for (let i=0;i<pesanan.length;i++) {
        let eachPesanan = $(pesanan[i]);
        pesananMapped.push(iterPesanan(eachPesanan[0]));
    }

    let idTransaksi = $('meta[name="id"]').attr('content');
    $.ajax({ 
        type: 'POST', 
        url: '/penjualan/'+idTransaksi+'/update', 
        data: JSON.stringify({
            'pesananMapped':pesananMapped,
            'customerName':customerName,
            'total':total,
            'bayar':bayar,
            'kembalian':kembalian,
            'waktu':waktu,
            'jenisPembayaran':metodePembayaran
        }),
        contentType: "application/json; charset=utf-8", 
        dataType: 'json'
    }).done(function (msg){
        if(msg.status!=200){
            alert(msg.msg);
        }else{
            console.log(msg.msg);
            if(msg.msg=="ok"){
                if(!alert('Penyimpanan berhasil')){
                    window.location.reload();
                }
            }else{
                alert(msg.msg);
            }
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