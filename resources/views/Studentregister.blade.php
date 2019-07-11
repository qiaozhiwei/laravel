@extends('layout.parent')
@section('title','注册')
@section('pages_section')
<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
			<div class="register">
				<div class="row">
					<form class="col s12" method="post" action="{{url('StudentController/doregister')}}">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate" placeholder="NAME" name="user_name" required="">
						</div>
						<div class="input-field">
							<input type="text" placeholder="EMAIL" class="validate" name="user_email" required="">
						</div>
						<div class="input-field">
							<input type="password" placeholder="PASSWORD" class="validate" name="user_pwd" required="">
						</div>
                        <input type="submit" class="btn button-default" value="Register">
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection