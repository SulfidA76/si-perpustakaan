let canvas=document.querySelector('#canvas-satu');
canvas.width=400;
canvas.height=250;

let xGrid=30;
let yGrid=10;
let cellSize=10;

let ctx=canvas.getContext('2d');


const entries=Object.entries(data);

function blocks(count){
    return count*10;
}

function drawGrids(){

    ctx.beginPath();

    while(xGrid<canvas.height){
        ctx.moveTo(blocks(4),xGrid);
        ctx.lineTo(blocks(35),xGrid);
        xGrid+=blocks(4);
    }

    ctx.moveTo(blocks(35),blocks(23));
    ctx.lineTo(blocks(35),blocks(3));

    ctx.strokeStyle="rgb(61, 164, 199)";
    ctx.lineWidth=1;
    ctx.stroke();
}



//buat garis sb x dan y
function drawAxis(){
    let yPlot=23;
    let xPlot=5;
    let pop =0;

    ctx.beginPath();
    ctx.strokeStyle="black";
    ctx.moveTo(blocks(4),blocks(1));
    ctx.lineTo(blocks(4),blocks(23));
    ctx.lineTo(blocks(36),blocks(23));

    ctx.moveTo(blocks(4), blocks(24));
    
    for(let i=1;i<=6;i++){
        ctx.strokeText(pop,blocks(2),blocks(yPlot));
        yPlot-=4;
        pop+=2;
    }

    ctx.moveTo(blocks(4), blocks(24));

    for(const [index,date] of entries){
        if(date[0]<10){
            ctx.strokeText('0'+date[0],blocks(xPlot),blocks(24)+2);
        } else
        ctx.strokeText(date[0],blocks(xPlot),blocks(24)+2);
        xPlot+=2;
    }
    ctx.lineWidth=2;
    ctx.stroke();
}

function drawChart(){
    ctx.beginPath();
    ctx.strokeStyle="rgb(61, 164, 199)";

    ctx.moveTo(blocks(6)-4,blocks(23));
    var xPlot=blocks(6)-4;

    for(const [index,date] of entries){
        ctx.lineTo(xPlot,blocks(23-date[1]*2)-1);
        xPlot+=blocks(2);
        ctx.moveTo(xPlot,blocks(23));
        
    }
    ctx.lineWidth=10;
    ctx.stroke();
}

let canvas2=document.querySelector('#canvas-dua');
canvas2.width=220;
canvas2.height=220;

let ctx2=canvas2.getContext('2d');

function drawLine(ctx, startX, startY, endX, endY){
    ctx.beginPath();
    ctx.moveTo(startX,startY);
    ctx.lineTo(endX,endY);
    ctx.stroke();
}
function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.stroke();
}
function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(centerX,centerY);
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.closePath();
    ctx.fill();
}



var Piechart = function(options){
    this.options = options;
    this.canvas = options.canvas;
    this.ctx = this.canvas.getContext("2d");
    this.colors = options.colors;
 
    this.draw = function(){
        var total_value = 0;
        var color_index = 0;
        for (var categ in this.options.data){
            var val = this.options.data[categ];
            total_value += val;
        }
 
        var start_angle = 0;
        for (categ in this.options.data){
            val = this.options.data[categ];
            var slice_angle = 2 * Math.PI * val / total_value;
 
            drawPieSlice(
                this.ctx,
                this.canvas.width/2,
                this.canvas.height/2,
                Math.min(this.canvas.width/2,this.canvas.height/2),
                start_angle,
                start_angle+slice_angle,
                this.colors[color_index%this.colors.length]
            );
 
            start_angle += slice_angle;
            color_index++;
        }
 
        
        if (this.options.doughnutHoleSize){
            drawPieSlice(
                this.ctx,
                this.canvas.width/2,
                this.canvas.height/2,
                this.options.doughnutHoleSize * Math.min(this.canvas.width/2,this.canvas.height/2),
                0,
                2 * Math.PI,
                "#ff0000"
            );
        }
 
    }
}

var myPiechart = new Piechart(
    {
        data:jenisBuku,
        canvas:canvas2,
        colors:["#fde23e","#f16e23", "#57d9ff","#937e88","#89d116","#3467d4","#fc8690"]
    }
);

myPiechart.draw();


drawGrids();
drawAxis();
drawChart();

let canvas3=document.querySelector('#canvas-tiga');
canvas3.width=150;
canvas3.height=150;

//let ctx3=canvas3.getContext('2d');

var myPiechart2 = new Piechart(
    {
        data:peminjaman,
        canvas:canvas3,
        colors:["#fde23e","#f16e23", "#57d9ff","#937e88","#89d116","#3467d4","#fc8690"]
    }
);

myPiechart2.draw();

let canvas4=document.getElementById('canvas-empat');
canvas4.width=330;
canvas4.height=40;

let ctx4=canvas4.getContext('2d');
let x=10;
let y=10;



function drawFirstLine(){
    ctx4.beginPath();
    ctx4.moveTo(blocks(1),blocks(2));
    ctx4.lineTo(blocks(32), blocks(2));
    ctx4.strokeStyle="lightblue";
    ctx4.lineWidth=14;
    ctx4.stroke();
}

function drawSecondLine(){
    ctx4.beginPath();
    ctx4.moveTo(blocks(1),blocks(2));
    let length = jenisKelamin.lakiLaki+jenisKelamin.perempuan;
    console.log(jenisKelamin.lakiLaki);
    let persentation=jenisKelamin.lakiLaki/length;
    ctx4.lineTo(blocks(1)+blocks(persentation*31),blocks(2));
    ctx4.strokeStyle="blue";
    ctx4.lineWidth=14;
    ctx4.stroke();
}


drawFirstLine();
drawSecondLine();