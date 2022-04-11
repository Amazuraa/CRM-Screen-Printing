<script>
	$(document).ready(function(){
		setTimeout(Toggle_Loading, 1700);
	});

	function Toggle_Loading()
	{
		$(".ibox-content").toggleClass('sk-loading');
	}
</script>

<div class="sk-spinner sk-spinner-wave">
    <div class="sk-rect1"></div>
    <div class="sk-rect2"></div>
    <div class="sk-rect3"></div>
    <div class="sk-rect2"></div>
    <div class="sk-rect1"></div>
</div>