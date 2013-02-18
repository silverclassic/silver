<div id="leftPanel">
    <div id="mainNav">
        <?php
        createMenu($this->category);

        function createMenu($cate) {

            function listCategory($item, $childList, $Name) {
                if ($item != 0) {

                    if (in_array($item, $childList[0])) { // con của 0 thì là topmenu
                        echo '<li class="topmenu">
                                <a href="'.HTTP_SERVER.'home/category/'.$item.'" >
                                    <img src="http://css3menu.com/images/hybrid-red-vertical_files/applications-other2.png" alt=""/>' 
                                    . $Name[$item] . 
                                "</a>";
                    } else {
                        echo '<li><a href="'.HTTP_SERVER.'home/category/'.$item.'">
                                <img src="http://css3menu.com/images/hybrid-red-vertical_files/applications-other2.png" alt=""/>' 
                                . $Name[$item] . 
                               "</a>";
                    }
                }
                if (isset($childList[$item])) {
                    if ($item == 0) {
                        echo '<ul id="css3menu1">';
                    } else {
                        echo "<ul>";
                    }
                    foreach ($childList[$item] as $child) {
                        listCategory($child, $childList, $Name);
                    }
                    echo "</ul>";
                }
                if ($item!=0) {
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
            listCategory(0, $children, $Name);
        }
        ?>

    </div>
</div>
<div id="mainContent">
    <!--The main content will be placed here--!>