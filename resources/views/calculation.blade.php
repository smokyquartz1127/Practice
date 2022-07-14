<?php
//para = 段（かけられる数）　row = 横列(かける数)

//1. get_product関数
function get_product($para, $row){
    $result = $para . '*' . $row . '=' . $para * $row;
    return $result;
}

//2. get_product_array関数
function get_product_array($para, $row_start, $row_end){
    $array = [] ;
    for($i = $row_start; $i <= $row_end; $i++){
        $array[] = get_product($para, $i);
    }
    return $array;
}
//3. get_product_matrix関数
function get_product_matrix($para_start, $para_end, $row_start, $row_end){
    $matrix = [];
    // 段の開始と終了を指定する(6~7の段)
    for($i = $para_start; $i <= $para_end; $i++){
        $matrix[] = get_product_array($i, $row_start, $row_end);
    }
    return $matrix;
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>九九表</title>
        <style>
            .product_matrix{
                border-collapse: collapse;
            }
            .product_matrix td{
                border: solid 1px black;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <table class="product_matrix">
          <?php $product_matrix = get_product_matrix(1, 9, 1, 9); ?>
          <?php foreach($product_matrix as $product_array){ ?>
               <tr>
                <?php foreach($product_array as $product){ ?>
                    <td><?php print($product); ?></td>
                <?php } ?>
                </tr>
           <?php } ?>
        </table>
        
        
        <!----要件の関数（備考）---------->
        <p>①任意の式: 
              <?php $text = get_product(2, 3);
              print($text); ?>
        </p>
        <p>②任意の行の範囲:
              <?php $product_array = get_product_array(7, 1, 5);
              foreach($product_array as $product){
                  print($product . ' ');
              } ?>
        </p>
        <p>③任意の範囲:
              <?php $product_matrix = get_product_matrix(6, 7, 1, 5);
                        foreach($product_matrix as $product_array){
                            foreach($product_array as $product){
                            print($product . ' ');
                        }
                    // print($product . '<br>'); 
               }?>
        </p>
    </body>
</html>