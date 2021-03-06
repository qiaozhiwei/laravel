<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layout.parent')
@section('pages_section')
<div class="cart section">
		<div class="container">
			<div class="pages-head">
				<h3>CART</h3>
			</div>
			<div class="content">
            @foreach($data as $item)
				<div class="cart-1">
					<div class="row">
						<div class="col s5">
							<h5>Image</h5>
						</div>
						<div class="col s7">
							<img src="{{$item->goods_pic}}" alt="">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Name</h5>
						</div>
						<div class="col s7">
							<h5><a href="">{{$item->goods_name}}</a></h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Quantity</h5>
						</div>
						<div class="col s7">
							<h3>{{$item->goods_number}}</h3>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Price</h5>
						</div>
						<div class="col s7">
							<h5>${{$item->goods_price}}</h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Action</h5>
						</div>
						<div class="col s7">
							<h5><i class="fa fa-trash"></i></h5>
						</div>
					</div>
				</div>
				<div class="divider"></div>
			@endforeach
			<div class="total">
				<div class="row">
					<div class="col s7">
						<h6>Total</h6>
					</div>
					<div class="col s5">
						<h6>${{$total}}</h6>
					</div>
				</div>
			</div>
			<button class="btn button-default" id="tobuy">确认订单</button>
		</div>
	</div>
@endsection
@section('js')
<script>

	// alert($);
	$(function(){
		// alert($);
		$('#tobuy').click(function(){
			
			var goods_id=new Array();
			var _this=$(this);
			goods_id.push({{$goods_id}});
			// alert(goods_id);
			location.href="{{url('order/order_index')}}?goods_id="+goods_id;
		
		});
	})
</script>
@endsection
</body>
</html>