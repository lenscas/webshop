<script>
	$(".linky").on("click",function(){
		if ($(this).parent().children(".treeview-menu").length > 0 ) {
			 event.preventDefault();
		}
		$(this).parent().children(".treeview-menu").each(function(i,element){
				if($(element).is(":hidden")){
					$(element).show()
				} else {
					$(element).hide()
				}
			
		})
	
	})
</script>
	</div>
</div>

	<footer style="margin-bottom:0px;">
		<div class="footer navbar navbar-inverse"style="margin-bottom:0px;"> 
	      		<div class="container ">
	          <p class="text-muted" style="margin: 14px 0px 14px 0px;">Footer</p>
	          <a href="https://www.youtube.com/" target="_blank"><p>lol</p></a>
	          <a href="https://www.youtube.com/" target="_blank"><p>Programmas</p></a>
	          </div>
	        </div>
	      </div>
    </footer>

</body>

</html>
