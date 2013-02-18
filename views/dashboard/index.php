<ul id="tabs">
    <li><a href="#" name="#tab1">Category</a></li>
    <li><a href="#" name="#tab2">Product</a></li>
    <li><a href="#" name="#tab3">News</a></li>
    <li><a href="#" name="#tab4">Four</a></li>    
</ul>

<div id="dashboardContent">
    <div id="tab1" >
        <div class="table">
            <div class="row">
                <h2>Quản lí danh mục sản phẩm</h2>
                <p>Thêm, sửa, xóa các danh mục theo form dưới đây.</p>
                <br>
                <br>
            </div>  
            <div class="row">
                <div class="cell" style="border: solid black 1px;">
                    <?php
                    createTree($this->category);

                    function createTree($cate) {

                        function treeDraw($item, $childList, $Name) {
                            if ($item == -1) {
                                echo '<li><a href="#" class="insertOption"><+></a></li>';
                                return;
                            }
                            if ($item != 0) {
                                if (isset($childList[$item])) {
                                    echo '<li ref="' . $item . '"><a href="#" class="cateTree">' .
                                    $Name[$item] . '</a><a class="renameOption" href="#">    R</a>';
                                } else { // nếu là nút lá, không có con
                                    echo '<li ref="' . $item . '"><a href="#" class="cateTree">' .
                                    $Name[$item] . '</a><a class="delOption" href="#">    --</a>
                                        <a class="renameOption" href="#">    R</a>';
                                }
                            }
                            if (isset($childList[$item])) {//nếu item có con
                                if ($item == 0) {
                                    echo '<ul id="cateTree">';
                                } else {
                                    echo "<ul>";
                                }
                                foreach ($childList[$item] as $child) {
                                    treeDraw($child, $childList, $Name);
                                }
                                echo "</ul>";
                            } else {
                                echo '<ul><li><a href="#" class="insertOption"><+></a></li></ul>';
                            }

                            if ($item != 0) {
                                echo '</li>';
                            }
                        }

                        $children = array();
                        $Name = array();
                        foreach ($cate as $item) {
                            if (!isset($children[$item['parent']])) {
                                $children[$item['parent']] = array();
                            }
                            array_push($children[$item['parent']], $item['id']);
                            $Name[$item['id']] = $item['name'];
                        }
                        foreach (array_keys($children) as $key) {
                            array_push($children[$key], -1);
                        }


                        //print_r($children);

                        treeDraw(0, $children, $Name);
                    }
                    ?>
                </div>

                <div class="cell">
                    <form id="categoryManageForm" action="<?php echo HTTP_SERVER; ?>dashboard/category" method="post">
                        <div class="input">
                            Tên nhãn &nbsp; &nbsp;<input type="text" name="name"/><input type="hidden" name="id"/>&nbsp;&nbsp;<input type="submit" value="xác nhận">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <div class="table">
            <div class="row"> <br>         
                Danh sách các sản phẩm, tổng số <b class="count"></b><br><br> 
                <div id="productList" class="table"></div>         
            </div>
        </div>
    </div>
    <div id="tab2">
        <h2>Vivamus fringilla suscipit justo</h2>
        <p>Aenean dui nulla, egestas sit amet auctor vitae, facilisis id odio. Donec dictum gravida feugiat.</p>
        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras pretium elit et erat condimentum et volutpat lorem vehicula</p>

        <p>Morbi tincidunt pharetra orci commodo molestie. Praesent ut leo nec dolor tempor eleifend.</p>    
    </div>
    <div id="tab3">
        <h2>Phasellus non nibh</h2>
        <p>Non erat laoreet ullamcorper. Pellentesque magna metus, feugiat eu elementum sit amet, cursus sed diam. Curabitur posuere porttitor lorem, eu malesuada tortor faucibus sed.</p>
        <h3>Duis pulvinar nibh vel urna</h3>
        <p>Donec purus leo, porttitor eu molestie quis, porttitor sit amet ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan ornare elit id imperdiet. </p>
        <p>Suspendisse ac libero mauris. Cras lacinia porttitor urna, vitae molestie libero posuere et. </p>
    </div>
    <div id="tab4">
        <h2>Cum sociis natoque penatibus</h2>
        <p>Magnis dis parturient montes, nascetur ridiculus mus. Nullam ac massa quis nisi porta mollis venenatis sit amet urna. Ut in mauris velit, sed bibendum turpis.</p>
        <p>Nam ornare vulputate risus, id volutpat elit porttitor non. In consequat nisi vel lectus dapibus sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent bibendum sagittis libero.</p>
        <h3>Imperdiet sem interdum nec</h3>
        <p>Mauris rhoncus tincidunt libero quis fringilla.</p>    
    </div>
</div>

<script>
    //run after page loaded successfully
    $(".insertOption").parent().hide();
    $(".renameOption").hide();
    $(".delOption").hide();
    $(".insertOption:last").parent().show();
    function hideOption(){
        $(".renameOption").hide();
        $(".delOption").hide();
        $(".insertOption").parent().hide();
        $(".insertOption:last").parent().show();
    }
    $(".insertOption").click(function(){        
        $(this).before('<input type="text" name="value" class="required"/>');
        $(this).hide();
        $(this).after('<a href="#" class="cancel">&nbsp; cancel</a>');
        $(this).after('<a href="#" class="add">&nbsp; add</a>');
        $(".renameOption").hide();
        $(".delOption").hide();
        $(".cancel").click(function(){ 
            hideOption();
            $(this).siblings(".insertOption").show();
            $(this).siblings("input").remove();
            $(this).siblings("a.add").remove();
            $(this).remove();
            
        });
        $(".add").click(function(){
            var par = $(this).parent().parent().parent().attr("ref");
            if(typeof(par) == "undefined" || par === null) {
                par = 0;
            }
            var op = 1; //insert
            var val = $(this).siblings("input").val(); 
            if( !val ){
                alert("name can't be null!");
                return;
            }
            $.post('dashboard/category', {'id': par, 'op':op, 'value':val}, function(o) {
                if(o==true){
                    location.reload();
                }else{
                    alert("an error occured!");
                    location.reload(); 
                }
            }, 'json');  
        });
    });
    $("a.cateTree").click(function(){    
        hideOption();
        $(this).siblings(".renameOption").show();
        $(this).siblings(".delOption").show();
        $(this).siblings(":last").children(":last").show();
        var id = $(this).parent().attr("ref");    
        
        viewList(id);
        $("a.cateTree").css({"background": "#fff"});
        $(this).css({"background": "#aaa"});            
    });
    
    $(".renameOption").click(function(){        
        $(this).before('<input type="text" name="value" class="required"/>');
        $(this).siblings("a.cateTree").hide();
        $(this).siblings("a.delOption").hide();
        var text = $(this).siblings("a.cateTree").text();
        $(this).siblings("input").val(text);
        $(this).hide();
        $(this).after('<a href="#" class="cancel">&nbsp; cancel</a>');
        $(this).after('<a href="#" class="ok">&nbsp; ok</a>');
        $(this).siblings(":last").children(":last").hide();
        $(".cancel").click(function(){
            $(this).siblings("a.cateTree").show();
            $(this).siblings("renameOption").show();
            $(this).siblings("input").remove();
            $(this).siblings("a.ok").remove();
            $(this).remove();
        });
        $(".ok").click(function(){
            var id = $(this).parent().attr("ref");            
            var op = 2; //update
            var val = $(this).siblings("input").val(); 
            if( !val ){
                alert("name can't be null!");
                return;
            }
            $.post('dashboard/category', {'id': id, 'op':op, 'value':val}, function(o) {
                if(o==true){
                    location.reload();
                }else{
                    alert("an error occured!");
                    location.reload(); 
                }
            }, 'json');  
        });
    });
    $(".delOption").click(function(){
        var id = $(this).parent().attr("ref");  
        var op = 0; //delete
        $.post('dashboard/category', {'id': id, 'op':op}, function(o) {
            if(o==1){
                location.reload();
            }else{
                alert("an error occured!");
                location.reload(); 
            }
        }, 'json');
    });
    function viewList(id){
        $.post('dashboard/getCategoryListProduct', {'id': id}, function(o) {
            //console.log(o[0]);
            var count=o.length;
            if(!count){
                count=0;
                $("#productList").html("");
            }else{
                $("#productList").html(            
                    '<div class="row">\n\
                        <div class="cell">stt</div>\n\
                        <div class="cell">tên sản phẩm</div>\n\
                        <div class="cell">ảnh sản phẩm</div>\n\
                        <div class="cell">giá (ngàn đồng)</div>\n\
                        <div class="cell">mô tả</div>\n\
                    </div>'
                );    
            }
            $("b.count").html(count);
            
            for (var i = 0; i < count; i++) {
                $("#productList").append(
                '<div class="row">\n\
                        <div class="cell">'+i+'</div>\n\
                        <div class="cell">'+o[i]["productName"]+'</div>\n\
                        <div class="cell"><img src="'+o[i]["image"]+'"></div>\n\
                        <div class="cell">'+o[i]["price"]+'</div>\n\
                        <div class="cell">'+o[i]["description"]+'</div>\n\
                    </div>'
            );
            }
        }, 'json');  
    }    
    
</script>

<script>
    function resetTabs(){
        $("#dashboardContent > div").hide(); //Hide all content
        $("#tabs a").attr("id",""); //Reset id's      
    }

    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0,4); // For the above example, myUrlTabName = #tab

    (function(){
        $("#dashboardContent > div").hide(); // Initially hide all content
        $("#tabs li:first a").attr("id","current"); // Activate first tab
        $("#dashboardContent > div:first").fadeIn(); // Show first tab content
        
        $("#tabs a").on("click",function(e) {
            e.preventDefault();
            if ($(this).attr("id") == "current"){ //detection for current tab
                return       
            }
            else{             
                resetTabs();
                $(this).attr("id","current"); // Activate this
                $($(this).attr('name')).fadeIn(); // Show content for current tab
            }
        });

        for (i = 1; i <= $("#tabs li").length; i++) {
            if (myUrlTab == myUrlTabName + i) {
                resetTabs();
                $("a[name='"+myUrlTab+"']").attr("id","current"); // Activate url tab
                $(myUrlTab).fadeIn(); // Show url tab content        
            }
        }
    })()
</script>
