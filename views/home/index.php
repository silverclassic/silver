<div>
    <?php
    if (isset($this->productCate1)) { // list các sản phẩm của một category mức lá
        homeListProduct($this->productCate1);
    } else if (isset($this->productCate2)) { // list các sản phẩm trong category mẹ
        foreach ($this->productCate2 as $productCateList) {
            homeListProduct($productCateList,6);
        }
    } else if (isset($this->singleProductData)) {// thông tin một sản phẩm
        $data = $this->singleProductData;
        echo '<div id="singleProduct">
                <div class="spLeft"><img src="' . $data["image"] . '"></div>
                <div class="spRight">
                    <div class="name">' . $data["productName"] . '</div>
                    <div class="info">
                        <p class="price">Giá bán: ' . ($data["price"] ? ($data["price"] . " VNĐ") : "đang cập nhật") . '<br>
                            <span class="note">(đã bao gồm thuế VAT)</span>
                        </p>                            
                        <p class="description">' . $data["description"] . '</p>
                        <p class="status">Trạng thái: ' . ($data["status"] ? "có hàng" : "liên hệ") . '</p>
                    </div>                    
                </div>
            </div>';
    } else { //list các sản phẩm hot nhất
        $productCateList = array("name" => "Sản phẩm được quan tâm",
            "data" => $this->productData,
            "id" => 0);
        homeListProduct($productCateList);
    }

    function homeListProduct($pData, $limit = 0) {
        if ($pData["id"] == 0) {
            echo '<div id="categoryLabel"><a href="' . HTTP_SERVER . '">' . $pData["name"] . '</a></div>';
        } else {
            echo '<div id="categoryLabel"><a href="' . HTTP_SERVER . 'home/category/' . $pData["id"] . '">' . $pData["name"] . '</a></div>';
        }
        $data = (array) $pData["data"];

        if (count($data) == 0) { // nếu không có sản phẩm
            echo '<div id="homeMessage">chưa có sản phẩm</div>';
        } else { // liệt kê các sản phẩm
            echo '<div class="table">';
            if ($limit == 0) {
                $limit = count($data);
            }
            for ($i = 0; $i < count($data); $i++) {
                if (!($i % 3)) {
                    echo '<div class="row">';
                }
                echo '<div class="cell"><a href="' . HTTP_SERVER . 'home/product/' . $data[$i]["id"] . '">
                        <div class="name">' . $data[$i]["productName"] . '</div>                
                        <div class="img"><img src="' . $data[$i]["image"] . '"></div>
                        <div class="details">
                            <ul>                        
                                <li>' . $data[$i]["description"] . '</li>
                                <li>trạng thái: ' . ($data[$i]["status"] ? "có hàng" : "liên hệ") . '</li>
                                <li>giá: ' . ($data[$i]["price"] ? ($data[$i]["price"] . " VNĐ") : "đang cập nhật") . '</li>
                            </ul>
                        </div> 
                        </a>
                     </div>';
                if (($i + 1) >= $limit) {
                    echo '</div>';
                    break;
                }
                if ($i % 3 == 2) {
                    echo '</div>';
                } else if ($i == (count($data) - 1)) {
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }
    ?>
</div>
