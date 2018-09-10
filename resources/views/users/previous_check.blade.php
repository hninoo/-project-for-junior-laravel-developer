@extends('layouts.app')
@section('user')

<div id='calendar'></div>
<script type="text/javascript">
	
	$(document).ready(function() {
  
        $('#calendar').fullCalendar({
   
  				events:{!! $res !!}
	  					
	  				
  				// events: [{
		            
		    //         url: 'previous_check',
		    //         type: 'GET',
      //               dataType: "json",
		           
      //           }]
	  				
  				
            
        })
    });
</script>
@endsection


