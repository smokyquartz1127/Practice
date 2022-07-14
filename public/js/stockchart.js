
const BASE_URL = 'https://development-primer.com/js-api/api/stocks'; //銘柄一覧

let brands = []; //選択したブランドの配列
let line_colors = ['#ff4500', '#ffff00', '#adff2f', '#7fffd4', '#00bfff', '#9400d3']; 

//データの箱
let chartData = {
    datasets: []
};

//Chart.jsの設定
let config = {
    type: 'line',
    data: chartData,
    responsive: true,
    
    options: {
        //凡例設定
        legend: {
            position: 'bottom'
        },
        //ストリーミングデータ設定
        scales: {
            xAxes: [{
                type: 'realtime',
                realtime: {
                    duration: 20000,
                    refresh: 1000,
                    delay: 4000,
                }
            }]
        },
        //ツールチップ表示設定
        tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                //ツールチップのラベル設定
                label: (tooltipItem, data) => {
                    let label = data.datasets[tooltipItem.datasetIndex].label || '';
                    if(label) {
                        label += ': $ ';
                    }
                    label += Math.round(tooltipItem.yLabel * 100) / 100;
                    return label;
                },
                //日付表示設定
                title: (tooltipItem, data) => {
                    let date = new Date(tooltipItem[0].xLabel);
                    return date.toString();
                }
            }    
        },
    }
};

//モーダル → 銘柄選択がさせてないとき と 銘柄選択を押したときに開く。
//選択させているか判定
//localStorage.removeItem('choice_brand');
let judge = localStorage.getItem('choice_brand');
let flag = '';
if(judge === null || JSON.parse(judge).length === 0){
    flag = true;
} else {
    flag = false;
}
//モーダルを開く
$('.choice_modal').modaal({
    content_source: '#modal',
    is_locked: false,
    start_open: flag,
    overlay_close: true,
});
    
//ブランド全体のデータの取得（一覧）
const getStockCode = ()=>{
    //ストレージに保存されている銘柄を取得
    brands = [];
    let savedBrand = localStorage.getItem('choice_brand');
    if(savedBrand !== null) {
        brands = JSON.parse(savedBrand);
    }
    
    $.ajax({
        url: BASE_URL,
        dataType: 'json'
    }).done((res) => {  // [{"code":"GOOGL","name":"Google"},...}
        $('#stock_list').empty();
        for(let each_brand of res) {
            $('#stock_list').append(`<p><input type="checkbox" id="${each_brand.code}" value="${each_brand.code}">${each_brand.name}</p>`);
            for(let select_brand of brands){
                if(select_brand.code === each_brand.code){
                    $('#' + each_brand.code).prop('checked', true);
                }
            }
        }
    }).fail(() => {
        return false;
    });
};

//ChartDataに設定する
const getChartData = ()=> {
    chartData.datasets = [];
    for (let i=0; i<brands.length; i++) {
        chartData.datasets.push({
            label: brands[i].name,
            borderColor: line_colors[i],
            fill: false,
            borderWidth: 1,
            data: [],
        });
    }
};

//（モーダル展開時）銘柄選択->localStorageに保存
$(function() {
    getStockCode();
   //ボタンを押したときに銘柄を保存(上書き)
   $('#button').on('click', ()=>{
        //選択した銘柄をbrandに格納
        brands = [];
        for (let brand of $('#stock_list input:checked')) {
            brands.push({
                code: $(brand).val(),
                name: $(brand).parent('p').text(),
            });
        }
        
        //localStorage->choice_brandに選択されたブランドを保存
        localStorage.setItem('choice_brand', JSON.stringify(brands));
        
        //チャートのdatasetsに選択した銘柄のデータを入れる
        getChartData();
       
        $('.choice_modal').modaal('close');
    });
});

//(銘柄が選択されてるとき) localStorageをそのまま読み込む
$(function() {
    getStockCode();
    if(flag === false) {
        let choice_brands = localStorage.getItem('choice_brand');
        brands = JSON.parse(choice_brands);
        getChartData();
    }
});


//グラフをつくる
$(function() {
    let ctx = $('#canvas');
    //グラフを描画
    let chart = new Chart(ctx, config); //(場所, 内容)
     
    const update = () => {
        for(let i=0; i<brands.length; i++) {
            $.ajax({
              url: BASE_URL + '/' + brands[i].code + '/price',
              dataType: 'json',
              async: true
            })
            .done((res) => {
                chartData.datasets[i].data.push({
                   x: res.timestamp,
                   y: res.price
                });
            })
            .fail(() => {
                return false;
            });
        }
        chart.update();
        setTimeout(update, 2000);
    }; 
    //開始
        //銘柄が選択されているとき
        if(flag === false){
            setTimeout(update, 2000);
        }
        //モーダルのボタンを押したとき
        $('#button').on('click', update);
});































