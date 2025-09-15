<div class="rounded bg-stone-800 shadow-lg overflow-hidden mt-10 relative z-0">
    <div class="px-6 py-4 border-b border-stone-700">
        <h3 class="text-white font-semibold text-xl">Video Views - Past 14 Days</h3>
    </div>
    <div class="w-full">
        @if($count <= 0)
            <p class="px-4 sm:px-6 py-3 text-sm text-gray-400">We haven't scraped any recent stats. Once we do a chart will appear here.</p>
        @else
            <div id="viewsChart"></div>
        @endif
    </div>
</div>

@script
<script>
    const count = {{ $count }};

    if (count > 0) {
        const options = {
            chart: {
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Views',
                data: {!! json_encode($totals) !!}
            }],
            xaxis: {
                categories: {!! json_encode($labels) !!},
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    show: false
                },
                lines: {
                    show: false
                }
            },
            grid: {
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                colors: ['#FB2C36']
            }
        }

        const chart = new ApexCharts(document.querySelector("#viewsChart"), options);

        chart.render();
    }
</script>
@endscript
