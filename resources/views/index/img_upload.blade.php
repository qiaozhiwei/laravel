@extends('layout.userparent')
@section('right')
<form method="post" action="http://upload-z1.qiniup.com"
enctype="multipart/form-data">

 <input name="token" type="hidden" value="{{$token}}">
 <input name="file" type="file" />
 <input type="submit" value="上传文件" />
</form>
@endsection