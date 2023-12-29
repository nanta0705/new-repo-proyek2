<section class="services-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>What We Do</span>
                    <h2>Temukan Style Impianmu</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($content as $data )
            <div class="col-lg-4 col-sm-6">
                <div class="service-item">
                    <img src="{{asset(''). $data->getMakeup->image}}" alt="" width="150px">
                    <h4>{{$data->getMakeup->name}}</h4>
                    <p>{{$data->getMakeup->description}}
                    </p>
                    {{$data->getMakeup->price}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
