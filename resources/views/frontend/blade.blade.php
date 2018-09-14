@extends('frontend.layouts.app') @section('content')
<div class="container">
	<div style="width: 100%; margin: 0 auto;">
		<table
			class="table table-condensed table-hover table table-striped table-bordered">
			<tr id="app1">
				<th v-for="(i,key) in items" :style="getWidth(i)" :key="key">${i}</th>
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
					<li><?php echo $v?></li>
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
			items:['接口名称','接口描述','METHOD','参数'],
			width:{
				width:"50%"
			}
		}
	},
	methods:{
		getWidth:function ($i){
			if($i=='接口描述'){
				return 'width:50%;'
			}
		}
	}
})
</script>
@endsection


