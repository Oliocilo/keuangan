$(document).ready(function(){
    if(document.getElementById('getProvinsi').value != ""){
        pilihProvinsi(document.getElementById('getProvinsi').value);
        pilihWilayah('regencies',document.getElementById('getProvinsi').value.split(',')[0], document.getElementById('getKota').value);
    } 
    else pilihProvinsi();
});

async function pilihProvinsi(selected = ""){
    let list = "<option value='' selected>Pilih Provinsi</option>";
	await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
	.then(res =>res.json())
	.then(json => {
		json.forEach((item, index) => {
            if(item.id+","+item.name == selected){
                list += `
                    <option value="${item.id+`,`+item.name}" selected>${item.name}</option>
                `;
            }else {
                list += `
                    <option value="${item.id+`,`+item.name}">${item.name}</option>
                `;
            }
		})
	});
	document.getElementById("isiProvinsi").innerHTML = list;
}

async function pilihWilayah(area, id, selected = ""){
    let list = "<option value='' selected>Pilih Kabupaten/Kota</option>";
	await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/'+area+'/'+id+'.json')
	.then(res =>res.json())
	.then(json => {
		json.forEach((item, index) => {
            if(item.name == selected){
                list += `
                    <option value="${item.name}" selected>${item.name}</option>
                `;
            }else {
                list += `
                    <option value="${item.name}">${item.name}</option>
                `;
            }
		})
	});
    if(area == "regencies") document.getElementById("isiKabKota").innerHTML = list;
    else if(area == "districts") document.getElementById("isiKecamatan").innerHTML = list;
    else if(area == "villages") document.getElementById("isiKelurahan").innerHTML = list;
}