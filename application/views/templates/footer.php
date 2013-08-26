	    <div class="navbar navbar-fixed-bottom">
		    <div>
	    	    <div class="pagination pagination-centered">
				    <ul>
				    	<?php 
				    	 for($i = 1; $i <= $totalPage; $i++){
				    	 	if($i == $page){
				    	 		echo "<li class='active'><a>$i</a></li>";
				    	 	}else{
				    	 		echo "<li><a href='" . site_url("board/index/$i") . "'>$i</a></li>";
				    	 	}
				    	 }
				    	?>
				    </ul>
			    </div>
		    </div>
	    </div>
	</body>
</html>