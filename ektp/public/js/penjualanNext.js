const IDRV = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).format(true);
const IDRR = value => currency(value, { symbol: 'Rp ',decimal:',', separator: '.' ,precision:0}).value;

var globalCount = 0;
var selectedMenu = [];
var indexSelected = [];
var onSelectMenu=false;
var searchnohp = 0;
var simplusstatus = 1;

$(document).ready(function() {
    $('.harga').each(function (){
        let temp = $(this).html();
        $(this).html(IDRV(temp));
    });
    // console.log($('#list-pesanan #1').children()[3].innerText);
    $('#total').html(IDRV(0));
    $('#kembalian').html(IDRV(0));
    $('#bayar').html(IDRV(0));
    $("input[name='metode_pembayaran']").change(function(){
        $(".radio").each(function (index){
            $(this).removeClass("fa fa-check");
            let className="#option"+index;
            if($(className)[0].checked==true){
                $(this).addClass("fa fa-check");
            }
        });
		if($("input[name='metode_pembayaran']:checked").val() == "OVO-SIMPLUS")
		{
			simplusstatus = 1;
			searchnohp = 1;
			$('#nohplabel').show();
			$('#nohp').show();
			getNoHp();
			
			
		}
		else
		{
			searchnohp = 0;
			$('#nohplabel').hide();
			$('#nohp').hide();
		}
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
function getNoHp()
{
	$.ajax({ 
				type: 'GET', 
				url: '/penjualan/nohp/1', 
				dataType: 'json'
			}).done(function (msg){
				//alert("here");
				if(msg.status!=200){
				//alert(msg.msg);
					if(searchnohp == 1)
					{
						setTimeout(function(){getNoHp();}, 500);
					}
				}else{
					//alert("else");
					if(msg.res == 0)
					{
						//alert('Nomor Hp Tidak Ditemukan');
					}
					else
					{
						$('#nohp').val(msg.nohp);
						//alert('Nomor Hp = ' + msg.nohp);
					}
					if(searchnohp == 1 && $('#nohp').val() != "")
					{
						if(simplusstatus == 1)
						{
							submitForm();
						}
						
					}
					setTimeout(function(){getNoHp();}, 500);
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
					alert('Unknown Error.\n'+x.responseText);
				}
				if(searchnohp == 1)
				{
					setTimeout(function(){getNoHp();}, 500);
				}
			})
	
}



function addNewPesanan(id,harga,nama){
    let findString = '#list-pesanan #'+id;
    let menu=$(findString);
    if(menu.length==0){ //new in list
        let newIsi=`
            <div class="row" id="`+id+`">
                <div class="col-1 urutan" style="font-size:13px; padding-right:5px">
                </div>
                <div class="col-4 small-padding" style="font-size:13px">
                `+nama+`
                </div>
                <div class="col-2 small-padding" style="font-size:13px">
                1
                </div>
                <div class="col-3 small-padding" style="font-size:13px">
                `+IDRV(harga)+`
                </div>
                <div class="col-2">
                    <button type="button" class="button-numpad btn btn-sm btn-secondary" onclick="kurangiJumlah(`+id+`,`+harga+`)">-</button>
                </div>
            </div>
        `
        $('#list-pesanan').append(newIsi);
    }else{ //update current
        children = menu.children();
        let jumlahBaru=parseInt(children[2].innerText)+1;
        children[2].innerText=jumlahBaru;
        let newHarga = harga*jumlahBaru;
        children[3].innerText=IDRV(newHarga);
    }

    resetNumber();

    let total = IDRR($('#total').html());
    
    total = parseInt(total) + harga;

    let bayar = total;

    let kembalian =parseInt(bayar)-parseInt(total);

    total=IDRV(total);
    $('#total').html(total);
    $('#bayar').html(total);

    onSelectMenu=true;

    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    $('#kembalian').html(IDRV(kembalian));

}


function kurangiJumlah (id,harga){
    let findString = '#list-pesanan #'+id;
    let menu=$(findString);

    children = menu.children();
    let jumlahBaru=parseInt(children[2].innerText)-1;
    children[2].innerText=jumlahBaru;

    let newHarga = harga*jumlahBaru;
    children[3].innerText=IDRV(newHarga);

    if(jumlahBaru==0){
        menu.remove();
    }

    resetNumber();

    let total = IDRR($('#total').html());
    
    total = parseInt(total) - harga;

    let bayar = total;

    let kembalian =parseInt(bayar)-parseInt(total);

    total=IDRV(total);
    $('#total').html(total);
    $('#bayar').html(total);

    onSelectMenu=true

    if(bayar==""){
        $('#kembalian').html(IDRV(0));
        return false;
    }
    $('#kembalian').html(IDRV(kembalian));
}

function addBayarNumpad(nilai){
    let bayar = IDRR($('#bayar').html());
    
    if(onSelectMenu){
        bayar=0
        onSelectMenu=false
    }

    if(nilai=='backspace'){
        bayar = Math.floor(parseInt(bayar)/10);
    }else if(nilai=='reset'){
        bayar = 0;
        onSelectMenu=true;
    }else{
        bayar=String(bayar)+String(nilai);
    }

    $('#bayar').html(IDRV(bayar));



    let total = IDRR($('#total').html());


    let kembalian =parseInt(bayar)-parseInt(total);
    $('#kembalian').html(IDRV(kembalian));
}

function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.print();
    // printWindow.addEventListener('load', function(){
    //     printWindow.print();
    //     printWindow.close();
    // }, true);
}

function addBayar(nilai){

    let bayar = IDRR($('#bayar').html());
    
    if(onSelectMenu){
        bayar=0
        onSelectMenu=false
    }

    bayar=parseInt(bayar)+nilai;

    $('#bayar').html(IDRV(bayar));

    let total = IDRR($('#total').html());

    let kembalian =parseInt(bayar)-parseInt(total);
    $('#kembalian').html(IDRV(kembalian));
}

function resetNumber(){
    $('.urutan').each(function (i){
        $(this).html(i+1);
    });
}

function iterPesanan(children){
    let newChildren = $(children);
    let menuId = newChildren.attr('id');
    let nextChildren = newChildren.children();
    let namaMenu = nextChildren[1].innerText;
    let jumlah = nextChildren[2].innerText;
    let subTotal = IDRR(nextChildren[3].innerText);
    return {
        'id_menu' : menuId,
        'nama_menu' : namaMenu,
        'jumlah' : jumlah,
        'subTotal' : subTotal
    };
}

function submitForm(){
	if(searchnohp == 0)
	{
		let r = window.confirm('Submit?\nMohon periksa kembali pesanan anda sebelum konfirmasi')
		if(r==false){
			return false
		}
	}
    
    let metodePembayaran = $("input[name='metode_pembayaran']:checked").val();
	let nohp = $('#nohp').val();
	
    let customerName = $('#costumer').val();
    let waktu = $('#waktu').html();
    let total = IDRR($('#total').html());
    // let id = $('#id-transaksi').html();
    if(total==0){
		simplusstatus = 0;
        window.alert('Belum ada menu terpilih');
        return false;
    }

    let bayar = IDRR($('#bayar').html());
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
	if(metodePembayaran =="OVO-SIMPLUS")
	{
		if(nohp =="")
		{
			window.alert('Nomor Handphone OVO Pembeli Belum Terisi');
			return false;
		}
		else
		{
			$.ajax({ 
				type: 'POST', 
				url: '/penjualan/create', 
				data: JSON.stringify({
					'pesananMapped':pesananMapped,
					'customerName':customerName,
					'nohp':nohp,
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
					if(msg.msg=="ok"){
						simplusstatus = 0;
						if(window.confirm('Penyimpanan berhasil,ingin print?')){
							printExternal('/penjualan/print/'+msg.id)
						}
						window.location.reload();
					}else{
						simplusstatus = 0;
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
					alert('Unknown Error.\n'+x.responseText);
				}
			});
		}
	}
	else
	{
    $.ajax({ 
        type: 'POST', 
        url: '/penjualan/create', 
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
            if(msg.msg=="ok"){
                if(window.confirm('Penyimpanan berhasil,ingin print?')){
                    printExternal('/penjualan/print/'+msg.id)
                }
                window.location.reload();
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
}