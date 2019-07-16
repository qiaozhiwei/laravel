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
@section('footer')
<div class="slider" style="height: 440px; touch-action: pan-y;">
		
		<ul class="slides" style="height: 400px;">
			<li class="" style="opacity: 0; transform: translateX(0px) translateY(0px);">
				<img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" style="background-image: url(&quot;img/slide1.jpg&quot;);">
				<div class="caption slider-content center-align" style="opacity: 0; transform: translateY(-100px) translateX(0px);">
					<h2>WELCOME TO MSTORE</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
			<li class="active" style="opacity: 1; transform: translateX(0px) translateY(0px);">
				<img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" style="background-image: url(&quot;img/slide2.jpg&quot;);">
				<div class="caption slider-content center-align" style="opacity: 1; transform: translateY(0px) translateX(0px);">
					<h2>JACKETS BUSINESS</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
			<li class="" style="opacity: 0; transform: translateX(0px) translateY(0px);">
				<img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" style="background-image: url(&quot;img/slide3.jpg&quot;);">
				<div class="caption slider-content center-align" style="opacity: 0; transform: translateY(-100px) translateX(0px);">
					<h2>FASHION SHOP</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
		</ul>

	<ul class="indicators"><li class="indicator-item"></li><li class="indicator-item active"></li><li class="indicator-item"></li></ul></div>




    <div class="features section">
		<div class="container">
			<div class="row">
				<div class="col s6">
					<div class="content">
						<div class="icon">
							<i class="fa fa-car"></i>
						</div>
						<h6>Free Shipping</h6>
						<p>Lorem ipsum dolor sit amet consectetur</p>
					</div>
				</div>
				<div class="col s6">
					<div class="content">
						<div class="icon">
							<i class="fa fa-dollar"></i>
						</div>
						<h6>Money Back</h6>
						<p>Lorem ipsum dolor sit amet consectetur</p>
					</div>
				</div>
			</div>
			<div class="row margin-bottom-0">
				<div class="col s6">
					<div class="content">
						<div class="icon">
							<i class="fa fa-lock"></i>
						</div>
						<h6>Secure Payment</h6>
						<p>Lorem ipsum dolor sit amet consectetur</p>
					</div>
				</div>
				<div class="col s6">
					<div class="content">
						<div class="icon">
							<i class="fa fa-support"></i>
						</div>
						<h6>24/7 Support</h6>
						<p>Lorem ipsum dolor sit amet consectetur</p>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="section quote">
		<div class="container">
			<h4>FASHION UP TO 50% OFF</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
		</div>
	</div>

    <div class="section product">
		<div class="container">
			<div class="section-head">
				<h4>NEW PRODUCT</h4>
				<div class="divider-top"></div>
				<div class="divider-bottom"></div>
			</div>
			<div class="row">
				@foreach($data as $item)
				<div class="col s6">
					<div class="content">
						<img src="{{$item->goods_pic}}" width="100px;" height="100px;" class="pdd" id="{{$item->id}}">
						<h6><a href="">{{$item->goods_name}}</a></h6>
						<div class="price">
							$20 <span>${{$item->goods_price}}</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
                @endforeach
			</div>
			
		</div>
	</div>

    <div class="promo section">
		<div class="container">
			<div class="content">
				<h4>PRODUCT BUNDLE</h4>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
				<button class="btn button-default">SHOP NOW</button>
			</div>
		</div>
	</div>

    <div class="section product">
		<div class="container">
			<div class="section-head">
				<h4>TOP PRODUCT</h4>
				<div class="divider-top"></div>
				<div class="divider-bottom"></div>
			</div>
			<div class="row">
            @foreach($arr as $v)
				<div class="col s6">
					<div class="content">
						<img src="{{$v->goods_pic}}" width="100px;" htight="100px;" class="pdd" id="{{$v->id}}">
						<h6><a href="">{{$v->goods_name}}</a></h6>
						<div class="price">
							$20 <span>${{$v->goods_price}}</span>
						</div>
						<button class="btn button-default">ADD TO CART</button>
					</div>
				</div>
                @endforeach
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

    <div class="footer">
		<div class="container">
			<div class="about-us-foot">
				<h6>Mstore</h6>
				<p>is a lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
			</div>
			<div class="social-media">
				<a href=""><i class="fa fa-facebook"></i></a>
				<a href=""><i class="fa fa-twitter"></i></a>
				<a href=""><i class="fa fa-google"></i></a>
				<a href=""><i class="fa fa-linkedin"></i></a>
				<a href=""><i class="fa fa-instagram"></i></a>
			</div>
			<div class="copyright">
				<span>© 2017 All Right Reserved</span>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script>
    $(function(){
        $('.pdd').click(function(){
            // alert(11111);
            var _this=$(this);
            // console.log(_this);return false;
            var id=_this.attr('id');
            // alert(id);return false;
            location.href="{{url('Index/pro')}}?id="+id;
        });
    });
</script>
@endsection
</body>
</html>