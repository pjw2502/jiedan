<!DOCTYPE  html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>全自动接单</title>
    <!--boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                if (typeof jQuery == "undefined"){
                    alert('jQuery未加载')
                }
                var i =1
            })
            function tj(){
                var a = 1
                $.ajax({
                    type: "GET",
                    url:"https://jiedan.herokuapp.com/admin/dianfu",
                    data:{
                        'cookie':$("#cookie").val()
                    },
                    success(res){
                        $("#detail").html(res)
                        var id = $(".btn-task-accept").data("id")
                        var url = $(".btn-task-accept").data("url")
                        var nick_id = $(".btn-task-accept").data("nick-id")
                        var task_info = $(".btn-task-accept").data("task-info")
                        var fill = $(".back").text()
                        var jishu = parseInt($("#jishu").html()) +1
                        if ($("#cookie").val()==''){
                            $("#ck").html("请设置正确的cookie")
                            $("#jl2").html("请设置cookie")
                        } else if(fill=="返回"){
                            $("#ck").html("")
                            $("#jl2").html("一单已经接到")
                            $("#shu").html(jishu)
                            $("#jishu").html(jishu)
                        } else if (id==null){
                            $("#ck").html("")
                            $("#jl2").html("没一单")
                            $("#shu").html(jishu)
                            $("#jishu").html(jishu)
                        } else {
                            $.ajax({
                                type:"GET",
                                url:"https://jiedan.herokuapp.com/admin/tj",
                                data:{
                                    'id':id,
                                    'url':url,
                                    'nick_id':nick_id,
                                    'task_info':task_info,
                                    'fill':fill,
                                    'cookie':$("#cookie").val()
                                },
                                success(res){
                                    var jishu2 = parseInt($("#jishu2").html()) +1
                                    var jishu3 = parseInt($("#jishu3").html()) +1
                                    $("#ck").html("")
                                    var a = JSON.parse(res)
                                    var b = task_info.df_commission_to_buyer
                                    if (a.code==0){
                                        var time = new Date()
                                        var dd = time.getHours()+":"+time.getMinutes()+":"+time.getSeconds()+"->"+time.getDay()
                                        $("#jl3").html(a.msg)
                                        $("#shu2").html(jishu2)
                                        $("#jishu2").html(jishu2)
                                        $("#tb").before("<tr><td>"+jishu2+"</td><td>成功</td><td>"+b+"</td><td>"+dd+"</td></tr>")
                                    }
                                    //任务溜走了
                                    $("#jl4").html("一单跑了")
                                    $("#shu3").html(jishu3)
                                    $("#jishu3").html(jishu3)
                                },

                            })
                        }
                    }
                })
            }
            $(function () {
                time()
                $("#stop").hide()
                var stop = null
                $("#start").click(function () {
                    $("#start").hide()
                    $("#stop").show()
                    $("#jl2").html("开始接单")
                    stop = setInterval("tj()",2000)
                })
                $("#stop").click(function () {
                    $("#start").show()
                    $("#stop").css('display','none')
                    $("#jl2").html("停止接单")
                    clearInterval(stop)
                })
            })
                function time() {
                    var time = new Date()
                    $("#time").html(time.getHours()+":"+time.getMinutes()+":"+time.getSeconds())
                    setTimeout("time()",1000)
                }
        </script>
        <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?e12db327877ca33706e3710027f3a1e0";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
    <style type="text/css">
        .hid{
            height: 300px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center" style="color: hotpink">在线接单3.1(old)</h1>

    <div id="time" class="text-center" style="font-size: 20px;"></div>

    <span id="ck" class="label label-warning"></span>
    <input id="cookie" class="form-control" placeholder="输入cookie">
    <button id="start" class="btn btn-primary btn-block">开始接单</button>
    <button id="stop" class="btn btn-block btn-danger">停止接单</button>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">

            <table class="table">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>状态</th>
                    <th>价格</th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody id="tb">

                </tbody>
            </table>
        </div>
        <hr>
        <h4 class="text-center">接单记录</h4>
        <div class="col-lg-12 hid col-md-12 col-xs-12">
            <ul id="jl" class="list-group">
                <li style="color: purple" class="list-group-item">
                    <span id="jl2"></span>
                    <span id="shu" class="label label-default"></span>
                </li>
                <li class="list-group-item">
                    <span id="jl3" style="color: red"></span>
                    <span id="shu2" class="label label-success"></span>
                </li>
                <li class="list-group-item">
                    <span id="jl4"></span>
                    <span id="shu3" class="label label-info"></span>
                </li>
            </ul>
        </div>
    </div>
    <div id="detail" hidden="ture"></div>
    <span class="label label-warning hidden" id="jishu">0</span>
    <span class="label label-warning hidden" id="jishu2">0</span>
    <span class="label label-warning hidden" id="jishu3">0</span>
</div>
</body>
</html>
