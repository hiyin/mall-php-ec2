


var url=router;
layui.use('layer', function() { //独立版的layer无需执行这一句
    var $ = layui.jquery, layer = layui.layer,form=layui.form; //独立版的layer无需执行这一句


    $('.selectShop').click(function () {
        selectShop()
    })
    //监听地址类型
    form.on('select(sfilter)', function(data){
        // console.log($(data.elem[data.elem.selectedIndex]).attr('url'));
        //1表示选择商品
        if(data.value==0){
            $(".selectShop").hide()
            $(".urlAddress").hide()
            $('.type1Address').hide()
        }
        if($(data.elem[data.elem.selectedIndex]).attr('type')==1){
            $(".selectShop").show()
            $(".urlAddress").hide()
            $('.type1Address').show()
        }
        if($(data.elem[data.elem.selectedIndex]).attr('type')==2){
            $(".urlAddress").show()
            $(".selectShop").hide()
            $('.type1Address').hide()

        }

        url=$(data.elem[data.elem.selectedIndex]).attr('url')

        $(".inputUrl").val(url)
        $(".selectShopUrl").val(url)
    });
});

function selectShop() {

    var that = this;
    //多窗口模式，层叠置顶
    parent.layer.open({
        type:2 //此处以iframe举例
        ,title: '请您选择商品'
        ,area: ['800px', '619px']
        ,shade: 0.3
        ,maxmin: true
        ,offset:'auto'
        ,content: shopurl
        ,zIndex: layer.zIndex //重点1
        ,btn:['保存','返回']
        ,yes:function(index, layero){
            var i=parent.window["layui-layer-iframe" + index];
            //获取选中的商品名称
            var shopid=$(i.document).find("#selectId").val();
            $(".type1Address").show();

            $(".selectShopUrl").val(url+'='+shopid)

            // var frameId = $(layero).find("iframe").attr('id');
            // var selectid=$(window.frames[frameId].document).find("#selectId").val();
            // console.log(selectid)
            // if(selectid==''){
            //     console.log('msg')
            //         parent.layer.msg('请选择商品')
            //     return;
            // }

            parent.layer.closeAll()

        }
        ,success: function(layero){
            console.log($(layero).find("#selectId").val())
            parent.layer.setTop(layero); //重点2
        }
    });


}
