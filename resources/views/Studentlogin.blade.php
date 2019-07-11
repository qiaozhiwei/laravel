@extends('layout.parent')
@section('title','登录')

@section('pages_section')
<div class="pages section">

		<div class="container">
			<div class="pages-head">
				<h3>LOGIN</h3>
			</div>
			<div class="login">
				<div class="row">
					<form class="col s12" method="post" action="{{url('StudentController/dologin')}}">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate valid" name="user_name" placeholder="USERNAME" required="">
						</div>
						<div class="input-field">
							<input type="password" class="validate valid" name="user_pwd" placeholder="PASSWORD" required="">
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
                        <input type="submit" class="btn button-default" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

    