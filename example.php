<HTML>
<TITLE>AJAX Example</TITLE>

<!-- AJAX functionality -->
<script type="text/javascript" src="ajax.js"></script>

<BODY>

	<!-- these clicks will call and process the output of "ajax.php?action=page1" (2,3,4,etc) -->
	<a href="javascript:sndReq('page1');">[Page 1]</a>
	<a href="javascript:sndReq('page2');">[Page 2]</a>
	<a href="javascript:sndReq('page3');">[Page 3]</a>
	<a href="javascript:sndReq('page4');">[Page 4]</a>

	<br><br>
	
	<!-- we only have one object that would be updated: someText -->
	<!-- so our ajax.php file will always output "someText|whatever...", which handleResponse will -->
	<!--  use to update this <div> object -->
	<div style="width: 25%;" id="someText">Click one of the above pages to witnes AJAX in action.</div>

</BODY>
</HTML>