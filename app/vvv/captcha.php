<?php 
namespace app\vvv;

use Illuminate\Http\Request;

/**
 * 验证码类
 */
	class captcha{
	       private $width;
	       private $height;
	       private $num;        //验证码位数
	       private $fontsize;
	       private $pixes;        //干扰点的密集度
	       private $lines;        //干扰线的密集度        
	       /**
	        * 构造函数初始化数据
	        * @AuthorHTL-Mr.K
	        * @DateTime  2017-12-23T18:46:36+0800
	        * @param     int                   $width  验证码画布宽度
	        * @param     int                   $height 画布高度
	        * @param     int                   $num    验证码位数
	        * @param     int                   $fontsize  验证码字体大小
	        * @param     int                  $pixes   干扰点密集度
	        * @param     int                  $lines   干扰线密集度
	        */
	       function __construct($width,$height,$num=4,$fontsize=6,$pixes=200,$lines=200){
	               $this->width=$width;
	               $this->height=$height;
	               $this->num=$num;
	               $this->fontsize=$fontsize;
	               $this->pixes=$pixes;
	               $this->lines=$lines;
	       }
	     
	       /**
	        * 产生验证码图片
	        * @AuthorHTL
	        * @DateTime  2017-12-23T19:14:51+0800
	        * @return    null
	        */
	       public function createImage(){
	               //制作画布
	               $img=imagecreatetruecolor($this->width, $this->height);
	               //设定背景色
	               $bgcolor=imagecolorallocate($img, 255, 255, 255);
	               imagefill($img, 0, 0, $bgcolor);
	               //制作干扰点
	               $this->getPixels($img);
	               //制作干扰线
	               $this->getLines($img);
	               //增加验证码
	               $captcha=$this->getCaptcha();
	               //增加文字颜色
	               $fontcolor=imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	               //文字的起始位置
	               $start_x = ceil($this->width/2) - 25;
	            $start_y = ceil($this->height/2) - 8;
	            if(imagestring($img, $this->fontsize,$start_x,$start_y,$captcha,$fontcolor)){
	                header('Content-type:image/png');
	                imagepng($img);
	            }else{
	                return false;
	            }
	       }


	         /**
	        * 获取验证码随机字符串
	        * @AuthorHTL
	        * @DateTime  2017-12-23T18:50:31+0800
	        * @return    string         $captcha ,返回值验证码
	        */
	       private function getCaptcha(){
	               $str=implode("", array_merge(range('a', 'z'),range('A', 'Z'),range(1, 9)));
	               $captcha='';
	               for ($i=0,$len=strlen($str);$i < $this->num ; $i++) { 
	                   $captcha.=$str[mt_rand(0,$len-1)].' ';
	               }
				   //将数据存储在session中
				   $captcha=str_replace(' ','',$captcha);
				   session(['captcha' => $captcha]);
	            //    $_SESSION['captcha']=str_replace(' ','',$captcha);
	               //返回值
	               return $captcha;
		   }
		   
		   


	        /*
	         * 增加干扰点
	         * @param1 resource $img
	        */
	        private function getPixels($img){
	            //增加干扰点
	            for($i = 0;$i < $this->pixes;$i++){
	                //分配颜色
	                $pixel_color = imagecolorallocate($img,mt_rand(100,150),mt_rand(100,150),mt_rand(100,150));

	                //画点
	                imagesetpixel($img,mt_rand(0,$this->width),mt_rand(0,$this->height),$pixel_color);
	            }
	        }

	        /*
	         * 增加干扰线
	         * @param1 resource $img，要增加干扰线的图片资源
	        */
	        private function getLines($img){
	            //增加干扰线
	            for($i = 0;$i < $this->lines;$i++){
	                //分配颜色
	                $line_color = imagecolorallocate($img,mt_rand(150,200),mt_rand(150,200),mt_rand(150,200));

	                //画线
	                imageline($img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$line_color);
	            }
	        }
	        /**
	         * 静态方法校验验证码
	         * @AuthorHTL
	         * @DateTime  2017-12-23T19:34:06+0800
	         * @param     string     $captcha  用户提交的验证码
	         * @return    bool       成功功返回true，失败返回false             
	         */
	       public static function checkCaptcha($captcha){
	           return (strtolower($captcha) === strtolower($_SESSION['captcha']));
	       } 


	}
