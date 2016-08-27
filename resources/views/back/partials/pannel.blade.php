<div class="col-lg-4 col-md-6">
    <div class="panel panel-{{ $pannel->color }}">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <span class="fa fa-{{ $pannel->icon }} fa-5x"></span>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">{{ $pannel->nbr->new }}</div>
                    <div>{{ $pannel->name }}</div>
                </div>
            </div>
        </div>
        <a href="{{ $pannel->url }}">
            <div class="panel-footer">
                <span class="pull-left">{{ $pannel->nbr->total . ' ' . $pannel->total }}</span>
                <span class="pull-right fa fa-arrow-circle-right"></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>