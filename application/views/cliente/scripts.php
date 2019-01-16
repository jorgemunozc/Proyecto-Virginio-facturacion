 <!-- Script para recargar lista actualizada -->
 <script type="text/javascript">
    $(document).ready(function (){
        $('form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                method   : "POST",
                cache    : false,
                url      : $(this).attr('action'),
                data     : $(this).serialize(),
                dataType : "json",
                success  : function (data) {
                    if(data.status == 'success'){
                        location.href = "<?php echo base_url().'clientes';?>";
                    }else{
                        alert('Error: '+ data.msg);
                    }
                },
                error: function (result, textStatus, errorMsg){
                    if(textStatus == 'error')
                    {
                        alert(errorMsg);
                    }
                }
            });
        });

        $("input[type='text']").focusout(function (){
            $(this).val(capitalize($(this).val()))
        });

        function capitalize(str){
            var capitalized = str.substr(0,1).toUpperCase() + str.substr(1);
            return capitalized;
        }
    });
    </script>
</div>