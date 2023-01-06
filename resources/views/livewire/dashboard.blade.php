 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">

      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tickets</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $ticket_statistics['total_tickets'] }}
                    </h5>
                  </div> <!-- /. div numbers -->
                </div> <!-- /. div col-8 -->
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fas fa-edit text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div> <!-- /. div col-4 -->
              </div> <!-- /. div row -->
            </div> <!-- /. div card-body -->
          </div> <!-- /. div card -->
        </div> <!-- /. div col-xl-3 col-sm-6 -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Solved Tickets</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $ticket_statistics['solved_tickets'] }}
                      <span class="text-success text-sm font-weight-bolder">{{ $ticket_statistics['solved_tickets_percent'] . '%' }}</span>
                    </h5>
                  </div> <!-- /. div numbers -->
                </div> <!-- /. div col-8 -->
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fas fa-check-double text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div> <!-- /. div col-4 -->
              </div> <!-- /. div row -->
            </div> <!-- /. div card-body -->
          </div> <!-- /. div card -->
        </div> <!-- /. div col-xl-3 col-sm-6 -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Tickets</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $ticket_statistics['pending_tickets'] }}
                      <span class="text-danger text-sm font-weight-bolder">{{ $ticket_statistics['pending_tickets_percent'] . '%' }}</span>
                    </h5>
                  </div> <!-- /. div numbers -->
                </div> <!-- /. div col-8 -->
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div> <!-- /. div col-4 -->
              </div> <!-- /. div row -->
            </div> <!-- /. div card-body -->
          </div> <!-- /. div card -->
        </div> <!-- /. div col-xl-3 col-sm-6 -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">In Process Tickets</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $ticket_statistics['in_process_tickets'] }}
                      <span class="text-info text-sm font-weight-bolder">{{ $ticket_statistics['in_process_tickets_percent'] . '%' }}</span>
                    </h5>
                  </div> <!-- /. div numbers -->
                </div> <!-- /. div col-8 -->
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-settings text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div> <!-- /. div col-4 -->
              </div> <!-- /. div row -->
            </div> <!-- /. div card-body -->
          </div> <!-- /. div card -->
        </div> <!-- /. div col-xl-3 col-sm-6 -->
      </div> <!-- /. div row -->

      <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170px"></canvas>
                </div>
              </div>
              <h6 class="ms-2 mt-4 mb-0"> Today's Tickets </h6>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Month's Tickets</h6>
              <p class="text-sm">
                <span class="font-weight-bold">{{ date('M Y') }}</span>
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /. div container-fluid py-4 -->
  </main>

  <!--   Core JS Files   -->
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <script src="/assets/js/plugins/Chart.extension.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");
    console.log(@json($month_tickets))
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [ "Total", "Solved", "Pending", "In Process" ],
        datasets: [{
          label: "Tickets",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          backgroundColor: "#fff",
          data: @json($today_tickets),
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
        tooltips: {
          enabled: true,
          mode: "index",
          intersect: false,
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 100,
              beginAtZero: true,
              padding: 0,
              fontSize: 14,
              lineHeight: 3,
              fontColor: "#fff",
              fontStyle: 'normal',
              fontFamily: "Open Sans",
            },
          }, ],
          xAxes: [{
            gridLines: {
              display: false,
            },
            ticks: {
              display: false,
              padding: 20,
            },
          }, ],
        },
      },
    });

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(253,235,173,0.4)');
    gradientStroke1.addColorStop(0.2, 'rgba(245,57,57,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(255,214,61,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.4)');
    gradientStroke2.addColorStop(0.2, 'rgba(245,57,57,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(255,214,61,0)'); //purple colors


    new Chart(ctx2, {
      type: "line",
      data: {
        //labels: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
        labels: @json($month_days_labels),
        datasets: [{
            label: "Total Tickets",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#fbcf33",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            data: @json($month_tickets),
            maxBarThickness: 6

          },
          {
            label: "Solved Tickets",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "rgba(28, 207, 14, 0.8)",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: @json($month_solved_tickets),
            maxBarThickness: 6

          },
          {
            label: "Pending Tickets",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#f53939",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: @json($month_pending_tickets),
            maxBarThickness: 6

          }
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
        tooltips: {
          enabled: true,
          mode: "index",
          intersect: false,
        },
        scales: {
          yAxes: [{
            gridLines: {
              borderDash: [2],
              borderDashOffset: [2],
              color: '#dee2e6',
              zeroLineColor: '#dee2e6',
              zeroLineWidth: 1,
              zeroLineBorderDash: [2],
              drawBorder: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 40,
              beginAtZero: true,
              padding: 10,
              fontSize: 11,
              fontColor: '#adb5bd',
              lineHeight: 3,
              fontStyle: 'normal',
              fontFamily: "Open Sans",
            },
          }, ],
          xAxes: [{
            gridLines: {
              zeroLineColor: 'rgba(0,0,0,0)',
              display: false,
            },
            ticks: {
              padding: 10,
              fontSize: 11,
              fontColor: '#adb5bd',
              lineHeight: 3,
              fontStyle: 'normal',
              fontFamily: "Open Sans",
            },
          }, ],
        },
      },
    });
  </script>
