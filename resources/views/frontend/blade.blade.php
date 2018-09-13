@extends('frontend.layouts.app') @section('content')
<div class="container">
	<div style="width: 100%; margin: 0 auto;">
		<table
			class="table table-condensed table-hover table table-striped">
			<tr>
				<th>接口名称</th>
				<th style="width:50%;">接口描述</th>
				<th>METHOD</th>
				<th>参数</th>
			</tr>
		
		<?php foreach($methods as $method):?>
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
					   echo  substr($description,0,150);
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
		<?php endforeach;?>
	
	</table>
	</div>



</div>
@endsection
