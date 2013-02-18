<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

<script type="text/javascript">
    var url;
    function newUser(){
        $('#dlg').dialog('open').dialog('setTitle','New User');
        $('#fm').form('clear');
        url = '<?php echo HTTP_SERVER ?>usermanage/save_user';
    }
    function editUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#dlg').dialog('open').dialog('setTitle','Edit User');
            $('#fm').form('load',row);
            url = '<?php echo HTTP_SERVER ?>usermanage/edit_user'+row.id;
        }
    }
    function saveUser(){
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dlg').dialog('close');		// close the dialog
                    $('#dg').datagrid('reload');	// reload the user data
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            }
        });
    }
    function removeUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
                if (r){
                    $.post('remove_user.php',{id:row.id},function(result){
                        if (result.success){
                            $('#dg').datagrid('reload');	// reload the user data
                        } else {
                            $.messager.show({	// show error message
                                title: 'Error',
                                msg: result.msg
                            });
                        }
                    },'json');
                }
            });
        }
    }
</script>

<h2>Basic CRUD Application</h2>
<div class="demo-info" style="margin-bottom:10px">
    <div class="demo-tip icon-tip">&nbsp;</div>
    <div>Click the buttons on datagrid toolbar to do crud actions.</div>
</div>

<table id="dg" title="My Users" class="easyui-datagrid" style="height:250px"
       url="<?php echo HTTP_SERVER ?>usermanage/get_users"
       toolbar="#toolbar" pagination="true"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="username" width="50">User Name</th>  
            <th field="role" width="50">Role</th>  
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Remove User</a>
</div>

<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
     closed="true" buttons="#dlg-buttons">
    <div class="ftitle">User Information</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">  
            <label>Username:</label>  
            <input name="name" class="easyui-validatebox" required="true">  
        </div>  
        <div class="fitem">  
            <label>Password:</label>  
            <input name="password" type="password" class="easyui-validatebox" required="true">  
        </div>  
        <div class="fitem">  
            <label>Role:</label>  
            <select name="role" required="true">  
                <option value="default">default</option>
                <option value="admin">admin</option>
            </select>
        </div> 
    </form>
</div>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>
