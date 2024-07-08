@extends('admin.layouts.index')

@section('title', 'Thống kê')

@section('content')
<!-- Begin Page Content -->
<h1 class="h3 mb-2 text-gray-800">Thống kê</h1>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Doanh thu hôm nay</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ number_format($revenueToday ?? 0,-3,',',',') }} VND</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doanh thu tháng {{ date('n') }}</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ number_format($revenueMonth[0]->total ?? 0,-3,',',',') }} VND</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu năm {{ date('Y') }}</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ number_format($revenueYear[0]->total ?? 0,-3,',',',') }} VND</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Số lượng khách hàng</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $countUser ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu ngày {{ date('d/m/Y', strtotime($date)) }} của từng sản phẩm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-inline" action="{{ route('dashboard') }}" method="GET">
                    <label for="date" class="mr-sm-2">Ngày:</label>
                    <input type="date" class="form-control mb-2 mr-sm-2" name="date" id="date" value="{{ $date }}" required>
                    <button type="submit" class="btn btn-primary mb-2">Lọc</button>
                </form>
                <div id="revenueDayColumnChart" style="width: 100%;"></div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu tháng {{ $month }} năm {{ $year }} của từng sản phẩm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-inline" action="{{ route('dashboard') }}" method="GET">
                    <label for="month" class="mr-sm-2">Tháng:</label>
                    <select class="form-control mr-2" name="month" id="month" required>
                        <option value="">Chọn tháng</option>
                        @for ($i = 1;$i <= 12;$i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                        @endfor
                    </select>
                    <label for="month" class="mr-sm-2">Năm:</label>
                    <select class="form-control mr-2" name="year" id="year" required>
                        <option value="">Chọn năm</option>
                        @for ($i = date('Y') - 3;$i <= date('Y') + 3;$i++)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </form>
                <div id="revenueMonthColumnChart" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Chờ xác nhận <span class="float-right">{{ \App\Models\Order::where([['shop_id', $shopId], ['status', 0]])->count() }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ \App\Models\Order::where([['shop_id', $shopId], ['status', 0]])->count() }}%"></div>
                </div>
                <h4 class="small font-weight-bold">Đang chuẩn bị đơn hàng <span class="float-right">{{ \App\Models\Order::where([['shop_id', $shopId], ['status', 1]])->count() }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ \App\Models\Order::where([['shop_id', $shopId], ['status', 1]])->count() }}%"></div>
                </div>
                <h4 class="small font-weight-bold">Đang giao hàng <span class="float-right">{{ \App\Models\Order::where([['shop_id', $shopId], ['status', 2]])->count() }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ \App\Models\Order::where([['shop_id', $shopId], ['status', 2]])->count() }}%"></div>
                </div>
                <h4 class="small font-weight-bold">Đã giao hàng <span class="float-right">{{ \App\Models\Order::where([['shop_id', $shopId], ['status', 3]])->count() }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ \App\Models\Order::where([['shop_id', $shopId], ['status', 3]])->count() }}%"></div>
                </div>
                <h4 class="small font-weight-bold">Hủy <span class="float-right">{{ \App\Models\Order::where([['shop_id', $shopId], ['status', 4]])->count() }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ \App\Models\Order::where([['shop_id', $shopId], ['status', 4]])->count() }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <input type="hidden" id="data1" value="{{ $revenueByDate }}" />
    <input type="hidden" id="data2" value="{{ $revenueByMonthYear }}" />
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var arr = [['Sản phẩm', 'Doanh thu', { role: "style" }]];
        var orders = JSON.parse(document.getElementById('data1').value);
        if (orders.length < 1) {
            arr.push(['', 0, '#3366CC']);
        }
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        for(x in orders){
            arr.push([x, parseInt(orders[x].total),'#3366CC'])
        }  
        function drawChart() {

            var data = google.visualization.arrayToDataTable(
                arr
            );

            var options = {
                title: 'Thống kê doanh thu ngày <?= $date ?> của từng sản phẩm',
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('revenueDayColumnChart'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        var arr1 = [['Sản phẩm', 'Doanh thu', { role: "style" }]];
        var orders = JSON.parse(document.getElementById('data2').value);
        if (orders.length < 1) {
            arr1.push(['', 0, '#3366CC']);
        }
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        for(x in orders){
            arr1.push([x, parseInt(orders[x].total),'#3366CC'])
        }  
        function drawChart() {

            var data = google.visualization.arrayToDataTable(
                arr1
            );

            var options = {
                title: 'Thống kê doanh thu tháng ' + {{ $month }} + ' năm ' + {{ $year }} + ' của từng sản phẩm',
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('revenueMonthColumnChart'));

            chart.draw(data, options);
        }
    </script>
@endsection
