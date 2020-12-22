<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
    <h2>{{ ucfirst($breadcrumb['title']) }} {{session('user.modul')}}</h2>
        <ol class="breadcrumb">
            @foreach ($breadcrumb['breadcrumb'] as $item)
                @if ($loop->last)
                    <li class="breadcrumb-item active">
                        <strong>{{ ucfirst($item) }}</strong>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ url('/'.$item) }}">{{ ucfirst($item)}}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
    @isset($breadcrumb['action'])
        <div class="col-sm-8">
        <div class="title-action">
            <a href="{{ $breadcrumb['action']['link'] }}" class="btn btn-primary">{{ ucfirst($breadcrumb['action']['title']) }}</a>
        </div>
    </div>
    @endisset
</div>