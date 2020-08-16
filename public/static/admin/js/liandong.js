var form = layui.form,layer = layui.layer;
var allCheckAttr=[];
//根据分类id获取对应的属性并显示在属性列表中
form.on('select(pid)', function(data){
    var content='';
    $.ajax({
        url:cateUrl,
        data:{cateid:data.value},
        method:'POST',
        success(data){
            if(data.length>0){
                for(var i=0;i<data.length;i++){
                    content+='<input lay-filter="checkAttr" class="checkAttr" type="checkbox" id="'+data[i].id+'" val="'+data[i].attrvalue+'" lay-skin="primary" title="'+data[i].attrname+'">'
                }
                content+='<input type="text" class="attrid" name="attr_id">'
            }
            $('#cateAttr').html(content);
            $("#AttrList").html('')
            $('#creatTable').html('')
            form.render();
        }
    })


});
//选择属性后生成属性列表
form.on('checkbox(checkAttr)', function(){
    allCheckAttr=[];
    var temp=[];
    for(var i=0;i<$('.checkAttr').length;i++){
        if($('.checkAttr').eq(i).is(':checked')==true){
            allCheckAttr.push({
                id:$('.checkAttr').eq(i).attr('id'),
                val:$('.checkAttr').eq(i).attr('val'),
                title:$('.checkAttr').eq(i).attr('title')
            })
            temp.push($('.checkAttr').eq(i).attr('id'))
        }
    }
    $('#creatTable').html('')
    $(".attrid").val(temp.toString())
    creatAttrList(allCheckAttr);
});
function creatAttrList(attr) {
    var content='';
    $("#AttrList").html('')
    for(var i=0;i<attr.length;i++){
        var data=attr[i];
        var attrval=data.val.split('|');
        content+='<dl>';
        content+='<dt>'+data.title+'</dt>';
        content+='<dd>';
        for(var j=0;j<attrval.length;j++){
            content+='<input lay-filter="checkAttrval" class="checkAttrval" type="checkbox"  lay-skin="primary" id="'+data.id+'" ptitle="'+data.title+'" title="'+attrval[j]+'">'
        }
        content+='</dd>';
        content+='</dl>';
    }
    $("#AttrList").html(content);
    form.render();

}
//获取属性列表选中的值
form.on('checkbox(checkAttrval)',function () {
    var attr=[];
    for(var i=0;i<$('.checkAttrval').length;i++){
        if($('.checkAttrval').eq(i).is(':checked')==true){
            attr.push({
                id:$('.checkAttrval').eq(i).attr('id'),
                title:$('.checkAttrval').eq(i).attr('ptitle'),
                val:$('.checkAttrval').eq(i).attr('title')
            });
        }
    }
    var selectResult=groupObj(attr);
    // selectResult格式：[{id:5,title:颜色,val:[16g,32g]},{id:5,title:颜色,val:[16g,32g]}]
    var result=getAllSelectAttr(selectResult);
    //result格式：[['蓝色','14g'],['蓝色','14g'],['蓝色','14g']]
    creatTable(result,selectResult);
})
//数据分组
function groupObj(orig){
    var newArr = [],
        types = {},
        i, j, cur;
    for (i = 0, j = orig.length; i < j; i++) {
        cur = orig[i];
        if (!(cur.id in types)) {
            types[cur.id] = {id: cur.id,title:cur.title, val: []};
            newArr.push(types[cur.id]);

        }

        types[cur.id].val.push(cur.val);
    }
    return newArr;
}
function getAllSelectAttr(selectResult) {
    var result=[];
    if(selectResult.length==1){
        result.push(selectResult[0].val)
    }else{
        var temp=[];
        for(var i=0;i<selectResult.length;i++){
            temp.push(selectResult[i].val)
        }
        for (let i = 0; i < temp.length; i++) {
            for (let j = 0; j < temp[i].length; j++) {
                for (let k = i + 1; k < temp.length; k++) {
                    for (let l = 0; l < temp[k].length; l++) {
                        result.push([temp[i][j],temp[k][l]])
                    }
                }
            }
        }
    }
    return result;
}
//创建表格
function creatTable(result,selectResult) {
    var content='';
    console.log(result)
    console.log(result[0].length)
    console.log(selectResult.length)

    if(result.length==0){
        return;
    }

    if(selectResult.length==1){
        content+='<table><tr>'
        for(var i=0;i<selectResult.length;i++){
            content+='<th>'+selectResult[i].title+'</th>'
        }
        content+='<th>价格</th>'
        content+='<th>库存</th>'
        content+='<th>编号</th>'
        content+='<th>备注</th></tr>'
        for(var i=0;i<result[0].length;i++){
            content+='<tr>'
            content+='<td><input type="text" name="attr_0[]" value="'+result[0][i]+'" placeholder="请输入价格" class="layui-input"></td>'
            content+='<td><input type="text" name="price[]"   placeholder="请输入价格" class="layui-input"></td>'
            content+='<td><input type="text" name="stock[]"  placeholder="请输入库存" class="layui-input"></td>'
            content+='<td><input type="text" name="product_num[]"  placeholder="请输入商品编号" class="layui-input"></td>'
            content+='<td><input type="text" name="remark[]"  placeholder="请输入备注信息" class="layui-input"></td></tr>';
        }
        content+='</table>'
    }
    else{
        content+='<table><tr>'
        for(var i=0;i<selectResult.length;i++){
            content+='<th>'+selectResult[i].title+'</th>'
        }
        content+='<th>价格</th>'
        content+='<th>库存</th>'
        content+='<th>编号</th>'
        content+='<th>备注</th></tr>'

        for(var i=0;i<result.length;i++){
            content+='<tr>'
            for(var j=0;j<result[i].length;j++){
                content+='<td><input type="text" name="attr_'+j+'[]" value="'+result[i][j]+'" placeholder="请输入价格" class="layui-input"></td>'
            }
            content+='<td><input type="text" name="price[]"   placeholder="请输入价格" class="layui-input"></td>'
            content+='<td><input type="text" name="stock[]"  placeholder="请输入库存" class="layui-input"></td>'
            content+='<td><input type="text" name="product_num[]"  placeholder="请输入商品编号" class="layui-input"></td>'
            content+='<td><input type="text" name="remark[]"  placeholder="请输入备注信息" class="layui-input"></td></tr>';
        }
        content+='</table>'
    }
    //表头创建



    $("#creatTable").html(content)
    form.render();
}
//添加规格
function addSpec() {
    var specContent='<div class=\"layui-form-item\">'
    specContent+='<div class="layui-input-inline" style="margin-left: 100px;">';
    specContent+='<input type="text" name="specname[]" class="layui-input" placeholder="请输入规格名称"></div>';
    specContent+='<div class="layui-input-inline">';
    specContent+='<input type="text" name="specvalue[]"  class="layui-input" placeholder="请输入规格内容">';
    specContent+='</div>';
    specContent+='<a href="javascript:;" class="specDelBtn" onclick="specDelBtn(this)">删除规格</a>';
    specContent+='</div>';
    $('.specContent').append(specContent);
}
var ue = UE.getEditor('editor');
ue.ready(function() {
    ue.setHeight(510);
});
