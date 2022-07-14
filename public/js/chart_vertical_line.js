Chart.plugins.register({
    afterDatasetsDraw: function (chart) {
        chart_type = chart.config.type;
        if (chart.tooltip._active && chart.tooltip._active.length && chart_type === 'line') {
            let activePoint = chart.tooltip._active[0],
                ctx = chart.chart.ctx,
                x_axis = chart.scales['x-axis-0'],
                y_axis = chart.scales['y-axis-0'],
                x = activePoint.tooltipPosition().x,
                topY = y_axis.top,
                bottomY = y_axis.bottom;
 
 
            // draw line
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(x, topY + 7);
            ctx.lineTo(x, bottomY + 1);
            ctx.setLineDash([2, 3]);
            ctx.lineWidth = 1;
            ctx.strokeStyle = '#888';
            ctx.stroke();
            ctx.restore();
        }
    }
});