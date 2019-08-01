@extends('layout.goodsparent')
@section('body')
<form action="{{url('bank/index')}}" method="get">
    <p>
        出发地:<input type="text" name="start" value="{{$start}}">
        目的地:<input type="text" name="end" value="{{$end}}">
        <input type="submit" value="搜索">
    </p>
</form>
<table class="layui-table">
 <caption>
    <h3>
      您搜索了{{$num}}次
    </h3>
 </caption>
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>车次</th>
      <th>出发地</th>
      <th>目的地</th>
      <th>价钱</th>
      <th>票数</th>
      <th>出发时间</th>
      <th>到达时间</th>
      <th>备注</th>
    </tr> 
  </thead>
  <tbody>
      @foreach($data as $item)
    <tr>
      <td>{{$item->train}}</td>
      <td>{{$item->start}}</td>
      <td>{{$item->end}}</td>
      <td>{{$item->price}}</td>
      <td>
          @if($item->number>=100)
          有
          @elseif($item->number==0)
          无
          @else
          {{$item->number}}
          @endif
      </td>
      <td>{{date("Y-m-d H:i:s",$item->start_time)}}</td>
      <td>{{date("Y-m-d H:i:s",$item->end_time)}}</td>
      <td>
       @if($item->number==0)
        无票
        @else
        <a href="javascript:;">预约</a>
        @endif       
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<tr>
    <td>
    {{ $data->appends(['start' => "$start",'end'=>"$end"])->links() }}
    </td>
</tr>
@endsection