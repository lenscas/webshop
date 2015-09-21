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
</body>
</html>
