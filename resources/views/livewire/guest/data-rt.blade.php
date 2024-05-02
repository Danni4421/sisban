<div class="row" data-aos="fade-left">
    @foreach ($RTS as $rt)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                <i class="bi bi-building" style="color: #ffbb2c;"></i>
                <h3>RT{{$rt}}</h3>
            </div>
        </div>
    @endforeach
</div>
