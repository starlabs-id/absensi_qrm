$(document).ready(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('#datatable').DataTable();

    $('.select2').select2();
});

function goBack() {
    window.history.back();
}

window.setTimeout(function() {
    $(".alert").fadeTo(3000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    }, 5000);

function logout(event){
    event.preventDefault();
    $.confirm({
        icon: 'i-Key-Lock',
        title: 'Log Out !',
        content: 'Anda yakin ingin logout ?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: function () {
                document.getElementById('logout-form').submit();
            },
            cancel: function () {
                // $.alert('Batal!');
            },
        }
    });
}

// function startTime(){
//   var today = new Date();
//   var h = today.getHours();
//   var m = today.getMinutes();
//   var s = today.getSeconds();
//   m = checkTime(m);
//   s = checkTime(s);
//   document.getElementById('txt').innerHTML =
//   h + ":" + m + ":" + s;
//   var t = setTimeout(startTime, 500);
// }

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

//ajax select kelas
$('select[name="tahun_ajaran_id"]').on('change', function () {
    let kelasId = $(this).val();
    if (kelasId) {
        jQuery.ajax({
            url: '/kelas/'+kelasId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="kelas_id"]').empty();
                $('select[name="kelas_id"]').append('<option value="">-- Pilih Kelas --</option>');
                $.each(response, function (key, value) {
                    $('select[name="kelas_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
        $('select[name="kelas_id"]').append('<option value="" disable="">-- Pilih Kelas --</option>');
    }
});

// Upgrade Kelas
$('select[name="tahun_ajaran_id_awal"]').on('change', function () {
    let kelasId = $(this).val();
    if (kelasId) {
        jQuery.ajax({
            url: '/kelas/'+kelasId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="kelas_id_awal"]').empty();
                $('select[name="kelas_id_awal"]').append('<option value="">-- Pilih Kelas --</option>');
                $.each(response, function (key, value) {
                    $('select[name="kelas_id_awal"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
        $('select[name="kelas_id_awal"]').append('<option value="" disable="">-- Pilih Kelas --</option>');
    }
});

$('select[name="tahun_ajaran_id_baru"]').on('change', function () {
    let kelasId = $(this).val();
    if (kelasId) {
        jQuery.ajax({
            url: '/kelas/'+kelasId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="kelas_id_baru"]').empty();
                $('select[name="kelas_id_baru"]').append('<option value="">-- Pilih Kelas --</option>');
                $.each(response, function (key, value) {
                    $('select[name="kelas_id_baru"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
        $('select[name="kelas_id_baru"]').append('<option value="" disable="">-- Pilih Kelas --</option>');
    }
});


//ajax select templatewa
$('select[name="templatewa"]').on('change', function () {
    let templatewaId = $(this).val();
    if (templatewaId) {
        jQuery.ajax({
            url: '/templatewa/'+templatewaId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $.each(response, function (key, value) {
                    $("#pesan").val(value);
                });
            },
        });
    } else {
        $("#pesan").val(); 
    }
});

$(document).ready(function(){
    $("#myform").on("submit", function(){
        $("#pageloader").fadeIn();
    });//submit
});//document ready


// Broadcast
$('select[name="kelas_id"]').on('change', function () {
    let kelasId = $(this).val();
    if (kelasId) {
      $('select[name="status"]').append('<option value="' + "Belum Lunas" + '">' + "Belum Lunas" + '</option>');
      $('select[name="status"]').append('<option value="' + "Lunas" + '">' + "Lunas" + '</option>');
      $('select[name="status"]').append('<option value="' + "Semua" + '">' + "Semua" + '</option>');
    } else {
    //   $('select[name="status"]').append('<option value="" disable="">-- Pilih Status --</option>');
    }
});