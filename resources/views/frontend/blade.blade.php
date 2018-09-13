@extends('frontend.layouts.app') @section('content')
<div id="app1">
	<span v-for="i in items">${i}</span>
</div>
<div class="container">
	<div style="width: 100%; margin: 0 auto;">
		<table
			class="table table-condensed table-hover table table-striped table-bordered">
			<tr>
				<th>接口名称</th>
				<th style="width:50%;">接口描述</th>
				<th>METHOD</th>
				<th>参数</th>
			</tr>
		
		<?php foreach($methods as $method):?>
		<?php if(isset($method->doc['method']) && !empty($method->doc['method'])):?>
		<tr>
				<td><?php echo  $method->name?></td>
				<td><a href="<?php echo url('/'.$method->router.'/'.$method->name)?>">
					<?php
					   if(isset($method->doc['description']) && !empty($method->doc['description'])){
					       $description=$method->doc['description'];
					   }elseif(isset($method->desc)){
					       $description=$method->desc;
					   }else{
					       $description="";
					   }
					   echo $description;
					  ?>
					</a>
				</td>
				<td><?php echo strtoupper($method->doc['method']??'')?></td>
				<td>
				<?php if(isset($method->doc['param'])): foreach($method->doc['param'] as $k=>$v):?>
					<li> @param <?php echo $v?></li>
				<?php endforeach;endif;?>
			</td>
		</tr>
		<?php endif;?>
		<?php endforeach;?>
	</table>
	</div>
</div>
<script>
new Vue({ 
	el: '#app1',
	delimiters: ['${', '}'],
	data:function (){
		return {
			items:[1,2,3,4,5]
		}
	}

})
</script>
@endsection


