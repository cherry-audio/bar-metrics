<template>
    <loading-card :loading="loading" class="px-6 py-4">
        <h3 class="flex mb-3 text-base text-80 font-bold">
            {{ title }}
            <span
                class="ml-auto font-semibold text-70 text-sm"
            >({{ formattedTotal }} {{ __('total') }})</span>
        </h3>

        <div ref="chart" class="ct-chart"/>
    </loading-card>
</template>

<script>
import Chartist from "chartist";
import "chartist/dist/chartist.min.css";

export default {
    name: "BarGraphMetric",

    props: {
        loading: Boolean,
        title: String,
        chartData: Array
    },

    data: () => ({ chartist: null }),

    watch: {
        chartData: function(newData, oldData) {
            this.renderChart();
        }
    },

    mounted() {
        this.chartist = new Chartist.Bar(
            this.$refs.chart,
            this.formattedChartData,
            {
                height: 400,
                seriesBarDistance: 150,
                horizontalBars: true,
                axisY: {
                    offset: 100,
                    onlyInteger: true,
                }
            }
        );
    },

    methods: {
        renderChart() {
            this.chartist.update(this.formattedChartData);
        }
    },

    computed: {
        formattedChartData() {
            return {
                labels: _.map(this.chartData, "label"),
                series: [this.formattedSeries]
            };
        },

        formattedTotal() {
            return _.sumBy(this.chartData, "value");
        },

        formattedSeries() {
            return _.map(this.chartData, function(item) {
                return { meta: item.label, value: item.value };
            });
        }
    }
};
</script>

<style>
.ct-series-a .ct-bar {
    stroke-width: 10px;
}
</style>


