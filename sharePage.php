<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<meta name="description" content="舟山房产信息网,免费发布舟山房产信息、浏览舟山租房,舟山房价,舟山二手房,新楼盘,别墅,商铺,写字楼房源信息的舟山房产网,每日免费提供真实可靠的舟山二手房,舟山租房,舟山房价等舟山房产信息,发布查看舟山房产信息,网聚舟山千万经纪人和提供真实的房东房源,并可以实现地图找房的舟山房产网" />
	<meta name="keywords" content="舟山房产,舟山房产信息网,舟山房产网,舟山房价,舟山二手房网,舟山租房网,舟山房屋租赁,舟山房屋出售,舟山房屋出租" />
	<title>大舟山房产</title>
	<link rel="stylesheet" type="text/css" href="/static/house_m/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/static/house_m/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="/static/house_m/css/main.css">
	<script src="/static/house_m/js/jquery.js" type="text/javascript"></script>
    <?php if ($ua == 'Wechat') { ?>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
        <script>
            var url = location.href;
            $.ajax({
                type:'POST',
                url:'<?php echo HOST_NAME.'/Admin/ajaxGetSignPackage'; ?>',
                data:{url:url},
                dataType:'json',
                success:function(d) {
                    wx.config({
                        debug: false,
                        appId: d.data.appId,
                        timestamp: d.data.timestamp,
                        nonceStr: d.data.nonceStr,
                        signature: d.data.signature,
                        jsApiList: [
                            'checkJsApi',
                            'onMenuShareTimeline',
                            'onMenuShareAppMessage'
                        ]
                    });
                }
            
            })         

            wx.ready(function () {
                wx.onMenuShareTimeline({
                    title: '<?php echo $shareInfo['shareTitle']; ?>', // 分享标题
                    link: '<?php echo $shareInfo['shareLink']; ?>', // 分享链接
                    imgUrl: '<?php echo $shareInfo['sharePic']; ?>', // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });

                wx.onMenuShareAppMessage({
                    title: '<?php echo $shareInfo['shareTitle']; ?>', // 分享标题
                    desc: '<?php echo $shareInfo['shareDesc']; ?>', // 分享描述
                    link: '<?php echo $shareInfo['shareLink']; ?>', // 分享链接
                    imgUrl: '<?php echo $shareInfo['sharePic']; ?>', // 分享图标
                    type: '', // 分享类型,music、video或link，不填默认为link
                    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () {
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });
            });
        </script>
    <?php } ?>
</head>
<body>
	<div class="share_page">
		<ul class="wrap">
            <?php foreach ($res as $k => $v) { ?>
			<li class="sp_li">
				<span class="li_con hd"><a href="<?php echo $v['detail_url'];?>" class="li_move"><?php echo $v['borough_name']; ?></a></span>
				<span class="li_con num"><?php echo $v['house_price']; ?>万元</span>
				<span class="li_con num"><?php echo $v['house_totalarea']; ?>m²</span>
				<span class="li_con"><?php echo $v['house_info']; ?></span>
			</li>
            <?php } ?>
		</ul>
		<a href="<?php echo HOST_NAME.'/House/houseList?hqt=1'; ?>" class="share_more">更多房源</a>
		<div class="fxm_info clearfix">
			<div class="fxm_left">
				<img class="fxm_avatar" src="<?php echo $jjr_info['avatar'];?>" alt="">
			</div>
			<div class="fxm_right">
				<p class="fxm_con"><span class="fxm_lb">房小蜜：</span><?php echo $jjr_info['username']; ?></p>
				<p class="fxm_con"><span class="fxm_lb">联系方式：</span><?php echo $jjr_info['mobile']; ?></p>
			</div>
		</div>
		<a href="tel:<?php echo $jjr_info['mobile']; ?>" class="shareBtn">
			<img src="/static/house_m/images/third3.png" alt="">
		</a>
	</div>
	<script>
		$(document).ready(function(){
			var clientWid = document.body.clientWidth,
			    doc = document.documentElement;;
			doc.style.fontSize = clientWid / 5 + "px";
			$(window).resize(function(){
				var clientWid = document.body.clientWidth,
				    doc = document.documentElement;
				doc.style.fontSize = clientWid / 5 + "px";
			})
			var height = $(window).height();
			$(".share_page").css("height",height+"px");
			function animate(obj){
				var num = $(".sp_li").length-1;
				obj.css("display","block")
				obj.addClass("animated fadeIn");
				if(obj.index() == num){
					return false;
				}else{
					setTimeout(function(){
						animate(obj.next());
					},900);
				}
			}
			animate($(".sp_li").eq(0));
			$("body").height($(window).height());
			/*function stopDrop(){
				var lastY;//最后一次y坐标点
			    $(document.body).on('touchstart', function(event) {
			        lastY = event.originalEvent.changedTouches[0].clientY;//点击屏幕时记录最后一次Y度坐标。
			    });
			    $(document.body).on("touchmove",function(event){
			    	var y = event.originalEvent.changedTouches[0].clientY;
			        var st = $(this).scrollTop(); //滚动条高度
			        console.log("st = "+st);
			        if (y >= lastY && st <= 0) {//如果滚动条高度小于0，可以理解为到顶了，且是下拉情况下，阻止touchmove事件。
			            lastY = y;
			            event.preventDefault();
			        }
			        lastY = y;
			    })
			}
			stopDrop();*/
		})
	</script>
</body>
</html>