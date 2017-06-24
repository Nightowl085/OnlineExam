  
  $(function(){
       $("#dialogTambahMatkul , #dialogTambahPengajar").hide();

    $("#updateDosen").click(function(){
        $("#dialogTambahMatkul").slideDown();
        $(document).scrollTop( $("#dialogTambahMatkul").offset().top);  
    });


    $("#btnCancelTambahMatkul").click(function(){
        $("#dialogTambahMatkul").slideUp();
        $(document).scrollTop(0);  
    });

    $(".datatable").DataTable({
        "aLengthMenu": [[5,10, 25, 50, 100], [5,10, 25, 50, 100]],
        "iDisplayLength": 5
    });

    $("#btnTambahPengajar").click(function(){
        $("#dialogTambahPengajar").slideDown();
        $(document).scrollTop($("#dialogTambahPengajar").offset().top);  
    });

    $("#btnCancelTambahPengajar").click(function(){
        $("#dialogTambahPengajar").slideUp();
        $(document).scrollTop($("#formLihatPengajar").offset().top);  
    });

    $("#btnTutupPengajar").click(function(){
        window.location = "masterMatakuliah.php";
    });
 function findUpTag(el, tag) {
        while (el.parentNode) {
            el = el.parentNode;
            if (el.tagName === tag)
                return el;
        }
        return null;
    }

    $("button[data-target='#dialogDeleteDosen']").click(function(){
        var textNamaMatul = $($(findUpTag(this,"TR")).find("td:nth-child(2)")).text();
        var NIDDosen =  $($(findUpTag(this,"TR")).find("td:nth-child(1)")).text();
        var kodeMatkul = $(this).attr("value");
        var modalBody = $("#dialogDeleteDosen").find(".modal-body");
        $(modalBody).text(" ");
        $(modalBody).append("<p>Apakah anda yakin ingin menghapus Dosen dengan Nama : " + textNamaMatul + "?</p>");
        $(modalBody).append("<input type='hidden' name='txtHapusDosen' value='"+ NIDDosen + "'>");
    });

    $("button[data-target='#updateDosen']").click(function(){
         $("#dialogTambahMatkul").slideDown();
        $(document).scrollTop( $("#dialogTambahMatkul").offset().top);  

        var NIDDosen = $($(findUpTag(this,"TR")).find("td:nth-child(1)")).text();
        var nama =  $($(findUpTag(this,"TR")).find("td:nth-child(2)")).text();
        var alamat = $($(findUpTag(this,"TR")).find("td:nth-child(3)")).text();
         var notelp = $($(findUpTag(this,"TR")).find("td:nth-child(4)")).text();
         var email =  $($(findUpTag(this,"TR")).find("td:nth-child(5)")).text();

         $('#txtNID').val(NIDDosen);
           $('#txtNamaDosen').val(nama);
            $('#txtAlamat').val(alamat);
            $('#txtNomorTelpon').val(notelp);
            $('#txtEmail').val(email);
    });
  });
 