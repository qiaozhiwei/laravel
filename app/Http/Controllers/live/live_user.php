<?php

namespace App\Http\Controllers\live;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use vendor\laravel\framework\src\Illuminate\Database\Query;

class live_user extends Controller
{
    public function create()
    {
        return view("live/create");
    }


    public function docreate(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $pwd=md5($data['pwd']);
        // dd($pwd);
        $arr=['user_name'=>$data['user_name'],'pwd'=>$pwd,'state'=>$data['state']];
        // dd($arr);
        $res=DB::table('live_user')->insert($arr);
        // dd($res);
        if($res){
            return redirect("live_user/index");
        }else{
            echo "false";
        }
    }

    public function index()
    {
        return view("live/index");
    }

    public function login()
    {
        return view("live/login");
    }

    public function dologin(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $pwd=md5($data['pwd']);
        $where=[
            ['user_name','=',$data['user_name']],
            ['pwd','=',$pwd],
        ];
        // dd($where);
        $count=DB::table('live_user')->where($where)->count();
        // dd($count);
        if($count>0){
            //登陆成功，将用户信息存入session
            // dd($request->session()->get('user_name'));取值
            $request->session()->put("user_name",$data['user_name']);
            return redirect("live_user/list");
        }else{
            echo "登陆失败";
        }
    }

    public function list(Request $request)
    {

        // $user_name=$request->session()->get("user_name")
        // dd($user_name);
        $where=[
            ['user_name','=',$user_name],
        ];
        $state=DB::table("live_user")->where($where)->select("state")->first();
        $state=get_object_vars($state)['state'];
        // dd($state);
        return view("live/list",['state'=>$state]);
    }


    public function create_team()
    {
        return view("live/create_team");
    }


    public function docreate_team(Request $request)
    {
        $time=strtotime($request->all()['start_time']);
        $data=['name_first'=>$request->all()['name_first'],'name_second'=>$request->all()['name_second'],'start_time'=>$time];
        // dd($data);
        $res=DB::table("live_team")->insert($data);
        // dd($res);
        if($res){
            return redirect("live_user/team_list");
        }else{
            echo "false";
        }
    }

    //前台



    public function index_login()
    {
        return view("index_login/login");
    }


    public function index_dologin(Request $request)
    {
        // dd($request->all());
        $pwd=md5($request->all()['pwd']);
        $where=[
            ['user_name','=',$request->all()['user_name']],
            ['pwd','=',$pwd],
        ];
        $wheres=[
            ['user_name','=',$request->all()['user_name']],
        ];
        // dd($where);
        $count=DB::table("live_user")->where($where)->count();
        $state=DB::table("live_user")->where($wheres)->select("state")->first();
        $state=get_object_vars($state)['state'];
        // dd($state);
        // dd($count);
        if($count==0){
            echo "账号或密码错误";die;
        }else{
            $request->session()->put("index_userName",$request->all()['user_name']);
            if($state==1 || $state==2){
                return redirect("live_user/redi");
            }else{
                return redirect("live_user/chat");
            }
        }

    }


    public function chat(Request $request)
    {
        // dd($request->session()->get('index_userName'));
        $index_userName=$request->session()->get("index_userName");
        $where=[
            ['user_name','=',$index_userName],
        ];
        // dd($where);
        //角色
        $state=DB::table('live_user')->where($where)->select('state')->first();
        $state=get_object_vars($state)['state'];
        // dd($state);
        $states="";
        if($state==1){
            $states="管理员";
        }else if($state==2){
            $states="解说";
        }
        //解说内容
        
        $user_name=$request->session()->get("index_userName");
        return view("live/chat",['user_name'=>$user_name,'state'=>$states]);
    }


    public function Grasp()
    {
        $url="https://www.sina.com.cn/";
        $str=file_get_contents($url);
        // echo $str;
        $patten='#.*<span tab-type="tab-nav" class=" "><a href="http://video.sina.com.cn/sports/" target="_blank" suda-uatrack="key=index_www_tag&amp;value=www_sports_3_click">(.*)</a></span>.*<ul class="mod44-list clearfix SC_Order_Hidden">.*<li><a href="http://euro.sina.com.cn/" target="_blank">(.*)</a></li> --></ul><div class="mod-list-nav clearfix SC_Order_Hidden" data-sudaclick="blk_nav_sports">.*<a href="http://sports.sina.com.cn/hotnews/sports/Daily/" target="_blank">(.*)</a></div>

        <div class="uni-blk-b SC_Order_Fix_Cont">
<div tab-type="tab-cont" data-sudaclick="blk_sports_1" blkclick="auto_nav" blktitle="体育" style="display: none;">
<div class="uni-blk-bt clearfix">
<a href="http://slide.sports.sina.com.cn/cba/slide_2_792_236910.html" target="_blank" class="uni-blk-pic">
                        <img src="//n.sinaimg.cn/sports/transform/266/w640h426/20191209/9a5d-iknhexi2320466.jpg" width="105" height="70">

                        <span>王哲林空砍25+11</span>

                    </a>

<ul class="uni-blk-list01 list-a">

<li><a target="_blank" href="http://sports.sina.com.cn/zt_d/russiabanned/">俄罗斯遭四年禁赛无缘奥运会</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/others/others/2019-12-09/doc-iihnzhfz4710804.shtml">WADA指责俄篡改实验室数据</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/others/eurythmics/2019-12-09/doc-iihnzahi6380677.shtml">俄罗斯官员:对WADA制裁100%上诉</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/others/others/2019-12-09/doc-iihnzhfz4714312.shtml">这些国际赛事或换举办地</a></li>

</ul>		</div>
<div class="blk-line"></div>
<ul class="uni-blk-list02 list-a">

<li><a target="_blank" href="http://sports.sina.com.cn/nba/">NBA常规赛-正直播快船VS步行者</a> <a target="_blank" href="http://sports.sina.com.cn/slamdunk/live.shtml?id=2019121009">11:30直播灰熊VS勇士</a></li>

<li><a target="_blank" href="http://sports.sina.com.cn/others/others/2019-12-09/doc-iihnzahi6384121.shtml">俄罗斯和WADA的恩怨</a> <a target="_blank" href="http://sports.sina.com.cn/others/others/2019-12-09/doc-iihnzhfz4753627.shtml">或延续到巴黎禁</a> <a target="_blank" href="https://sports.sina.com.cn/others/others/2019-12-09/doc-iihnzhfz4746666.shtml">体育斗争新形态</a></li>

<li><a target="_blank" href="http://sports.sina.com.cn/g/premierleague/">英超-奥巴梅扬传射阿森纳3-1</a> <a target="_blank" href="https://sports.sina.com.cn/g/pl/2019-12-10/doc-iihnzahi6411009.shtml">俄罗斯队遭禁无缘世界杯</a></li>


<li><a target="_blank" href="http://sports.sina.com.cn/cba/">CBA-裁判报告:深圳遭多次误判</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/cba/2019-12-09/doc-iihnzahi6392469.shtml">孙悦10+7+6北控擒福建</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/china/j/2019-12-09/doc-iihnzahi6343915.shtml">李霄鹏大概率继续执教鲁能</a> <a target="_blank" href="https://sports.sina.com.cn/china/national/2019-12-09/doc-iihnzhfz4725172.shtml">里皮:我会考虑国家队邀约</a></li>


<li><a target="_blank" href="https://sports.sina.com.cn/china/j/2019-12-09/doc-iihnzhfz4710482.shtml">鲁能这1年:轰轰烈烈两手空</a> <a target="_blank" href="https://sports.sina.com.cn/china/gqgs/2019-12-09/doc-iihnzhfz4676701.shtml">国奥的问题是中国足球缩影</a></li>


<li><a href="http://sports.sina.com.cn/zl/" target="_blank">专栏</a>-<a href="http://sports.sina.com.cn/zl/football/2019-11-29/zldoc-iihnzahi4120797.shtml" target="_blank">又一洋帅对中超开了眼</a> <a href="http://blog.sina.com.cn/lm/sports/" target="_blank">博客</a>-<a target="_blank" href="http://blog.sina.com.cn/s/blog_51ef9d460102zpaq.html">卡帅做了最明智抉择</a></li>

<li><a target="_blank" href="http://sports.video.sina.com.cn/">视频-</a><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-11-26/detail-iihnzhfz1798733.d.html">3X3黄金联赛《战术板》 杨鸣讲解</a> <a target="_blank" href="http://video.sina.com.cn/p/sports/2019-11-26/detail-iihnzahi3460387.d.html">霍楠详解突破</a></li><li><a target="_blank" href="http://lottery.sina.com.cn/">9.5亿大奖得主露脸领奖</a> <a target="_blank" href="http://lottery.sina.com.cn/ai/?from=ls">国足出征东亚杯!小炮剧透赛果</a></li>		</ul>
</div>
<div tab-type="tab-cont" style="" data-sudaclick="blk_sports_2" blkclick="auto_nav" blktitle="NBA">
<div class="data-textarea-wrap">		<div class="uni-blk-bt clearfix">
<a href="http://sports.sina.com.cn/nba/" target="_blank" class="uni-blk-pic">

                      <img src="//n.sinaimg.cn/sports/transform/175/w105h70/20191210/2ef2-iknhexi3118897.jpg" width="105" height="70">
                        <span>正播快船VS步行者</span>


</a><ul class="uni-blk-list01 list-a">






<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzahi6428943.shtml">实力榜：湖人第2绿军重回前5</a></li>





<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzahi6430005.shtml">安东尼曾警告保罗当心被交易</a></li>





<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzahi6429379.shtml">曝锡安今年不会复出至今未训练</a></li><li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4777132.shtml">曝勒夫希望被骑士交易到争冠队</a></li></ul>		</div>
<div class="blk-line"></div>
<ul class="uni-blk-list02 list-a">
<li><a target="_blank" href="http://sports.sina.com.cn/nba/" class="liveNewsLeft">正直播快船VS步行者</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4776227.shtml">周最佳:浓眉+巴特勒</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4621243.shtml">本赛季至今各大奖项预测</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzahi6431547.shtml">曝詹娜和西蒙斯已复合</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4783028.shtml">勇士终于凑满激活名单</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4781346.shtml">保养膝盖！莱昂纳德今日休战</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4784916.shtml">曝小托马斯至少再休战1周</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-10/doc-iihnzhfz4780715.shtml">老鹰向特雷-杨承诺找帮手</a></li>


<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzhfz4612928.shtml">保罗20分颜射甜瓜雷霆客胜开拓者</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzahi6261329.shtml">CP3指着裁判给甜瓜T </a></li>


<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzhfz4532963.shtml">名宿:哈登永远成不了队史最佳</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzhfz4534265.shtml">丁神24+8篮网险胜掘金</a></li>

<li><a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzhfz4535197.shtml">最强175因腿伤将缺阵数场</a> <a target="_blank" href="https://sports.sina.com.cn/basketball/nba/2019-12-09/doc-iihnzahi6189290.shtml">最强175谈绿军球迷嘘欧文</a></li>





<li><a target="_blank" href="http://slide.sports.sina.com.cn/k/slide_2_786_236842.html">高清-天使面庞的纽约拉拉队小姐姐</a> <a target="_blank" href="http://slide.sports.sina.com.cn/k/slide_2_786_236835.html">魔兽34岁生日快乐</a></li><li><a target="_blank" href="http://lottery.sina.com.cn/ai/?from=ls">AI预测猛龙魔术让分全红!狼队大小分5中5</a> <a target="_blank" href="http://lottery.sina.com.cn/ai/app/download/?from=ls">下载APP体验</a></li>		</ul>
</div>
</div>
<div tab-type="tab-cont" style="display: none;" data-sudaclick="blk_sports_3" blkclick="auto_nav" blktitle="体育视频">
<div class="data-textarea-wrap">		<div class="uni-blk-bt clearfix">
<a href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6221986.d.html" target="_blank" class="uni-blk-pic">
                        <img src="//n.sinaimg.cn/sports/transform/175/w105h70/20191209/29ae-iknhexi0102104.png" width="105" height="70">
                        <span>中超嘉尤站第7期</span>
                    </a>			<ul class="uni-blk-list01 list-a">
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-10/detail-iihnzhfz4809944.d.html" class="videoNewsLeft">青少年大师赛练习轮花絮</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzhfz4733357.d.html" class="videoNewsLeft">突破自我丁俊晖王者归来</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6385683.d.html" class="videoNewsLeft">四国赛中国国奥队取得开门红</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6385612.d.html" class="videoNewsLeft">吉林终结新疆四连胜</a></li>
</ul>
</div>
<div class="blk-line"></div>
<ul class="uni-blk-list02 list-a">
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6385770.d.html" class="videoNewsLeft">主场缅怀吉喆离世 北京罚球绝杀深圳</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6385707.d.html" class="videoNewsLeft">速度滑冰世界杯 宁忠岩破纪录夺金创历史</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6375982.d.html" class="videoNewsLeft">俄罗斯遭国际禁赛4年 无缘奥运会世界杯</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzhfz4716238.d.html" class="videoNewsLeft">《足球装备库》欧洲杯比赛球、服陆续上市</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzhfz4680897.d.html" class="videoNewsLeft">2019肯德基中学生3X3总决赛落幕 清华附中夺冠</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6299479.d.html" class="videoNewsLeft">《健身时代》20191208期</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzhfz4639161.d.html" class="videoNewsLeft">啥情况？湖人球迷赛后直接撒币！美元！</a></li>
<li><a target="_blank" href="http://video.sina.com.cn/p/sports/2019-12-09/detail-iihnzahi6297485.d.html" class="videoNewsLeft">总统杯系列小知识之心理战</a></li>
<li><a target="_blank" href="http://sports.sina.com.cn/video/g/premierleague/" class="videoNewsLeft">英超 |</a> <a target="_blank" href="http://sports.sina.com.cn/video/g/laliga/">西甲 |</a> <a target="_blank" href="http://sports.sina.com.cn/video/g/seriea/">意甲 |</a> <a target="_blank" href="http://sports.sina.com.cn/video/g/bundesliga/">德甲 |</a> <a target="_blank" href="http://sports.sina.com.cn/uclvideo/">欧冠 |</a> <a target="_blank" href="http://sports.sina.com.cn/video/csl/">中超 |</a> <a target="_blank" href="http://sports.sina.com.cn/video/c/j/afccl/">亚冠</a></li>		</ul>
</div>
</div>
<!-- 0316 nmod01 -->
<div class="nmod01" data-sudaclick="blk_sports_textad">
<a target="_blank" href="http://sports.sina.com.cn/hdphoto/">高清美图</a>&nbsp;<ins class="sinaads sinaads-done" data-ad-pdps="PDPS000000045982" data-ad-status="done" style="text-decoration: none;"><i style="font-style:normal;">广告:</i><a href="http://saxn.sina.com.cn/click?type=bottom&amp;t=UERQUzAwMDAwMDA0NTk4Mg%3D%3D&amp;url=http%3A%2F%2Fvideo.sina.com.cn%2Fl%2Fpl%2Fmutv%2F1701927.html&amp;sign=284f96e436368976" target="_blank" data-ss="679863634e69f482=ngis&amp;lmth.7291071F2%vtumF2%lpF2%lF2%nc.moc.anis.oedivF2%F2%A3%ptth=lru&amp;D3%D3%gM4kTN0ADMwADMwAzUQREU=t&amp;mottob=epyt?kcilc/nc.moc.anis.nxas//:ptth" onmousedown="return sinaadToolkit.url.fortp(this, event);">曼联登陆新浪</a></ins><script>(sinaads = window.sinaads || []).push({});</script>&nbsp;<ins class="sinaads sinaads-done" data-ad-pdps="PDPS000000045983" data-ad-status="done" style="text-decoration: none;"><i style="font-style:normal;">广告:</i><a href="http://saxn.sina.com.cn/click?type=bottom&amp;t=UERQUzAwMDAwMDA0NTk4Mw%3D%3D&amp;url=http%3A%2F%2Fsports.sina.com.cn%2Fm%2Fsinasport.html&amp;sign=26ce1fdd23924a4b" target="_blank" data-ss="b4a42932ddf1ec62=ngis&amp;lmth.tropsanisF2%mF2%nc.moc.anis.stropsF2%F2%A3%ptth=lru&amp;D3%D3%wM4kTN0ADMwADMwAzUQREU=t&amp;mottob=epyt?kcilc/nc.moc.anis.nxas//:ptth" onmousedown="return sinaadToolkit.url.fortp(this, event);">新浪体育APP 下载</a></ins><script>(sinaads = window.sinaads || []).push({});</script>
</div>
<!-- 0316 nmod01 -->
        </div>
    </div>';
        preg_match_all($patten,$str,$data);
        var_dump($data);
    }

    //跳转页面

    public function redi(Request $request)
    {
        $index_userName=$request->session()->get('index_userName');
        // dd($index_userName);
        $where=[
            ['user_name','=',$index_userName],
        ];
        $state=DB::table("live_user")->where($where)->select('state')->first();
        $state=get_object_vars($state)['state'];
        // dd($state);
        return view("live/redi",['state'=>$state]);
    }


    //选择首发
    public function choose_first()
    {
        // echo "<pre>";
        $data=DB::table("live_team")->get()->toarray();
        // dd($data);
        $team_info=[];
        foreach($data as $k=>$v){
            $name1[]=get_object_vars($v)['name_first'];
            // print_r($name1);
            $name2[]=get_object_vars($v)['name_second'];
            // print_r($name2);
            $name=array_merge($name1,$name2);
            // print_r($name);
            $team_info=array_unique($name);
            
        }
        // $team_info=array_unique($team_info);
        // dd($team_info);
        return view("live/choose_first",['team_info'=>$team_info]);
    }


    public function choose_player(Request $request)
    {
        // dd($request->All());
        $arr=explode(",",$request->all()['arr']);
        dd($arr);
        
        return view("live/choose_player",['player_info'=>$player_info]);
    }


    //比赛结果列表
    public function team_match()
    {
        
    }



    

    
}