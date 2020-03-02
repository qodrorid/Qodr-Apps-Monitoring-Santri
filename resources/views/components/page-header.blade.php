<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>{{ $title ?? '' }}</h4>
                    <span>{{ $subtitle ?? '' }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a>
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    @if (!empty($breadcrumb))
                        @foreach($breadcrumb as $item)
                        <li class="breadcrumb-item">
                            <a>{{ $item }}</a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>