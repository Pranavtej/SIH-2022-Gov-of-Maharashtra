<html>
    <body>
<div class="card-body">
<canvas id="acscore"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const genericOptions = {
  fill: false,
  interaction: {
    intersect: false
  },
  radius: 0,
};
const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;
const down = (ctx, value) => ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;
const ctx = document.getElementById('acscore');
const myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [" "," "," "," "," "," "," "],
    datasets: [{
      label: '',
      data: [65, 59, 65, 48, 56, 57, 40],
      borderColor: 'rgb(0, 129, 0 )',
      segment: {
        borderColor: ctx => skipped(ctx, 'rgb(100,0,0)') || down(ctx, 'rgb(255,0,0)'),
        borderDash: ctx => skipped(ctx, [6, 6]),
      },
      spanGaps: true
    }]
  },
  options: genericOptions
});
</script>
</div>
</body>
</html>