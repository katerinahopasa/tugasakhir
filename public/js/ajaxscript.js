
    var url = "http://127.0.0.1:8000/benharian/laporan";
    //display modal form for product editing
    $(document).on('click','.open_modal',function(){
        var estimasiakhirlaporan_id = $(this).val();
       
        $.get(url + '/' + estimasiakhirlaporan_id, function (data) {
            //success data
            console.log(data);
            $('#estimasiakhirlaporan_id').val(data.id);
            $('#nama_pembagian').val(data.nama_pembagian);
            $('#persentase').val(data.persentase);
            $('#nominal').val(data.nominal);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmEstimasi').trigger("reset");
        $('#myModal').modal('show');
    });
    //delete product and remove it from list
    $(document).on('click','.delete-estimasiakhirlaporan',function(){
        var estimasiakhirlaporan_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + estimasiakhirlaporan_id,
            success: function (data) {
                console.log(data);
                $("#estimasiakhirlaporan" + estimasiakhirlaporan_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    //create new product / update existing product
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            nama_pembagian: $('#nama_pembagian').val(),
            persentase: $('#persentase').val(),
            nominal: $('#nominal').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var estimasiakhirlaporan_id = $('#estimasiakhirlaporan_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + estimasiakhirlaporan_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var estimasiakhirlaporan = '<tr id="estimasiakhirlaporan' + data.id + '"><td>' + data.nama_pembagian + '</td><td>' + data.persentase + '</td><td>' + data.nominal + '</td>';
                estimasiakhirlaporan += '<td><button class="btn btn-warning btn-detail btn-sm open_modal" value="' + data.id + '">Edit</button>';
                estimasiakhirlaporan += ' <button class="btn btn-danger btn-delete btn-sm delete-estimasiakhirlaporan" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#estimasiakhirlaporan-list').append(estimasiakhirlaporan);
                }else{ //if user updated an existing record
                    $("#estimasiakhirlaporan" + estimasiakhirlaporan_id).replaceWith( estimasiakhirlaporan );
                }
                $('#frmEstimasi').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });