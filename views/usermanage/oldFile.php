

<h1>User Manager</h1>
<br/>
<form id="insertuser" action="<?php echo HTTP_SERVER; ?>usermanage/insert" method="post">
    <table>
        <tr>
            <td class="col1"><span>name</span></td>
            <td><input type="text" name="name"/></td>
        </tr>
        <tr>
            <td class="col1"><span>password</spam></td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td class="col1"><span>role</span></td>
            <td><select name="role">
                    <option value="default">default</option>
                    <option value="admin">admin</option>
                </select></td>
        </tr>
        <tr>
            <td class="col1"><span>&nbsp</span></td>
            <td><input type="submit" value="insert"/></td>
        </tr>
    </table>    

</form>
<hr/>
<div >
    <table id="listUsers">
        <?php
        foreach ($this->userList as $obj) {
            echo '<tr><td>' . $obj['id'] . '</td><td>' .
            $obj['username'] . '</td><td>' .
            $obj['role'] . '</td>';
            echo '<td><a href="' . HTTP_SERVER . 'usermanage/edit/' . $obj['id'] .
            '">Edit </a><a href="' . HTTP_SERVER . 'usermanage/delete/' .
            $obj['id'] . '">Delete</a></td></tr>';
        }
        ?>
    </table>
</div>