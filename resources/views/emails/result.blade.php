<a>{{ $message }}</a>

    <script>
        setTimeout(()=>{
            @if( $status )
                window.location.href = "/" ;
            @else
                window.location.href = "/member/register" ;
            @endif
        }, 3000 );

    </script>
 <script> </script>
