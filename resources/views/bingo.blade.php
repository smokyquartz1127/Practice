<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ビンゴ</title>
    <style>
        #bingo {
            text-align: center;
        }

        #bingo_display {
            display: flex;
        }
        .bingo_left {
            display: flex;
            border: solid 1px black;
            flex-wrap: wrap;
            width: 600px;
            margin: 20px auto;
        }
        .bingo_right {
            display: flex;
            border: solid 1px black;
            flex-wrap: wrap;
            width: 300px;
            height: 300px;
            margin: 20px auto;
        }

        .bingo_cell {
            border: solid 1px black;
            font-size: 30px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bingo_sheet_cell {
            border: solid 1px black;
            font-size: 20px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .active_cell {
            background-color: orange;
        }
        
        .selected_cell {
            background-color: lightgray;
        }
        
        .sheet_selected_cell {
            background-color: pink;
        }
    </style>
</head>

<body>
    <h1>ビンゴ</h1>
    <div id="bingo">
        <div id="bingo_display"></div>
        <div>
            <button id="start_button">スタート</button>
            <button id="stop_button">ストップ</button>
            <button id="reset_button">リセット</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script>
    
    //--------------------表の生成-------------------------
    const bingo_left = $('<div>').addClass('bingo_left');
    $('#bingo_display').append(bingo_left);
    const bingo_right = $('<div>').addClass('bingo_right');
    $('#bingo_display').append(bingo_right);
    
    
    //ビンゴマシーン
    const DISPLAY_WIDTH = 600;
    const SIZE = 7;
    const setCells = () => {
        //iマスのサイズ
        const cell_size = DISPLAY_WIDTH / SIZE;
        //7×7=49マス分
        for(let i = 1; i <= SIZE * SIZE; i++){
            //マス目を表すdivを生成
            let $bingo_cell = $('<div>').html(i).css({
                width : cell_size,
                height : cell_size,
            }).addClass('bingo_cell');
        
            //マス目を追加
            $('.bingo_left').append($bingo_cell);
        }    
    };
    //ビンゴシート
    const DISPLAY_SHEET_WIDTH = 300;
    const SHEET_SIZE = 5;
    //ランダムな数字を取得
    const max = 49, min = 1;
    const getRandomNumber = (array) => {
        // let random_number = Math.floor(Math.random() * (max - min + 1)) + min;

        return Math.floor(Math.random() * array.length);
    };
    
    const setSheetCells = () => {
        //iマスのサイズ
        const cell_size = DISPLAY_SHEET_WIDTH / SHEET_SIZE;
        let nums = [];
        for(let i = 1; i <= SHEET_SIZE * SHEET_SIZE; i++){
            nums.push(i);
        }
        
        //5×5=25マス分
        for(let i = 1; i <= SHEET_SIZE * SHEET_SIZE; i++){
            //マスの中の数字
            const index = getRandomNumber(nums);
            let random_number = nums[index];
            nums.splice(index, 1);
            
            let $bingo_sheet_cell = $('<div>').html(random_number).css({
                width : cell_size,
                height : cell_size,
            }).addClass('bingo_sheet_cell');
            //マス目を追加
            $('.bingo_right').append($bingo_sheet_cell);
        }
        
    };
    
    //-----------------ランダムなマス目を選択-------------------
    const getRandomCell = () => {
        let $bingo_cells = $('.bingo_cell').not('.selected_cell');
        //ランダムに0 ～マス目の個数-1のいずれかの数値を取得
        let random_index = Math.floor(Math.random() * $bingo_cells.length);
        //ランダムなマス目を取得
        let $random_cell = $bingo_cells.eq(random_index);
        return $random_cell;    
    };
    
    //-----------------ランダムに色を付ける---------------------
    let timer_id;
    const startBingo = () => {
        //現在着色されているマス目を解除
        $('.active_cell').removeClass('active_cell');
        //ランダムなマス目を取得->色を付ける
        let $random_cell = getRandomCell();
        $random_cell.addClass('active_cell');
        //2秒後にもう一回
        clearTimeout(timer_id);
        timer_id = setTimeout(startBingo, 200);
    };
    
    //------------------出力----------------------------
    //マス目を作成
    setCells();
    setSheetCells();
    $('#stop_button').prop('disabled', true);
    
    //スタートボタン->ランダムにマス目に色を付ける
    $('#start_button').on('click', () => {
        startBingo();
        //ストップボタン復活
        $('#stop_button').prop('disabled', false);
        //スタートボタンは使えない
        $('#start_button').prop('disabled', true);
    });
    
    
    //ストップボタン->ランダム選択を中止
    //停止中
    const hasRest = () => {
        return $('.bingo_cell').not('.selected_cell').length > 0;
    };
    
    const stopBingo = () => {
        clearInterval(timer_id); 
        let select_num = $('.active_cell').html();
        //選択中のマス目の色を変える
        $('.active_cell').removeClass('active_cell').addClass('selected_cell');
        
        for(let cell of $('.bingo_sheet_cell')) {
            if ($(cell).html() === select_num) {
                $(cell).addClass('sheet_selected_cell');
            }
        }
        
        if(hasRest() === true){
            //スタートボタン復活
            $('#start_button').prop('disabled', false);   
        }
        //ストップボタンは使えない
        $('#stop_button').prop('disabled', true);  
    };
    
    $('#stop_button').on('click', stopBingo);
    
    //リセットボタン
    $('#reset_button').on('click', () => {
        stopBingo();
        $('.selected_cell').removeClass('selected_cell');
        $('.sheet_selected_cell').removeClass('sheet_selected_cell');
        $('#start_button').prop('disabled', false);
        $('#stop_button').prop('disabled', true);
    });
    
    
    
    
    
   
    
    </script>
</body>

</html>