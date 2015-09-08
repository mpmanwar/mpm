<script>
$(function () {
    var jan_total = {{ $jan_total }};
    var feb_total = {{ $feb_total }};
    var mar_total = {{ $mar_total }};
    var apr_total = {{ $apr_total }};
    var may_total = {{ $may_total }};
    var jun_total = {{ $jun_total }};
    var jul_total = {{ $jul_total }};
    var aug_total = {{ $aug_total }};
    var sep_total = {{ $sep_total }};
    var oct_total = {{ $oct_total }};
    var nov_total = {{ $nov_total }};
    var dec_total = {{ $dec_total }};
//alert(sep_total)
    var bar = new GraphBar({
        attachTo: '#graph',
        special: 'combo',
        height: 475,
        width: '100%',
        yDist: 30,
        xDist: 50,
        showPoints: false,
        xGrid: false,
        legend: true,
        averageLineColor:false,
        points: [
          [jan_total, feb_total, mar_total, apr_total, may_total, jun_total, jul_total, aug_total, sep_total, oct_total, nov_total, dec_total],
          [32, 15, 75, 20, 45, 90, 52, 15, 75, 20, 45, 90]
        ],
        colors: ['blue', 'purple'],
        dataNames: ['Total', 'Won'],
        xName: 'Month',
        design: {
            tooltipColor: '#fff',
            gridColor: 'black',
            tooltipBoxColor: 'green',
            averageLineColor: 'none',
        }
    });
  bar.init();
});
</script>

<div id="graph"></div>
