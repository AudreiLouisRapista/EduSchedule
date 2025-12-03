
@if(session('errorMessage'))
<script>
    window.addEventListener('load', function(){
        
        Swal.fire({
            icon: "error",
            title: "Ooops...",
            text: @json(session('errorMessage')),
            
        });
    });

</script>
@endif

@if(session('success'))
<script>
    window.addEventListener('load', function(){
        
        Swal.fire({
            icon: "error",
            title: "Ooops...",
            text: @json(session('success')),
            
        });
    });

</script>
@endif


@if(session('save'))
<script>
    window.addEventListener('load', function(){
        
        Swal.fire({
            icon: "success",
            title: "Success",
            text: @json(session('save')),
            
        });
    });

</script>
@endif