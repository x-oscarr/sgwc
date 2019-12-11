class DonutChart {
    constructor(boxSelector, modalSelectror = null) {
        this.box = document.querySelector(boxSelector);
        this.modal = modalSelectror;
        let siteUrl = window.location.href.split("/");
        this.siteUrl = `${siteUrl[0]}//${siteUrl[2]}`;
    }

    builder(description) {
        let svgNS = 'http://www.w3.org/2000/svg';
        let cx = '21';
        let cy = '21';
        let r = '15.91549430918954';

        const { box, modal } = this;

        // building donut chart
        let donutChart = document.createElement('div');
        donutChart.className = 'donut-chart';
        donutChart.setAttribute('data-toggle', 'modal');
        donutChart.setAttribute('data-target', modal);
        box.appendChild(donutChart);

        let donutText = document.createElement('div');
        donutText.className = 'donut-text';
        donutText.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
        donutChart.appendChild(donutText);

        let donutSvg = document.createElementNS(svgNS, 'svg');
        donutSvg.setAttribute('viewBox', '0 0 42 42');
        donutChart.appendChild(donutSvg);

        let donutCircleHole = document.createElementNS(svgNS, 'circle');
        // donutCircleHole.className = 'donut-hole';
        donutCircleHole.setAttribute('cx', cx);
        donutCircleHole.setAttribute('cy', cy);
        donutCircleHole.setAttribute('r', r);
        donutCircleHole.setAttribute('fill', 'none');
        donutSvg.appendChild(donutCircleHole);

        let donutCircleRing = document.createElementNS(svgNS, 'circle');
        // donutCircleRing.className = 'donut-ring';
        donutCircleRing.setAttribute('cx', cx);
        donutCircleRing.setAttribute('cy', cy);
        donutCircleRing.setAttribute('r', r);
        donutCircleRing.setAttribute('fill', 'transparent');
        donutCircleRing.setAttribute('stroke', '#232323');
        donutCircleRing.setAttribute('stroke-width', '3');
        donutSvg.appendChild(donutCircleRing);

        let donutCircleSegment = document.createElementNS(svgNS, 'circle');
        donutCircleSegment.classList.add('donut-segment');
        donutCircleSegment.setAttribute('cx', cx);
        donutCircleSegment.setAttribute('cy', cy);
        donutCircleSegment.setAttribute('r', r);
        donutCircleSegment.setAttribute('fill', 'transparent');
        donutCircleSegment.setAttribute('stroke', 'url(#chart-gradient)');
        donutCircleSegment.setAttribute('stroke-width', '4');
        donutCircleSegment.setAttribute('filter', 'url(#chart-blur)');
        donutCircleSegment.setAttribute('stroke-dashoffset', '25');
        donutCircleSegment.setAttribute('stroke-dasharray', '0 100');
        donutSvg.appendChild(donutCircleSegment);

        let filterBlur = document.getElementById('chart-blur');
        if(!filterBlur) {
            let filterBlur = document.createElementNS(svgNS, 'filter');
            filterBlur.id = 'chart-blur';
            donutSvg.appendChild(filterBlur);

            let filterGaussianBlur = document.createElementNS(svgNS, 'feGaussianBlur');
            filterGaussianBlur.setAttribute('stdDeviation', '0.3');
            filterBlur.appendChild(filterGaussianBlur);
        }

        let chartGradient = document.getElementById('chart-gradient');
        if(!chartGradient) {
            let chartGradient = document.createElementNS(svgNS, 'linearGradient');
            chartGradient.id = 'chart-gradient';
            donutSvg.appendChild(chartGradient);

            let chartGradientFirst = document.createElementNS(svgNS, 'stop');
            chartGradientFirst.setAttribute('offset', '10%');
            chartGradientFirst.setAttribute('stop-color', '#512da8');
            chartGradient.appendChild(chartGradientFirst);

            let chartGradientSecond = document.createElementNS(svgNS, 'stop');
            chartGradientSecond.setAttribute('offset', '100%');
            chartGradientSecond.setAttribute('stop-color', '#7e31fc');
            chartGradient.appendChild(chartGradientSecond);
        }

        //build donut description
        let donutDescription = document.createElement('div');
        donutDescription.className = 'donut-description';
        donutDescription.innerHTML = description;
        this.box.appendChild(donutDescription);
    }

    update(serverInfo) {
        const { box, siteUrl } = this;

        if (serverInfo) {
            const percent = Math.ceil(serverInfo.players*100/serverInfo.max_players);
            let donutSegment = box.querySelector('.donut-segment');
            setTimeout(() => {
                box.querySelector('.donut-text').innerText = `${serverInfo.players} / ${serverInfo.max_players}`;
                let linecap = (percent == 0 ? 'butt' : 'round');
                donutSegment.setAttribute('stroke-linecap', linecap);
                donutSegment.setAttribute('stroke-dasharray', `${percent} ${100-percent}`);

                let donutDescription = box.querySelector('.donut-description');
                let serverImage = box.querySelector('.server-image');
                if(!serverImage) {
                    serverImage = document.createElement('img');
                    serverImage.className = 'server-image';
                    donutDescription.prepend(serverImage);
                }
                serverImage.src = `${siteUrl}/${serverInfo.map_mod_img}`;
                serverImage.setAttribute('data-toggle', 'popover');
                serverImage.setAttribute('data-placement', 'right');
                serverImage.setAttribute('data-content', serverInfo.map_mod_name);
                console.log(serverInfo);
                // serverImage.setAttribute('title', serverInfo.map_mod_name);
                $(serverImage).popover();
            }, 500);
        }
        else {
            let donutChart = box.querySelector('.donut-chart');
            donutChart.classList.add('donut-chart-offline');

            box.querySelector('.donut-text').innerText = 'OFF';
        }

    }
}
