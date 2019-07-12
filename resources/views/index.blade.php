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
@section('title','商品列表')
@section('pages_section')	
<div class="section product product-list">
		<div class="container">
			<div class="pages-head">
				<h3>PRODUCT LIST</h3>
			</div>
			<div class="input-field">
				<div class="select-wrapper"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-9f808fbd-b692-f518-4226-21bd6d7c84eb" value="Popular"><ul id="select-options-9f808fbd-b692-f518-4226-21bd6d7c84eb" class="dropdown-content select-dropdown "><li class=""><span>Popular</span></li><li class=""><span>New Product</span></li><li class=""><span>Best Sellers</span></li><li class=""><span>Best Reviews</span></li><li class=""><span>Low Price</span></li><li class=""><span>High Price</span></li></ul><select class="initialized">
					<option value="">Popular</option>
					<option value="1">New Product</option>
					<option value="2">Best Sellers</option>
					<option value="3">Best Reviews</option>
					<option value="4">Low Price</option>
					<option value="5">High Price</option>
				</select></div>
			</div>
			<div class="row">
			@foreach($data as $item)
				<div class="col s6">
					<div class="content">
						<img src="{{$item->goods_pic}}" alt="">
						<h6><a href="">{{$item->goods_name}}</a></h6>
						<div class="price">
							$20 <span>${{$item->goods_price}}</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row margin-bottom">
				<div class="col s6">
					<div class="content">
						<img src="img/product-new3.png" alt="">
						<h6><a href="">Fashion Men's</a></h6>
						<div class="price">
							$20 <span>$28</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
				<div class="col s6">
					<div class="content">
						<img src="img/product-new4.png" alt="">
						<h6><a href="">Fashion Men's</a></h6>
						<div class="price">
							$20 <span>$28</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s6">
					<div class="content">
						<img src="img/product-new3.png" alt="">
						<h6><a href="">Fashion Men's</a></h6>
						<div class="price">
							$20 <span>$28</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
				<div class="col s6">
					<div class="content">
						<img src="img/product-new4.png" alt="">
						<h6><a href="">Fashion Men's</a></h6>
						<div class="price">
							$20 <span>$28</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
			</div>	
			<div class="pagination-product">
				<ul>
					<li class="active">1</li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">4</a></li>
					<li><a href="">5</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection

</body>
</html>