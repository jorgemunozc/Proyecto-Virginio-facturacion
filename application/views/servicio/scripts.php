<script>
    $(document).ready(function (){
        $('.delete-btn').click(function (e){
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url();?>servicios/delete",
                method: 'POST',
                data: {'tipo_servicio': $(this).data('servicio')},
                dataType: 'json',
                success: function (data){
                    $('.mensaje').text(data.msg);
                    if(data.status == 'success'){
                        $(".mensaje").removeClass("error").addClass("success");
                        location.reload();
                    }else if (data.status == 'error'){
                        $(".mensaje").removeClass("success").addClass("error");
                    }
                }
            });
        });

        $('#editServicioData').submit(function (e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data){
                    if(data.status && data.status == 'success'){
                        location.href = "<?php echo base_url().'servicios';?>";
                    }
                }
            });
        });

        $('#editServicioLogo').submit(function (e){
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (data){
                    $(".mensaje").text(data.msg);
                    if(data.status == 'success'){
                        var d = new Date();
                        $(".mensaje").removeClass("error").addClass("success");
                        $('.logo img').attr('src', "<?php echo base_url().'public/images/';?>" + data.filename + "?" + d.getTime());
                    }else{
                        $(".mensaje").removeClass("success").addClass("error");
                    }
                },
                error: function (data, txtStatus, errorThrown){
                    alert("Error:\n" + errorThrown);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("#servicioData").submit(function(e) {
            e.preventDefault();    
            var formData = new FormData(this);// HTML5 API, no compatible con versiones anteriores

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    $('.mensaje').text(data.msg);
                    if(data.status == 'error'){
                        $('.mensaje').removeClass('success').addClass('error');
                    }else{
                        $('.mensaje').removeClass('error').addClass('success');
                        setTimeout(() => {
                            location.href = "<?php echo base_url().'servicios';?>";
                        }, 2000);
                    }
                },
                error: function (data){
                    alert('Error:\nYa existe el servicio.')  
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("input[type='text']").focusout(function (){
            $(this).val(capitalize($(this).val()))
        });

    });

        function capitalize(str){
            var capitalized = str.substr(0,1).toUpperCase() + str.substr(1);
            return capitalized;
        }
</script>
</div>